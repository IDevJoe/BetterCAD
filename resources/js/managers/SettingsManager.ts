import Setting, {getAllSettings, setSetting as apiSetSetting} from "../api/Setting";
import {defaults} from '../settings';

let currentSettings : Setting[] = [];
let initialized = false;
let cinit: Promise<void>|null = null;

async function init() {
    if(initialized) return;
    currentSettings = await getAllSettings();
    console.log('Updated Settings', currentSettings);
    window.Echo.listen('global', 'SettingsUpdate', async (e: {setting: Setting}) => {
        console.log('Received live settings update', e);
        let set: any = await getSetting(e.setting.name);
        if(set == null) {
            set = {};
            currentSettings.push(set);
        }
        Object.assign(set, e.setting);
        console.log('New settings', currentSettings);
    });
    initialized = true;
}

export async function getSetting(name: string) : Promise<Setting|undefined> {
    if(cinit == null) cinit = init();
    await cinit;
    return currentSettings.find(e => e.name === name);
}

export async function getSettingValue(name: string) : Promise<string|boolean|null> {
    let server = await getSetting(name);
    if(server !== undefined) {
        if(server.value === 'true') return true;
        if(server.value === 'false') return false;
        return server.value;
    }
    return defaults[name];
}

export async function setSetting(name: string, value: string, hashed: boolean = false) {
    let current = await getSetting(name);
    if(current === undefined) {
        current = {
            id: -1,
            name,
            value: "",
            hashed: hashed
        }
        currentSettings.push(current);
    }
    current.value = await apiSetSetting(name, value, hashed);
}

import Setting, {getAllSettings, setSetting as apiSetSetting} from "../api/Setting";
import {defaults} from '../settings';

let currentSettings : Setting[] = [];
let initialized = false;

async function init() {
    if(initialized) return;
    currentSettings = await getAllSettings();
    initialized = true;
}

export async function getSetting(name: string) : Promise<Setting|undefined> {
    await init();
    return currentSettings.find(e => e.name === name);
}

export async function getSettingValue(name: string) : Promise<string> {
    let server = await getSetting(name);
    if(server !== undefined) return server.public_value;
    return defaults[name];
}

export async function setSetting(name: string, value: string, hashed: boolean = false) {
    let current = await getSetting(name);
    if(current === undefined) {
        current = {
            name,
            public_value: "",
            value_hashed: hashed,
            created_at: "",
            updated_at: ""
        }
        currentSettings.push(current);
    }
    current.public_value = await apiSetSetting(name, value, hashed);
}

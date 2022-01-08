import axios from 'axios';

interface Setting {
    id: number,
    name: string,
    value: string|null,
    hashed: boolean
}

/**
 * Gets all settings for the app
 * @return An array of settings
 */
export async function getAllSettings(): Promise<Setting[]> {
    let resp = await axios.get('/api/settings');
    return resp.data.data;
}

export async function setSetting(name: string, value: string, hashed: boolean = false) : Promise<string|null> {
    let resp = await axios.put('/api/settings/' + encodeURIComponent(name), {value: value, hash: hashed});
    if(resp.status === 204) return null;
    return resp.data.data.value;
}

export default Setting;

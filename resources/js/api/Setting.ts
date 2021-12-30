import axios from 'axios';

interface Setting {
    name: string,
    public_value: string,
    value_hashed: boolean,
    created_at: string,
    updated_at: string
}

/**
 * Gets all settings for the app
 * @return An array of settings
 */
export async function getAllSettings(): Promise<Setting[]> {
    let resp = await axios.get('/api/settings');
    return resp.data;
}

export async function setSetting(name: string, value: string, hashed: boolean = false) : Promise<string> {
    let resp = await axios.put('/api/settings/' + encodeURIComponent(name), {new_value: value, hash: hashed});
    return resp.data.public_value;
}

export default Setting;

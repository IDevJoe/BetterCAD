interface Character {
    id: number,
    user_id: number,
    fname: string,
    lname: string,
    dob: string,
    hair_color: string,
    address: string,
    gender: string,
    race: string,
    height: number,
    weight: number
}

export default Character;

export async function getUserCharacters() : Promise<Character> {
    let res = await window.axios.get('/api/characters');
    return res.data;
}

export async function createCharacter(characterData: Character) {
    let res = await window.axios.post('/api/characters', characterData);
    return res.data;
}

export async function getCharacter(id: number) {
    let res = await window.axios.get('/api/characters/' + encodeURIComponent(id));
    return res.data;
}

export async function saveCharacter(id: number, characterData: Character) {
    let res = await window.axios.patch('/api/characters/' + encodeURIComponent(id), characterData);
    return res.data;
}

export async function deleteCharacter(id: number) {
    let res = await window.axios.delete('/api/characters/' + encodeURIComponent(id));
    return res.data;
}

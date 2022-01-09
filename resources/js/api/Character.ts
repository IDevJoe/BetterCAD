interface Character {
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

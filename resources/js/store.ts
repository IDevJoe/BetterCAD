import {createStore} from "vuex";
import User from "./api/User";
import Character from "./api/Character";
import Setting from "./api/Setting";

interface BetterCadState {
    user: User|null,
    characters: Character[]
}

export default createStore<BetterCadState>({
    state() {
        return {
            user: null,
            characters: []
        }
    },
    mutations: {
        setUser(state: BetterCadState, user: User|null) {
            state.user = user;
        },
        setCharacters(state: BetterCadState, characters: Character[]) {
            state.characters = characters;
        },
        modifyCharacter(state: BetterCadState, character: Character) {
            let char = state.characters.find(e => e.id === character.id);
            Object.assign(char, character);
        },
        addCharacter(state: BetterCadState, character: Character) {
            state.characters.push(character);
        },
        deleteCharacter(state: BetterCadState, character: Character) {
            let ch2 = state.characters.find(e => e.id === character.id);
            if(ch2 === undefined) {
                console.error("Character not found.", character, state.characters);
                return;
            }
            let ind = state.characters.indexOf(ch2);
            state.characters.splice(ind, 1);
        }
    }
});

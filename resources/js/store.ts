import {createStore} from "vuex";
import User from "./api/User";
import Setting from "./api/Setting";

interface BetterCadState {
    user: User|null
}

export default createStore<BetterCadState>({
    state() {
        return {
            user: null
        }
    },
    mutations: {
        setUser(state: BetterCadState, user: User|null) {
            state.user = user;
        }
    }
});

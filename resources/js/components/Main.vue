<template>
    <div>
        <div class="container mt-5" v-if="!loaded">
            <div class="row">
                <div class="col-md-3 ml-auto mr-auto">
                    <img src="/img/load.gif" alt="Loading" class="w-100 mb-2">
                </div>
            </div>
        </div>
        <Login v-else-if="loaded && this.$store.state.user == null"></Login>
        <router-view v-else></router-view>
    </div>
</template>

<script>
import Login from "../pages/Login";
import {getCurrentUser} from "../api/User";

export default {
    name: "Main",
    components: {Login},
    data: () => ({
        loaded: false
    }),
    mounted() {
        getCurrentUser().then(e => {
            if(e != null) this.$store.commit('setUser', e);
        }).finally(() => {
            this.loaded = true;
        });
    }
}
</script>

<style scoped>

</style>

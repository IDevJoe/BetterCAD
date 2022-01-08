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
        <div v-else>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img :src="logo" id="brand-logo" alt="BetterCAD" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <router-link to="/" :exact="true" class="nav-link" active-class="active">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/cad" class="nav-link" active-class="active">Dispatch</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/mdt" class="nav-link" active-class="active">LEO</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/civ" class="nav-link" active-class="active">Civilian</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/records" class="nav-link" active-class="active">Records Lookup</router-link>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <ul class="navbar-nav mr-3">
                                <li class="nav-item">
                                    <router-link to="/admin" class="nav-link" active-class="active">
                                        <i class="fa-solid fa-gear mr-1"></i>
                                        Admin
                                    </router-link>
                                </li>
                            </ul>
                            <button class="btn btn-sm btn-danger" v-on:click="logout">Logout</button>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container mt-5 mb-5">
                <router-view></router-view>
            </div>
        </div>
        <div class="mb-2 d-flex justify-content-center">
            <!--
                Support the project by not removing this footer.
            -->
            <small><a href="https://github.com/IDevJoe/BetterCAD" target="_blank">BetterCAD</a> made with &hearts; by
                <a href="https://github.com/IDevJoe" target="_blank">IDevJoe</a>.
                Licensed under <a href="https://github.com/IDevJoe/BetterCAD/blob/master/LICENSE.txt" target="_blank">GNUGPLv3</a>.</small>
        </div>
    </div>
</template>

<script>
import Login from "../pages/Login";
import {getCurrentUser, logout as logoutUser} from "../api/User";
import {getSettingValue} from "../managers/SettingsManager";

export default {
    name: "Main",
    components: {Login},
    data: () => ({
        loaded: false,
        logo: ""
    }),
    mounted() {
        getCurrentUser().then(e => {
            if(e != null) this.$store.commit('setUser', e);
        }).finally(() => {
            this.loaded = true;
        });
        getSettingValue("BRAND_ICON_FILE").then(e => {
            this.logo = e;
        });
        setInterval(() => {
            if(this.$store.state.user == null) return;
            getCurrentUser().then(e => {

            }).catch(e => {
                this.$store.commit('setUser', null);
                console.log('Healthcheck failed.')
            });
        }, 60000);
    },
    methods: {
        logout(e) {
            e.preventDefault();
            this.loaded = false;
            logoutUser().then(e => {
                this.$store.commit('setUser', null);
                this.loaded = true;
            });
        }
    }
}
</script>

<style scoped>
    #brand-logo {
        width: 100px;
    }
</style>

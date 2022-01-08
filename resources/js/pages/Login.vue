<template>
    <div class="container mt-5 mb-5">
        <div class="row" v-if="section === 0">
            <div class="col-md-4 ml-auto mr-auto">
                <img :src="logo" alt="BetterCAD" class="w-100">
                <div class="mt-2" v-if="socials.length > 0">
                    <a :href="'/login/socialite/'+social" class="btn btn-info w-100 mt-1" v-for="social in socials">Login with {{social}}</a>
                    <div class="sep mt-3" v-if="!socialForce">
                        <span>OR LOGIN WITH EMAIL</span>
                    </div>
                </div>
                <form class="mt-4" v-if="!socialForce">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" required id="email" class="form-control" ref="email" :disabled="attempting" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required class="form-control" id="password" ref="password" :disabled="attempting">
                    </div>
                    <button class="btn btn-primary w-100" v-on:click="login" :disabled="attempting">Login</button>
                    <div class="d-flex justify-content-center mt-2">
                        <small v-if="!selfRegister"><a href="#">Request Access</a></small>
                        <small v-else><a href="#">Create Account</a></small>
                    </div>
                </form>
                <div class="mt-5 alert alert-danger" v-if="failMessage">
                    Login failed. Check your credentials and try again.
                </div>
            </div>
        </div>
        <div v-if="section === 1">

        </div>
    </div>
</template>

<script>
import {login} from "../api/User";
import {getSettingValue} from "../managers/SettingsManager";

export default {
    name: "Login",
    data: () => ({
        attempting: false,
        failMessage: false,
        logo: "",
        section: 0,
        selfRegister: false,
        socials: [],
        socialForce: false
    }),
    beforeMount() {
        getSettingValue("BRAND_ICON_FILE").then(e => {
            this.logo = e;
        });
        getSettingValue("ALLOW_SELF_REGISTRATION").then(e => {
            this.selfRegister = e;
        });
        getSettingValue("DISCORD_OAUTH_ENABLED").then(e => {
            if(e) this.socials.push("Discord");
        });
        getSettingValue("DISCORD_OAUTH_FORCE").then(e => {
            this.socialForce = e;
        });
    },
    methods: {
        login(e) {
            e.preventDefault();
            this.attempting = true;
            login(this.$refs.email.value, this.$refs.password.value).then(e => {
                this.attempting = false;
                if(e === null) {
                    this.failMessage = true;
                    return;
                }
                this.$store.commit('setUser', e);
            });
        }
    }

}
</script>

<style scoped>
    .sep {
        width: 100%;
        height: 15px;
        border-bottom: 1px solid #718096;
        text-align: center;
    }

    .sep span {
        background-color: #191d21;
        padding: 0 10px;
    }
</style>

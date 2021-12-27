<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto">
                <img src="/img/BetterCAD-433.png" alt="BetterCAD" class="w-100">
                <form class="mt-4">
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
                        <small><a href="#">Request Access</a></small>
                    </div>
                </form>
                <div class="mt-5 alert alert-danger" v-if="failMessage">
                    Login failed. Check your credentials and try again.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {login, getCurrentUser} from "../api/User";

export default {
    name: "Login",
    data: () => ({
        attempting: false,
        failMessage: false
    }),
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
                getCurrentUser().then(e => {
                    this.$store.commit('setUser', e);
                });
            });
        }
    }

}
</script>

<style scoped>

</style>

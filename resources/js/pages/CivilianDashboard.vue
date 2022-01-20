<template>
    <router-view />
    <div v-if="$route.params.cid == null">
        <div class="row mt-4">
            <div class="col-md-6">
                <h1>New Character</h1>
                <form v-on:submit="createCharacter">
                    <CivForm :mod="newCharacter" />
                    <button class="btn btn-outline-info w-100">
                        Create Character
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <h1>Characters</h1>
                <div class="card mb-2" v-for="character in this.$store.state.characters">
                    <div class="card-body">
                        <h5 class="card-title">{{ character.fname }} {{ character.lname }} <span class="badge badge-danger" v-if="character.dead">Dead</span></h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ character.dob }}</h6>
                        <router-link :to="{name: 'civilian.edit', params: {cid: character.id}}" class="card-link">Edit/Licenses</router-link>
                        <router-link :to="{name: 'civilian.edit.vehicles', params: {cid: character.id}}" class="card-link">Vehicles</router-link>
                        <a href="#" class="card-link">Weapons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getUserCharacters, createCharacter} from "../api/Character";
import CivForm from "../components/CivForm";

export default {
    name: "CivilianDashboard",
    components: {CivForm},
    data: () => ({
        newCharacter: {}
    }),
    mounted() {
        if(this.$store.state.characters.length === 0)
            getUserCharacters().then(e => {
                this.$store.commit('setCharacters', e);
            });
    },
    methods: {
        createCharacter(e) {
            e.preventDefault();
            createCharacter(this.newCharacter).then(e => {
                this.$store.commit('addCharacter', e);
                this.newCharacter = {};
            }).catch(e => {
                if(e.response.status === 422) {
                    let errors = "The following errors must be corrected.\n";
                    Object.keys(e.response.data.errors).forEach(x => {
                        errors += "\n- " + e.response.data.errors[x][0];
                    });
                    alert(errors);
                } else {
                    alert("An unknown error occurred.");
                }
            });
        }
    }
}
</script>

<style scoped>

</style>

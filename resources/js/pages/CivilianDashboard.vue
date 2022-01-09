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
                <div class="card" v-for="character in characters">
                    <div class="card-body">
                        <h5 class="card-title">{{ character.fname }} {{ character.lname }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ character.dob }}</h6>
                        <router-link :to="{name: 'civilian.edit', params: {cid: character.id}}" class="card-link">View/Edit</router-link>
                        <a href="#" class="card-link">Vehicles</a>
                        <a href="#" class="card-link">Licenses</a>
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
        characters: [],
        characterEdit: null,
        newCharacter: {}
    }),
    mounted() {
        getUserCharacters().then(e => {
            this.characters = e;
        });
    },
    methods: {
        createCharacter(e) {
            e.preventDefault();
            createCharacter(this.newCharacter).then(e => {
                this.characters.push(e);
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

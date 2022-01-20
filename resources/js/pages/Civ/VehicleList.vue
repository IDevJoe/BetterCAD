<template>
    <div v-if="character != null">
        <router-link to="/civ" class="btn btn-outline-info btn-sm">Back to all characters</router-link>
        <router-link :to="{name: 'civilian.edit', params: {cid: character.id}}" class="btn btn-outline-info btn-sm ml-1">Edit/Licenses</router-link>
        <router-link :to="{name: 'civilian.edit.weapons', params: {cid: character.id}}" class="btn btn-outline-info btn-sm ml-1">Weapons</router-link>
        <div class="row mt-3">
            <div class="col-md-6">
                <h1>New Vehicle</h1>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="plate_number">Plate</label>
                        <input type="text" id="plate_number" class="form-control" v-model="newVeh.plate_number">
                    </div>
                    <div class="col-md form-group">
                        <label for="state">State</label>
                        <select id="state" class="form-control" v-model="newVeh.state">
                            <option v-for="st in manifest.states" :value="st">{{ st }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="color">Color</label>
                        <input type="text" id="color" v-model="newVeh.color" class="form-control">
                    </div>
                    <div class="col-md form-group">
                        <label for="make">Make</label>
                        <input type="text" id="make" class="form-control" v-model="newVeh.make">
                    </div>
                    <div class="col-md form-group">
                        <label for="model">Model</label>
                        <input type="text" id="model" class="form-control" v-model="newVeh.model">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="insurance_status">Insurance Status</label>
                        <select id="insurance_status" class="form-control" v-model="newVeh.insurance_status">
                            <option value="V">V - Valid</option>
                            <option value="E">E - Expired</option>
                            <option value="N">N - No Insurance</option>
                        </select>
                    </div>
                    <div class="col-md form-group">
                        <label for="registration_status">Registration Status</label>
                        <select id="registration_status" class="form-control" v-model="newVeh.registration_status">
                            <option value="V">V - Valid</option>
                            <option value="E">E - Expired</option>
                            <option value="S">S - Suspended</option>
                            <option value="C">C - Canceled</option>
                            <option value="WA">WA - Wanted</option>
                            <option value="ST">ST - Stolen</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="regto">Registered To</label>
                        <input type="text" class="form-control" id="regto" readonly :value="character.fname + ' ' + character.lname">
                    </div>
                </div>
                <button class="btn btn-outline-info w-100" v-on:click="createVeh">Register Vehicle</button>
            </div>
            <div class="col-md-6">
                <h1>Current Vehicles</h1>
                <RegisteredVehicle v-for="veh in character.vehicles" :vehicle="veh" :character="character" />
            </div>
        </div>
    </div>
</template>

<script>
import {getCharacter, registerVehicle} from "../../api/Character";
import {getManifest} from "../../managers/SettingsManager";
import RegisteredVehicle from "../../components/RegisteredVehicle";

export default {
    name: "VehicleList",
    components: {RegisteredVehicle},
    data: () => ({
        character: null,
        newVeh: {},
        manifest: {}
    }),
    beforeMount() {
        let ch = this.$store.state.characters.find(e => e.id+"" === this.$route.params.cid);
        if(ch == null)
            getCharacter(this.$route.params.cid).then(e => {
                this.character = e;
            });
        else
            this.character = ch;
        getManifest().then(e => this.manifest = e);
    },
    methods: {
        createVeh() {
            this.newVeh.character_id = this.character.id;
            registerVehicle(this.newVeh).then(e => {
                this.character.vehicles.push(e);
                this.$store.commit('modifyCharacter', this.character);
                this.newVeh = {};
            }).catch(e => {
                if(e.response.status === 422) {
                    let errors = "The following errors must be corrected.\n";
                    Object.keys(e.response.data.errors).forEach(x => {
                        errors += "\n- " + e.response.data.errors[x][0];
                    });
                    alert(errors);
                } else {
                    alert("An unknown error occurred.");
                    console.error(e);
                }
            });
        }
    }
}
</script>

<style scoped>

</style>

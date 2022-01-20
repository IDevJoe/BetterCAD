<template>
    <div>
        <div class="card mt-3">
            <div class="card-body">
                <span class="badge badge-secondary mb-1">{{ vehicle.state }}</span>
                <h4>{{ vehicle.plate_number }}</h4>
                <p>{{ vehicle.color }} {{ vehicle.make }} {{ vehicle.model }}</p>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="insurance_status">Insurance Status</label>
                        <select id="insurance_status" class="form-control" v-model="vehicle.insurance_status" v-on:change="updateVehicle">
                            <option value="V">V - Valid</option>
                            <option value="E">E - Expired</option>
                            <option value="N">N - No Insurance</option>
                        </select>
                    </div>
                    <div class="col-md form-group">
                        <label for="registration_status">Registration Status</label>
                        <select id="registration_status" class="form-control" v-model="vehicle.registration_status" v-on:change="updateVehicle">
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
                    <div class="col-md">
                        <button class="w-100 btn btn-outline-info">Show DB Output</button>
                    </div>
                    <div class="col-md">
                        <div class="btn btn-outline-danger w-100">Delete</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {updateVehicle} from "../api/Character";

export default {
    name: "RegisteredVehicle",
    props: ['vehicle', 'character'],
    methods: {
        updateVehicle() {
            updateVehicle(this.vehicle).then(e => {
                Object.assign(this.vehicle, e);
                this.$store.commit('modifyCharacter', this.character);
            }).catch(e => {
                console.error(e);
                alert('Could not update character.');
            });
        }
    }
}
</script>

<style scoped>

</style>

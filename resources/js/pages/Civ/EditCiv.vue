<template>
    <div v-if="civilian != null">
        <h1>Edit Character <span class="badge badge-danger" v-if="civilian.dead">Dead</span></h1>
        <div class="row">
            <div class="col-md-6">
                <form v-on:submit="cancel">
                    <CivForm :mod="this.civilian" :editmode="true" />
                    <div class="row">
                        <div class="col-md">
                            <button class="btn btn-outline-info w-100" v-on:click="saveCharacter">Save</button>
                        </div>
                        <div class="col-md" v-if="!civilian.dead">
                            <button class="btn btn-outline-warning w-100" v-on:click="kill">Mark Dead</button>
                        </div>
                        <div class="col-md">
                            <button class="btn btn-outline-danger w-100" v-on:click="deleteChar">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">License Status</h5>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="dlType">DL Type</label>
                                <select name="dlType" id="dlType" class="form-control" v-model="civilian.dl_type" v-on:change="saveCharacter">
                                    <option value="UNL">Unlicensed</option>
                                    <option value="L">Learners</option>
                                    <option value="P">Provisional</option>
                                    <option value="UNR">Unrestricted</option>
                                    <option value="C">Commercial</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="dlStatus">DL Status</label>
                                <select name="dlStatus" id="dlStatus" class="form-control" v-model="civilian.dl_status" :disabled="civilian.dl_type === 'UNL'" v-on:change="saveCharacter">
                                    <option value="V">Valid</option>
                                    <option value="S">Suspended</option>
                                    <option value="R">Revoked</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="dlExpiry">DL Expiration</label>
                                <input type="date" name="dlExpiry" id="dlExpiry" class="form-control" v-model="civilian.dl_expiry" :disabled="civilian.dl_type === 'UNL'" v-on:change="saveCharacter" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="weapStatus">Weapons Status</label>
                                <select name="weapStatus" id="weapStatus" class="form-control" v-model="civilian.wl_status" v-on:change="saveCharacter">
                                    <option value="U">Unlicensed</option>
                                    <option value="V">Valid</option>
                                    <option value="S">Suspended</option>
                                    <option value="R">Revoked</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="weapExpiry">Weapons Expiration</label>
                                <input type="date" id="weapExpiry" class="form-control" v-model="civilian.wl_expiry" :disabled="civilian.wl_status === 'U'" v-on:change="saveCharacter" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="boatStatus">Boating Status</label>
                                <select name="boatStatus" id="boatStatus" class="form-control" v-model="civilian.bl_status" v-on:change="saveCharacter">
                                    <option value="U">Unlicensed</option>
                                    <option value="V">Valid</option>
                                    <option value="S">Suspended</option>
                                    <option value="R">Revoked</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="boatExpiry">Boating Expiration</label>
                                <input type="date" id="boatExpiry" class="form-control" v-model="civilian.bl_expiry" :disabled="civilian.bl_status === 'U'" v-on:change="saveCharacter" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <label for="pilotType">Pilot Type</label>
                                <select name="pilotType" id="pilotType" class="form-control" v-model="civilian.pl_type" v-on:change="saveCharacter">
                                    <option value="U">Unlicensed</option>
                                    <option value="P">Private</option>
                                    <option value="C">Commercial</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="pilotStatus">Pilot Status</label>
                                <select name="pilotStatus" id="pilotStatus" class="form-control" v-model="civilian.pl_status" :disabled="civilian.pl_type === 'U'" v-on:change="saveCharacter">
                                    <option value="V">Valid</option>
                                    <option value="S">Suspended</option>
                                    <option value="R">Revoked</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <label for="pilotExpiry">Pilot Expiration</label>
                                <input type="date" name="pilotExpiry" id="pilotExpiry" class="form-control" v-model="civilian.pl_expiry" :disabled="civilian.pl_type === 'U'" v-on:change="saveCharacter" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getCharacter, saveCharacter, deleteCharacter} from "../../api/Character";
import CivForm from "../../components/CivForm";

export default {
    name: "EditCiv",
    components: {CivForm},
    data: () => ({
        civilian: null
    }),
    mounted() {
        getCharacter(this.$route.params.cid).then(e => {
            this.civilian = e;
        })
    },
    methods: {
        saveCharacter() {
            saveCharacter(this.$route.params.cid, this.civilian).then(e => {
                this.civilian = e;
            }).catch(e => {
                alert("Character could not be saved.");
            });
        },
        kill() {
            if(!confirm("Really kill this character? This can't be undone.")) return;
            this.civilian.dead = true;
            this.saveCharacter();
        },
        cancel(e) {
            e.preventDefault();
        },
        deleteChar() {
            if(!confirm("Really delete this character?")) return;
            deleteCharacter(this.$route.params.cid).then(e => {
                this.$router.push('/civ');
            }).catch(e => {
                alert('Character could not be deleted.');
            });
        }
    }
}
</script>

<style scoped>

</style>

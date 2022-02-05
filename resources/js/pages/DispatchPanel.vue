<template>
    <div>
        <div class="d-flex justify-content-center align-items-center mb-2">
            <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                <label class="btn btn-secondary" ref="offdutylabel">
                    <input type="radio" name="dutystatus" id="offduty" v-model="b7" v-on:change="() => updateStatus('10-42')"> {{ lang.oos }}/{{ lang.endDuty }}
                </label>
                <label class="btn btn-secondary" ref="ondutylabel">
                    <input type="radio" name="dutystatus" id="onduty" v-model="b8" v-on:click="() => updateStatus('10-8')"> {{ lang.startDuty }}/{{ lang.available }}
                </label>
            </div>
            <div>
                <strong>Identifier: </strong>
                {{ identifier }}
                (<a href="#" v-on:click="changeId">Change</a>)
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md">
                <div class="d-flex justify-content-center mt-2">
                    <h4>Current BOLOs</h4>
                </div>
                <span v-if="bolos.length === 0">
                    No current BOLOs.
                </span>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center">
                                    <h4>Active Units</h4>
                                </div>
                                <span v-if="units.length === 0">
                            No active units
                        </span>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center">
                                    <h4>Active Calls</h4>
                                </div>
                                <span v-if="calls.length === 0">
                            No active calls
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-if="displayMap">
                <div id="map" class="w-100">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getSettingValue} from "../managers/SettingsManager";
import {getCadState, setIdentifier, setStatus} from "../api/Cad";
import L from 'leaflet';

let channel = null;
let map = null;
export default {
    name: "DispatchPanel",
    data: () => ({
        bolos: [],
        units: [],
        calls: [],
        lang: {available: "XXX", oos: "XXX", startDuty: "XXX", endDuty: "XXX"},
        b7: false,
        b8: false,
        identifier: "ZZZZ",
        displayMap: true
    }),
    computed: {
        dutyStatus() {
            return this.b7 ? '10-42' : '10-8';
        }
    },
    mounted() {
        channel = window.Echo.join('cad-live');
        channel.listen('CallCreated', (c) => {

        });
        channel.listen('CallUpdated', (c) => {

        });
        channel.listen('CallArchived', (c) => {

        });
        channel.listen('UserStatusChange', (c) => {
            if(c.user.id === this.$store.state.user.id) {
                // Refers to self
                this.identifier = c.user.current_identifier;
                return;
            }
            let u = this.units.find(e => e.id === c.user.id);
            Object.assign(u, c.user);
        });
        getSettingValue('LANG_10C_AVAIL').then(e => {
            this.lang.available = e;
        });
        getSettingValue('LANG_10C_OFF_DUTY').then(e => {
            this.lang.oos = e;
        });
        getSettingValue('LANG_10C_BEGIN_DUTY').then(e => {
            this.lang.startDuty = e;
        });
        getSettingValue('LANG_10C_END_DUTY').then(e => {
            this.lang.endDuty = e;
        })
        getSettingValue('LIVE_MAP_FILE').then(e => {
            if(e == null) {
                this.displayMap = false;
                return;
            }
            this.$store.commit('setFluidContainer', true);
            map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: -1.7,
                maxBounds: [[0,0],[4096,4096]],
                maxBoundsViscosity: 1.0
            });
            L.imageOverlay(e, [[0,0],[4096,4096]]).addTo(map);
            map.fitBounds([[0,0],[4096,4096]]);
        });
        getCadState().then(e => {
            this.bolos = e.bolos;
            this.units = e.units;
            this.calls = e.calls;
            if(e.user.current_status === "10-42") {
                this.b7 = true;
                this.b8 = false;
                this.$refs.offdutylabel.classList.add('active');
            } else if(e.user.current_status === "10-8") {
                this.b7 = false;
                this.b8 = true;
                this.$refs.ondutylabel.classList.add('active');
            }
            this.identifier = e.user.current_identifier;
        });
    },
    beforeUnmount() {
        if(map != null)
            map.remove();
        this.$store.commit('setFluidContainer', false);
        channel.stopListening('CallCreated');
        channel.stopListening('CallUpdated');
        channel.stopListening('CallArchived');
        channel.stopListening('UserStatusChange');
        window.Echo.leave('cad-live');
    },
    methods: {
        changeId() {
            let newident = prompt("Enter new identifier (XX-00)");
            if(!newident) return;
            setIdentifier(newident).catch(e => {
                alert("Could not set identifier. Check to make sure it is valid.");
            });
        },
        updateStatus(s) {
            setStatus(s).catch(e => {
                alert("Could not update status.");
            });
        }
    }
}
</script>

<style scoped>
    #map {
        height: 50rem;
    }
</style>

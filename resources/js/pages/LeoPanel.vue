<template>
    <div>
        <div class="row">
            <div class="col-md d-flex justify-content-center">
                <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                    <label class="btn btn-secondary" ref="offdutylabel">
                        <input type="radio" name="dutystatus" id="offduty" v-on:change="() => updateStatus('10-41')"> {{ lang.startDuty }}
                    </label>
                    <label class="btn btn-secondary" ref="ondutylabel">
                        <input type="radio" name="dutystatus" id="onduty" v-on:click="() => updateStatus('10-42')"> {{ lang.endDuty }}
                    </label>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center">
                <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                    <label class="btn btn-secondary" ref="availablelabel">
                        <input type="radio" name="patrolstatus" id="available" v-on:change="() => updateStatus('10-8')"> {{ lang.available }}
                    </label>
                    <label class="btn btn-secondary" ref="ooslabel">
                        <input type="radio" name="patrolstatus" id="oos" v-on:click="() => updateStatus('10-7')"> {{ lang.oos }}
                    </label>
                    <label class="btn btn-secondary" ref="busylabel">
                        <input type="radio" name="patrolstatus" id="busy" v-on:click="() => updateStatus('10-6')"> {{ lang.busy }}
                    </label>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center">
                <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                    <label :class="callGroupClasses" ref="enroutelabel">
                        <input type="radio" name="callstatus" id="enroute" v-on:change="() => updateStatus('10-97')"> {{ lang.enroute }}
                    </label>
                    <label :class="callGroupClasses" ref="onscenelabel">
                        <input type="radio" name="callstatus" id="onscene" v-on:click="() => updateStatus('10-23')"> {{ lang.onscene }}
                    </label>
                    <label :class="callGroupClasses" ref="transportlabel">
                        <input type="radio" name="callstatus" id="transport" v-on:click="() => updateStatus('10-15')"> {{ lang.transport }}
                    </label>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center align-items-center">
                <span>
                    Identifier: {{ identifier }}
                    <br />
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import {getSettingValue} from "../managers/SettingsManager";

export default {
    name: "LeoPanel",
    data: () => ({
        lang: {},
        call: null,
        bolos: [],
        overallStatus: "10-42",
        s1: "10-42",
        s2: null,
        s3: null,
        identifier: "ZZZZ"
    }),
    computed: {
        enCallGroup() {
            return this.call != null && this.overallStatus !== "10-42";
        },
        callGroupClasses() {
            return 'btn btn-secondary' + (this.enCallGroup ? '' : ' disabled');
        },
        enPatrolGroup() {
            return this.overallStatus === "10-41";
        }
    },
    mounted() {
        getSettingValue('LANG_10C_BEGIN_DUTY').then(e => this.lang.startDuty = e);
        getSettingValue('LANG_10C_END_DUTY').then(e => this.lang.endDuty = e);
        getSettingValue('LANG_10C_AVAIL').then(e => this.lang.available = e);
        getSettingValue('LANG_10C_OFF_DUTY').then(e => this.lang.oos = e);
        getSettingValue('LANG_10C_BUSY').then(e => this.lang.busy = e);
        getSettingValue('LANG_10C_ENROUTE').then(e => this.lang.enroute = e);
        getSettingValue('LANG_10C_ON_SCENE').then(e => this.lang.onscene = e);
        getSettingValue('LANG_10C_TRANSPORT').then(e => this.lang.transport = e);

    }
}
</script>

<style scoped>

</style>

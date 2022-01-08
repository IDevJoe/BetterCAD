<template>
    <div>
        <div class="float-right d-flex align-items-center">
            <i class="fas fa-spinner text-info mr-3" v-if="saveState === 0"></i>
            <i class="fas fa-check text-success mr-3" v-if="saveState === 1"></i>
            <i class="fas fa-exclamation-triangle text-danger mr-3" v-if="saveState === 2"></i>
            <div v-if="setting.type === 'file'">
                <input type="file" class="d-none" ref="fileup" v-on:change="processUpload" />
                <button class="btn btn-outline-primary" v-on:click="uploadPress">Upload</button>
                <button class="btn btn-outline-danger ml-1" v-on:click="uploadClear">X</button>
            </div>
            <div v-else-if="setting.type === 'switch'">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" v-model="value" :id="'settings-'+setting.name" v-on:change="processUpdate">
                    <label class="custom-control-label" :for="'settings-'+setting.name"></label>
                </div>
            </div>
            <div v-else-if="setting.type === 'text'">
                <input type="text" class="form-control" v-model="value" v-on:change="processUpdate">
            </div>
            <div v-else-if="setting.type === 'password'">
                <input type="password" class="form-control" v-model="value" v-on:change="processUpdate">
            </div>
            <div v-else-if="setting.type === 'static'">
                <i class="fas fa-info-circle text-info"></i>
            </div>
        </div>
        <h4>{{ setting.text }}</h4>
        <p>{{ setting.description }}</p>
    </div>
</template>

<script>
import {getSettingValue, setSetting} from "../managers/SettingsManager";

export default {
    name: "SettingView",
    props: ['setting'],
    data() {
        return {value: null, saveState: -1}
    },
    beforeMount() {
        getSettingValue(this.setting.name).then(e => {
            this.value = e;
        });
    },
    methods: {
        uploadPress() {
            this.$refs.fileup.click();
        },
        processUpdate() {
            this.sendData(this.value.toString());
        },
        sendData(value) {
            this.saveState = 0;
            setSetting(this.setting.name, value, this.setting.hashed).then(e => {
                this.saveState = 1;
            }).catch(e => {
                this.saveState = 2;
                console.error(e);
            });
        },
        processUpload() {
            let f1 = this.$refs.fileup.files[0];
            f1.arrayBuffer().then(e => {
                let array = new Uint8Array(e);
                this.sendData('data:' + f1.type + ';base64,' + Buffer.from(array).toString('base64'));
            });
        },
        uploadClear() {
            if(confirm("Really clear this setting?"))
                this.sendData(null);
        }
    }
}
</script>

<style scoped>

</style>

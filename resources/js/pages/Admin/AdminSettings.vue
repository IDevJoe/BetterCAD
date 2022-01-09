<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" v-for="tab in tabs">
                <router-link :to="{name: 'admin.settings', params: {group: tab}}" class="nav-link" active-class="active">{{ tab }}</router-link>
            </li>
        </ul>
        <div class="mt-3">
            <div class="mb-5" v-for="group in currentGroupNames">
                <strong>{{ group }}</strong>
                <hr />
                <SettingView v-for="setting in currentGroups[group]" :setting="setting" :key="setting.name" />
            </div>
        </div>
    </div>
</template>

<script>
import AdminTemplate from "./AdminTemplate";
import Settings from '../../settings';
import SettingView from "../../components/SettingView";
export default {
    name: "AdminSettings",
    components: {SettingView, AdminTemplate},
    computed: {
        tabs() {
            return Object.keys(Settings);
        },
        currentGroupNames() {
            if(Settings[this.$route.params.group] === undefined) return [];
            return Object.keys(Settings[this.$route.params.group]);
        },
        currentGroups() {
            return Settings[this.$route.params.group];
        }
    },
    mounted() {
        if(this.$route.params.group == null) {
            this.$router.push('./settings/' + Object.keys(Settings)[0]);
        }
    }
}
</script>

<style scoped>

</style>

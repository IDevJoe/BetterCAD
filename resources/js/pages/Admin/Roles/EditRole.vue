<template>
    <div>
        <div v-if="role === null">
            <h1>Loading</h1>
            <router-link to="/admin/roles" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all roles</router-link>
        </div>
        <div v-else>
            <h1>{{ role.name }} (#{{ role.id }})</h1>
            <router-link to="/admin/roles" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all roles</router-link>
            <button class="btn btn-outline-danger btn-sm ml-2" v-on:click="deleteRole">Delete Role</button>
            <div class="row mt-4">
                <div class="col-md-6">
                    <strong>Role Sync</strong>
                    <div class="form-group">
                        <label for="discord_id">Discord Role ID</label>
                        <input type="text" class="form-control" id="discord_id" v-model="role.discord_id" v-on:change="modify">
                        <small class="text-muted">Syncs this role with Discord users when role sync is enabled</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Permissions</strong>
                    <div class="form-check" v-for="perm in avPerms">
                        <input class="form-check-input" type="checkbox" v-model="permAssign[perm]" v-on:change="() => updatePerm(perm)" :id="perm">
                        <label class="form-check-label" :for="perm">
                            {{ perm }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {getRole, modifyRole, changePermission, deleteRole} from "../../../api/Role";
import {AVAILABLE_PERMISSIONS} from "../../../api/User";

export default {
    name: "EditRole",
    data: () => ({
        role: null,
        permAssign: {}
    }),
    mounted() {
        getRole(this.$route.params.rid).then(e => {
            this.role = e;
            for(let perm in AVAILABLE_PERMISSIONS) {
                this.permAssign[AVAILABLE_PERMISSIONS[perm]] = this.role.permissions.indexOf(AVAILABLE_PERMISSIONS[perm]) !== -1;
            }
        });
    },
    computed: {
        avPerms() {
            return AVAILABLE_PERMISSIONS;
        }
    },
    methods: {
        modify() {
            modifyRole(this.$route.params.rid, this.role.discord_id).then(e => {
                this.role = e;
            }).catch(e => alert('Could not update role ID'));
        },
        updatePerm(perm) {
            changePermission(this.$route.params.rid, perm, this.permAssign[perm]).then(e => {
                this.role = e;
            }).catch(e => alert('Could not modify permission ' + perm + ' for role'));
        },
        deleteRole() {
            if(!confirm("Really delete this role?")) return;
            deleteRole(this.$route.params.rid).then(e => {
                this.$router.push('/admin/roles');
            });
        }
    }
}
</script>

<style scoped>

</style>

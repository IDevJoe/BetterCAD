<template>
    <div>
        <div v-if="user == null">
            <h1>Loading</h1>
            <router-link to="/admin/users" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all users</router-link>
        </div>
        <div v-else>
            <h1>{{ user.name }} (#{{ user.id }})</h1>
            <router-link to="/admin/users" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all users</router-link>
            <div class="alert alert-warning mt-4" v-if="isMe">
                <p v-if="!permsBypass"><i class="fas fa-exclamation-triangle"></i> You are editing yourself. Permission editing is disabled by default.
                You can re-enable this if you acknowledge that this is dangerous and could cause you to lose all permissions.</p>
                <span v-else><i class="fas fa-exclamation-triangle"></i> You are editing yourself. As dangerous as this is, you insist on continuing.</span>
                <button class="btn btn-warning" v-on:click="enablePerms" v-if="!permsBypass">Enable Permissions</button>
            </div>
            <form v-on:submit="changeUserSettings" class="mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="user.name" v-on:change="changeUserSettings" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" :value="user.email" disabled />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reset">Reset Password</label>
                            <button id="reset" class="btn btn-outline-info w-100">
                                <i class="fas fa-key mr-1"></i>
                                Reset User Password
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <hr />
            <h3>Permissions</h3>
            <p v-if="user.effectivePermissions.length > 0">
                {{ user.name }}'s effective permissions:
                <br><span class="badge badge-secondary mr-1" v-for="perm in user.effectivePermissions">{{ perm }}</span>
            </p>
            <p v-else>
                {{ user.name }} has no permissions. This means they can only view the home page.
            </p>
            <div class="row" v-if="!(isMe && !permsBypass)">
                <div class="col-md-6">
                    <strong>Manually Assign Permissions:</strong>
                    <div class="form-check" v-for="perm in availPerms">
                        <input class="form-check-input" type="checkbox" v-model="permAssign[perm]" v-on:change="() => updatePerm(perm)" :id="perm">
                        <label class="form-check-label" :for="perm">
                            {{ perm }}
                        </label>
                    </div>

                </div>
                <div class="col-md-6">
                    <strong>Manually Assign Roles:</strong>
                    <div class="form-check" v-for="role in roles">
                        <input class="form-check-input" type="checkbox" v-model="roleAssign[role.name]" :id="role.id">
                        <label class="form-check-label" :for="role.id">
                            {{ role.name }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {AVAILABLE_PERMISSIONS, getUser, changeName, changePerm} from "../../../api/User";
import {getAllRoles} from "../../../api/Role";

export default {
    name: "EditUser",
    computed: {
        userId() {
            return this.$route.params.uid;
        },
        me() {
            return this.$store.state.user;
        },
        availPerms() {
            return AVAILABLE_PERMISSIONS;
        },
        isMe() {
            return this.me.id === this.user.id;
        }
    },
    data() {
        return {
            user: null,
            permAssign: {},
            roleAssign: {},
            permsBypass: false,
            roles: [],
            f1s: -1
        }
    },
    mounted() {
        getUser(this.$route.params.uid).then(e => {
            this.user = e;
            for(let perm in AVAILABLE_PERMISSIONS) {
                this.permAssign[AVAILABLE_PERMISSIONS[perm]] = this.user.permissions.find(e => e.name === AVAILABLE_PERMISSIONS[perm]) !== undefined;
            }
        });
        getAllRoles().then(e => {
            this.roles = e;
        });
    },
    methods: {
        updatePerm(perm) {
            changePerm(this.$route.params.uid, perm, this.permAssign[perm]).then(e => {
                this.user = e;
            }).catch(e => alert('Could not change permission ' + perm + ' for user.'));
        },
        enablePerms() {
            let c = confirm("Are you sure you want to do this?");
            if(c) {
                this.permsBypass = true;
            }
        },
        changeUserSettings() {
            this.f1s = 0;
            changeName(this.$route.params.uid, this.user.name).then(e => {
                this.user = e;
                this.f1s = 1;
            }).catch(e => alert('Could not change name.'));
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <div v-if="user == null">
            <h1>Loading</h1>
            <router-link to="/admin/users" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all users</router-link>
        </div>
        <div v-else>
            <h1>{{ user.name }} (#{{ user.id }})</h1>
            <router-link to="/admin/users" class="btn btn-sm btn-outline-info"><i class="fas fa-arrow-left mr-1"></i>Back to all users</router-link>
            <div class="alert alert-warning mt-4" v-if="user.id === me.id">
                <i class="fas fa-exclamation-triangle"></i> You are editing yourself. If you remove permissions, you may be unable to get them back.
            </div>
            <form v-on:submit="changeUserSettings" class="mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="user.name" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="user.email" />
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
                <button class="btn btn-outline-info">Save</button>
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
            <div class="row">
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
                    <br />No available roles
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {AVAILABLE_PERMISSIONS, getUser} from "../../../api/User";

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
        }
    },
    data() {
        return {
            user: null,
            permAssign: {}
        }
    },
    mounted() {
        getUser(this.$route.params.uid).then(e => {
            this.user = e;
            for(let perm in AVAILABLE_PERMISSIONS) {
                this.permAssign[perm] = this.user.permissions.find(e => e.name === perm) !== undefined;
            }
        })
    },
    methods: {
        updatePerm(perm) {
            console.log(perm, this.permAssign[perm]);
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <h1>All Roles</h1>
        <button class="btn btn-outline-info" v-on:click="newRole"><i class="fas fa-plus-circle mr-2"></i> New Role</button>
        <table class="table table-sm mt-4">
            <thead>
            <tr>
                <th>Name</th>
                <th>Discord Role ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="roles === null">
                <td colspan="2">Loading</td>
            </tr>
            <tr v-else v-for="role in roles">
                <td>{{ role.name }}</td>
                <td>{{ role.discord_id == null ? 'Not Syncing' : role.discord_id }}</td>
                <td class="text-right">
                    <router-link :to="'/admin/roles/' + role.id" class="btn btn-outline-info btn-sm">Edit</router-link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {getAllRoles, createRole} from "../../api/Role";

export default {
    name: "RoleSettings",
    data: () => ({
        roles: null
    }),
    mounted() {
        getAllRoles().then(e => {
            this.roles = e;
        });
    },
    methods: {
        newRole() {
            let name = prompt('Enter new role name');
            if(!name) return;
            createRole(name).then(e => {
                this.$router.push('/admin/roles/' + encodeURIComponent(e.id));
            }).catch(e => alert('Failed to create role'));
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <router-view></router-view>
    <div v-if="this.$route.params.uid == null">
        <h1>User Listing</h1>
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="users === null">
                    <td colspan="3">Loading</td>
                </tr>
                <tr v-else v-for="user in users">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="text-right">
                        <router-link :to="'/admin/users/'+user.id" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-pen mr-1"></i>
                            Edit
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {getAllUsers} from "../../api/User";
import EditUser from "./User/EditUser";

export default {
    name: "UserSettings",
    components: {EditUser},
    data() {
        return {
            users: null
        }
    },
    mounted() {
        getAllUsers().then(e => {
            this.users = e;
        });
    }
}
</script>

<style scoped>

</style>

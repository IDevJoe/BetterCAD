<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <router-link to="/admin/home" active-class="active" class="nav-link">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'admin.settings'}" active-class="active" class="nav-link" v-if="cuser.effectivePermissions.indexOf('modify standard settings') !== -1">Main Settings</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/roles" active-class="active" class="nav-link" v-if="cuser.effectivePermissions.indexOf('modify roles') !== -1">Roles</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'admin.users'}" active-class="active" class="nav-link" v-if="cuser.effectivePermissions.indexOf('modify users') !== -1">Users</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/departments" active-class="active" class="nav-link" v-if="cuser.effectivePermissions.indexOf('modify departments') !== -1">Departments</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/audit-log" active-class="active" class="nav-link" v-if="cuser.effectivePermissions.indexOf('view audit logs') !== -1">Audit Log</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-md">
                <router-view />
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "AdminTemplate",
    computed: {
        cuser() {
            return this.$store.state.user;
        }
    }
}
</script>

<style scoped>

</style>

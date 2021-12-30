<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <router-link to="/admin" :exact="true" active-class="active" class="nav-link">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/settings" active-class="active" class="nav-link">Main Settings</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/discord" active-class="active" class="nav-link">Discord</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/users" active-class="active" class="nav-link">Users</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/departments" active-class="active" class="nav-link">Departments</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/audit-log" active-class="active" class="nav-link">Audit Log</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-md">
                <slot></slot>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "AdminTemplate"
}
</script>

<style scoped>

</style>

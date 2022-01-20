import Dashboard from './pages/Dashboard.vue';
import NotFound from './pages/NotFound.vue';
import AdminHome from './pages/Admin/AdminHome.vue';
import AdminSettings from './pages/Admin/AdminSettings.vue';
import AdminTemplate from "./pages/Admin/AdminTemplate.vue";
import UserSettings from './pages/Admin/UserSettings.vue';
import EditUser from './pages/Admin/User/EditUser.vue';
import RoleSettings from './pages/Admin/RoleSettings.vue';
import EditRole from './pages/Admin/Roles/EditRole.vue';
import CivilianDashboard from './pages/CivilianDashboard.vue';
import EditCiv from './pages/Civ/EditCiv.vue';
import VehicleList from './pages/Civ/VehicleList.vue';
import RecordsLookup from './pages/RecordsLookup.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: Dashboard
    },
    {
        path: '/civ',
        name: 'civilian',
        component: CivilianDashboard,
        children: [
            {
                path: ':cid',
                name: 'civilian.edit',
                component: EditCiv,
            },
            {
                path: ':cid/vehicles',
                name: 'civilian.edit.vehicles',
                component: VehicleList
            },
            {
                path: ':cid/weapons',
                name: 'civilian.edit.weapons',
                component: EditCiv
            }
        ]
    },
    {
        path: '/records',
        name: 'records',
        component: RecordsLookup
    },
    {
        path: '/admin',
        name: 'admin.index',
        component: AdminTemplate,
        children: [
            {
                path: 'home',
                name: 'home',
                component: AdminHome
            },
            {
                path: 'settings/:group?',
                name: 'admin.settings',
                component: AdminSettings
            },
            {
                path: 'users',
                name: 'admin.users',
                component: UserSettings,
                children: [
                    {
                        path: ':uid',
                        name: 'admin.users.edit',
                        component: EditUser
                    }
                ]
            },
            {
                path: 'roles',
                name: 'admin.roles',
                component: RoleSettings,
                children: [
                    {
                        path: ':rid',
                        name: 'admin.roles.edit',
                        component: EditRole
                    }
                ]
            }
        ]
    },
    {
        path: '/:catchAll(.*)',
        component: NotFound
    }
]

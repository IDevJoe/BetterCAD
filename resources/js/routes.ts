import Dashboard from './pages/Dashboard.vue';
import NotFound from './pages/NotFound.vue';
import AdminHome from './pages/Admin/AdminHome.vue';
import AdminSettings from './pages/Admin/AdminSettings.vue';
import AdminTemplate from "./pages/Admin/AdminTemplate.vue";
import UserSettings from './pages/Admin/UserSettings.vue';
import EditUser from './pages/Admin/User/EditUser.vue';
import RoleSettings from './pages/Admin/RoleSettings.vue';
import EditRole from './pages/Admin/Roles/EditRole.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: Dashboard
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
                component: UserSettings
            },
            {
                path: 'users/:uid',
                name: 'admin.users.edit',
                component: EditUser
            },
            {
                path: 'roles',
                name: 'admin.roles',
                component: RoleSettings
            },
            {
                path: 'roles/:rid',
                name: 'admin.roles.edit',
                component: EditRole
            }
        ]
    },
    {
        path: '/:catchAll(.*)',
        component: NotFound
    }
]

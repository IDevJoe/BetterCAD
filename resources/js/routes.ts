import Dashboard from './pages/Dashboard.vue';
import NotFound from './pages/NotFound.vue';
import AdminHome from './pages/Admin/AdminHome.vue';
import AdminSettings from './pages/Admin/AdminSettings.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: Dashboard
    },
    {
        path: '/admin',
        name: 'admin.index',
        component: AdminHome
    },
    {
        path: '/admin/settings/:group?',
        name: 'admin.settings',
        component: AdminSettings
    },
    {
        path: '/:catchAll(.*)',
        component: NotFound
    }
]

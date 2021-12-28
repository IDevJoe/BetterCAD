import Dashboard from './pages/Dashboard.vue';
import NotFound from './pages/NotFound.vue';
import AdminHome from './pages/Admin/AdminHome.vue';

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
        path: '/:catchAll(.*)',
        component: NotFound
    }
]

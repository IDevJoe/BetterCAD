import Pusher from 'pusher-js';
import Echo from 'laravel-echo';
import {createApp, App} from 'vue';
import Axios, {AxiosInstance} from 'axios';
import {RegisterAllComponents} from "./managers/ComponentManager";
import {Router, createRouter, createWebHistory} from 'vue-router';
import Routes from './routes';
import Store from './store';

import {LoDashStatic} from 'lodash';

require('@forevolve/bootstrap-dark/dist/js/bootstrap.min');

declare global {
    interface Window {
        _: LoDashStatic,
        axios: AxiosInstance,
        Pusher: Pusher,
        Echo: Echo,
        App: App,
        appVersion: string|undefined
    }
}

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = Axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.appVersion = process.env.MIX_APP_VERSION;

const router = createRouter({routes: Routes, history: createWebHistory()});
window.App = createApp({
    template: "<Main />",
    router
});
window.App.use(router);
window.App.use(Store);

RegisterAllComponents();

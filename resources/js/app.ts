/*
 *                        BetterCAD by idevjoe
 *                         Client entry point
 *
 *                  See LICENSE.txt for full license.
 */

// Bootstrap app
require('./bootstrap');

// Fetch CSRF token
window.axios.get('/sanctum/csrf-cookie').then(response => {
    window.App.mount("#app");
});

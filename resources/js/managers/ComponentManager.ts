import Vue from "vue";
import Components from '../components';

export function RegisterAllComponents() {
    Object.keys(Components).forEach((e) => {
        Vue.component(e, Components[e]);
        console.log("Registered " + e);
    });
}

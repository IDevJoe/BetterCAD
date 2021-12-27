import Components from '../components';

/**
 * Registers all components into Vue
 */
export function RegisterAllComponents() {
    Object.keys(Components).forEach((e) => {
        // @ts-ignore Typescript gets really angry with this line since
        // Components is not a set type.
        window.App.component(e, Components[e]);
        console.log("Registered " + e);
    });
}

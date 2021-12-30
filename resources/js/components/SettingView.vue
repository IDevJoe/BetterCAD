<template>
    <div>
        <div class="float-right">
            <div v-if="setting.type === 'file'">
                file
            </div>
            <div v-else-if="setting.type === 'switch'">
                sw
            </div>
            <div v-else-if="setting.type === 'text'">
                text
            </div>
            <div v-else-if="setting.type === 'password'">
                pasw
            </div>
        </div>
        <h4>{{ setting.text }}</h4>
        <p>{{ setting.description }}</p>
    </div>
</template>

<script>
export default {
    name: "SettingView",
    props: ['setting'],
    methods: {
        processUpdate() {

        }
    }
}
</script>

<style scoped>

</style>

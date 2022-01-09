<template>
    <div v-if="civilian != null">
        <h1>Edit Character</h1>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <CivForm :mod="this.civilian" :editmode="true" />
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {getCharacter} from "../../api/Character";
import CivForm from "../../components/CivForm";

export default {
    name: "EditCiv",
    components: {CivForm},
    data: () => ({
        civilian: null
    }),
    mounted() {
        getCharacter(this.$route.params.cid).then(e => {
            this.civilian = e;
        });
    }
}
</script>

<style scoped>

</style>

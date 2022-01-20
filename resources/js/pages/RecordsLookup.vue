<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-center">
                    Person Lookup
                </div>
                <div class="row">
                    <div class="col-md form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" v-model="personLookup.lname">
                    </div>
                    <div class="col-md form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" v-model="personLookup.fname">
                    </div>
                    <div class="col-md form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" v-model="personLookup.dob">
                    </div>
                </div>
                <button class="btn btn-outline-info w-100" v-on:click="lookupP">Query</button>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <hr />
        <div class="mt-3 d-flex justify-content-center">
            <div>
                <strong>OUTPUT </strong>
                <a href="https://github.com/IDevJoe/BetterCAD/wiki/Records-Lookup" target="_blank">(How do I read this?)</a>
            </div>
        </div>
        <div class="mt-3 output">
            {{ output }}
        </div>
    </div>
</template>

<script>
import {lookupPerson} from "../api/Character";

export default {
    name: "RecordsLookup",
    data: () => ({
        output: "ENTER QUERY",
        personLookup: {}
    }),
    methods: {
        lookupP() {
            lookupPerson(this.personLookup).then(e => {
                this.output = e;
            }).catch(e => {
                alert("Could not lookup person.");
                console.error(e);
            });
        }
    }
}
</script>

<style scoped>
    .output {
        white-space: pre;
        font-family: Consolas, serif;
    }
</style>

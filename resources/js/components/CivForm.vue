<template>
    <div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" v-model="mod.fname">
            </div>
            <div class="col-md-6 form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" v-model="mod.lname">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" v-model="mod.dob" :disabled="editmode">
            </div>
            <div class="col-md-4 form-group">
                <label for="hair_color">Hair Color</label>
                <select class="form-control" id="hair_color" v-model="mod.hair_color">
                    <option value="BLD">BLD - Bald</option>
                    <option value="BLK">BLK - Black</option>
                    <option value="BLN">BLN - Blond or Strawberry</option>
                    <option value="BLU">BLU - Blue</option>
                    <option value="BRO">BRO - Brown</option>
                    <option value="GRY">GRY - Gray or Partially Gray</option>
                    <option value="GRN">GRN - Green</option>
                    <option value="ONG">ONG - Orange</option>
                    <option value="PNK">PNK - Pink</option>
                    <option value="PLE">PLE - Purple</option>
                    <option value="RED">RED - Red or Auburn</option>
                    <option value="SDY">SDY - Sandy</option>
                    <option value="WHI">WHI - White</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="hair_color">Eye Color</label>
                <select class="form-control" id="eye_color" v-model="mod.eye_color" :disabled="editmode">
                    <option value="BLK">BLK - Black</option>
                    <option value="BLU">BLU - Blue</option>
                    <option value="BRO">BRO - Brown</option>
                    <option value="GRY">GRY - Gray</option>
                    <option value="GRN">GRN - Green</option>
                    <option value="MAR">MAR - Maroon</option>
                    <option value="PNK">PNK - Pink</option>
                    <option value="HAZ">HAZ - Hazel</option>
                    <option value="MUL">MUL - Multicolored</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" v-model="mod.address">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" v-model="mod.gender" :disabled="editmode">
                    <option value="M">M - Male</option>
                    <option value="F">F - Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="race">Race</label>
                <select id="race" class="form-control" v-model="mod.race" :disabled="editmode">
                    <option value="w">W - White</option>
                    <option value="I">I - American Indian or Alaskan Native</option>
                    <option value="A">A - Asian or Pacific Islander</option>
                    <option value="B">B - Black</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="height">Height in inches</label>
                <input type="number" id="height" class="form-control" v-model="mod.height">
            </div>
            <div class="col-md-6 form-group">
                <label for="weight">Weight in pounds</label>
                <input type="number" id="weight" class="form-control" v-model="mod.weight">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CivForm",
    props: ['mod', 'editmode']
}
</script>

<style scoped>

</style>

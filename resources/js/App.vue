<template>
    <b-container class="container">
        <router-view></router-view>
    </b-container>
</template>

<script>
export default {
    name: "templatePadrao",
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
.container {
    margin-top: 40px;
}

.form-control {
    margin-bottom: 10px;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

.multiselect__tags {
    height: 40px;
    display: block;
    padding: 0;
    border-radius: 5px;
    background: #fff;
    font-size: 14px;
    width: 100%;
    padding: 8px;
    border: 1px solid #ced4da;
}

.multiselect {
    margin-bottom: 15px;
}

.multiselect__tag {
    background: #198754;
}
</style>

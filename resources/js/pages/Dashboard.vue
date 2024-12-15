<script setup>

import DefaultLayout from "../layouts/DefaultLayout.vue";
import {onMounted} from "vue";

onMounted(async () => {
    const response = await axios.get('/api/v1/me');
    const data = response.data();

    console.log(data);
})
</script>

<template>
<DefaultLayout>
    123
</DefaultLayout>
</template>

<style scoped>

</style>

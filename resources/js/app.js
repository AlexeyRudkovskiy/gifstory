/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import Dashboard from "./pages/Dashboard.vue";

const app = createApp(Dashboard);

axios.get('/sanctum/csrf-cookie')
    .then(() => {
        app.mount('#app');
    });

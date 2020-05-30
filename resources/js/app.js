require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Vue from 'vue'
import App from './views/App'
import Home from './views/Home'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import store from './store'
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
import './bootstrap'
import Vue from 'vue'
import { BootstrapVue, NavbarPlugin } from 'bootstrap-vue'
import Index from "./components/Index"
import axios from "axios";

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = Vue

Vue.use(BootstrapVue)
Vue.use(NavbarPlugin)

const app = new Vue({
    el: '#app',
    components: {
        'index': Index,
    },
    data: {
        user: []
    },
});

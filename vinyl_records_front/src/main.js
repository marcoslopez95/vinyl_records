import Vue from 'vue'

import App from '@/App.vue'
import store from '@/store'
import router from '@/router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.config.productionTip = false


axios.defaults.baseURL = import.meta.env.VITE_APP_BACKEND;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app")
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from '../views/App.vue'
import Crud from '../views/Crud.vue'

Vue.use(VueRouter)
export default new VueRouter({
  mode: 'history',
    routes: [
        {
            path: '/',
            name: 'appexample',
            component: App
        },

        {
            path: '/uploadexcel',
            name: 'app',
            component: App
        },
        {
            path: '/api',
            name: 'api',
            component: Crud
        },

    ],
});
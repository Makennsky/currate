import Vue from 'vue'
import VueRouter from 'vue-router'
import index from '../views/index.vue'
import auth from '../views/auth.vue'
import mainRates from '../views/main-rates'
import pair from '../views/pair'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'index',
    component: auth
  },
    {
        path: '/main-rates',
        name: 'mainRates',
        component: mainRates
    },
    {
        path: '/pair/:id',
        name: 'pair',
        component: pair
    }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router

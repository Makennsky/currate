import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueCookies from 'vue-cookies'

import cookie from 'js-cookie'
import 'bootstrap/scss/bootstrap.scss'

Vue.use(cookie);
Vue.use(VueCookies)
Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: function (h) { return h(App) }
}).$mount('#app')

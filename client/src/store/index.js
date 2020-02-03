import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from 'vue-router'

Vue.use(Vuex, axios)

export default new Vuex.Store({
  state: {
      auth: {},
      token: null
  },
  mutations: {
      getToken(store, token) {
          store.token = token;
      },
      removeToken(store){
        store.token = null
      }
  },
    getters: {
        isLogged () {
            const session = Cookies.get('auth');
            if (!session) {
                this.$router.push('/auth');
            }
        }
    },
  actions: {
      async getToken({commit}, params) {
          let http = await axios
              .post('http://api.techgarden.tk/api/login', params)
              .then(res => {
                  return res.data.token;

              }).catch(error => {

                  console.log('http://api.techgarden.tk/api/login', error)
                  return false
              });
          commit('getToken', http);
          $cookies.set('auth', http)
          return http

      },
      async logout ({commit}, token) {
          await axios
              .post('logout', token)
              .then(res => {
                  let token = res.data.token;
                  commit('removeToken', token);
              });
      }
  },
})

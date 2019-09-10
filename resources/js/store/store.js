import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        token: "",
        user_id: 0,
        login: ""
    },
    mutations: {
        storeLogin(state, login) {
            state.login = login;
        }
    }
});

export default store;

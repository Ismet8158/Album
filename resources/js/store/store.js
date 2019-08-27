import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        token: "",
        user_id: 0
    },
    mutations: {
        storeToken(state, token) {
            state.token = token;
        },
        storeUserId(state, user_id) {
            state.user_id = user_id;
        }
    }
});

export default store;

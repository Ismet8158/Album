import Vue from "vue";
import App from "./components/App.vue";
import router from "./router/router.js";
import store from "./store/store.js";
import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

Vue.use(BootstrapVue);

const app = new Vue({
    el: "#app",
    router,
    store,
    render: h => h(App)
});

export default app;

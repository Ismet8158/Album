import Vue from "vue";
import Router from "vue-router";
import store from "./../store/store.js";
import App from "./../components/App.vue";
import Albums from "./../components/Albums.vue";
import Login from "./../components/Login.vue";
import Favorites from "./../components/Favorites.vue";
import Photos from "./../components/Photos.vue";
import Register from "./../components/Register.vue";
import Cookies from "js-cookie";
window.axios = require("axios");

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: "/",
            name: "home",
            component: App,
            meta: { requiresAuth: true }
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/favorites",
            name: "favorites",
            component: Favorites,
            meta: { requiresAuth: true }
        },
        {
            path: "/albums",
            name: "albums",
            component: Albums,
            meta: { requiresAuth: true }
        },
        {
            path: "/albums/:id",
            component: Photos,
            meta: { requiresAuth: true }
        },
        {
            path: "/register",
            name: "register",
            component: Register
        }
    ]
});

router.beforeEach((to, from, next) => {
    let bearer = Cookies.get("access_token");
    if (bearer) {
        window.axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${bearer}`;
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!Cookies.get("access_token")) {
            next({
                path: "/login"
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;

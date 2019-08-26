import Vue from "vue";
import Router from "vue-router";
import App from "./../components/App.vue";
import Home from "./../components/Home.vue";
import Albums from "./../components/Albums.vue";
import Login from "./../components/Login.vue";
import Favorites from "./../components/Favorites.vue";
import Photos from "./../components/Photos.vue";
import Register from "./../components/Register.vue";
import axios from "axios";

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
    if (to.matched.some(record => record.meta.requiresAuth)) {
        axios.get("/api/check").then(response => {
            //console.log(response.data);
            if (response.data === "not_authenticated") {
                next({
                    path: "/login"
                });
            } else {
                next();
            }
        });
        //next();
    } else {
        next();
    }
});

export default router;

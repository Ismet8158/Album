import Vue from "vue";
import Router from "vue-router";
import App from "./../components/App.vue";
import Home from "./../components/Home.vue";
import Albums from "./../components/Albums.vue";
import Login from "./../components/Login.vue";
import Favorites from "./../components/Favorites.vue";
import Photos from "./../components/Photos.vue";
import Register from "./../components/Register.vue";

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
            component: Favorites
        },
        {
            path: "/albums",
            name: "albums",
            component: Albums
        },
        {
            path: "/albums/:id",
            component: Photos
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
        if (localStorage.getItem("logged")) {
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

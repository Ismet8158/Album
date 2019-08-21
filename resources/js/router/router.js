import Vue from "vue";
import Router from "vue-router";
import App from "./../components/App.vue";
import Home from "./../components/Home.vue";
import Albums from "./../components/Albums.vue";
import Login from "./../components/Login.vue";
import Favorites from "./../components/Favorites.vue";
import Photos from "./../components/Photos.vue";

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: "/",
            component: App,
            meta: { requiresAuth: true }
        },
        {
            path: "/login",
            component: Login
        },
        {
            path: "/favorites",
            component: Favorites
        },
        {
            path: "/albums",
            component: Albums
        },
        {
            path: "/albums/:id",
            component: Photos
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (true) {
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

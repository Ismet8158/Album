<template>
  <b-row>
    <b-col>
      <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-navbar-brand>
          <router-link class="routerlink" to="/favorites">
            <img src width="30" height="30" />
          </router-link>
        </b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse class="navCollapse" id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item>
              <router-link class="routerlink" to="/albums">Альбомы</router-link>
            </b-nav-item>
            <b-nav-item>
              <router-link class="routerlink" to="/favorites">Избранное</router-link>
            </b-nav-item>
          </b-navbar-nav>
          <b-navbar-nav class="ml-auto">
            <b-nav-text>
              <span class="userName">{{userName}}</span>
            </b-nav-text>
            <b-nav-item v-if="userName" class="routerlink" @click="logout">Выйти</b-nav-item>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </b-col>
  </b-row>
</template>

<script>
import Cookies from "js-cookie";

export default {
  name: "navigation",
  computed: {
    userName() {
      return Cookies.get("user_name");
    }
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm;
    });
  },
  methods: {
    logout() {
      Cookies.remove("access_token");
      Cookies.remove("user_name");
      Cookies.remove("user_id");
      this.$router.replace("/login");
    }
  }
};
</script>

<style  scoped>
.routerlink,
.userName {
  color: #fff;
  text-decoration: none;
}
.routerlink:hover {
  color: lightgrey;
}
</style>

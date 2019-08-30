<template>
  <b-container id="app">
    <b-row>
      <b-col>
        <b-navbar toggleable="lg" type="dark" variant="primary">
          <b-navbar-brand>
            <router-link class="routerlink" to="/favorites">
              <img src alt width="30" height="30" />
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
    <b-row>
      <b-col>
        <router-view></router-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Login from "./Login.vue";

export default {
  name: "app",
  components: {
    Login
  },
  computed: {
    userName() {
      return this.$store.state.login;
    }
  },
  methods: {
    logout() {
      this.$store.commit("storeToken", "");
      this.$store.commit("storeUserId", "");
      this.$store.commit("storeLogin", "");
      axios
        .get(`/api/logout/${this.$store.state.user_id}`, {
          headers: { Authorization: `Bearer ${this.$store.state.token}` }
        })
        .then(response => {
          console.log(response.data);
          this.$router.push("/login");
        })
        .catch(error => {
          console.log(error);
        });
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

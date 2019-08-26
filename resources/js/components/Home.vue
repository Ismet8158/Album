<template>
  <b-container>
    <b-row>
      <b-col>
        <b-navbar toggleable="lg" type="dark" variant="primary">
          <b-navbar-brand>
            <router-link class="routerlink" to="/">
              <img src alt width="30" height="30" />
            </router-link>
          </b-navbar-brand>
          <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
          <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
              <b-nav-item>
                <router-link class="routerlink" to>Альбомы</router-link>
              </b-nav-item>
              <b-nav-item>
                <router-link class="routerlink" to="/favorites">Избранное</router-link>
              </b-nav-item>
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
export default {
  name: "home",
  data() {
    return {};
  },
  created(){
    this.$router.replace("/favorites");
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.$router.replace("/favorites");
    });
  }
};
</script>

<style scoped>
.routerlink {
  color: #fff;
  text-decoration: none;
}
.routerlink:hover {
  color: lightgrey;
}
</style>

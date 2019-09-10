<template>
  <b-container id="app">
    <b-row>
      <b-col>
        <router-view></router-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  name: "app",
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.$router.replace("/favorites");
    });
  }
};
</script>

<style  scoped>
#app,
html,
body {
  height: 100%;
}
</style>

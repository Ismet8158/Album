<template>
  <b-container class="loginContainer">
    <b-card title="Авторизация">
      <b-row>
        <b-col>
          <input type="text" placeholder="Логин" required />
          <input type="password" placeholder="Пароль" required />
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <button @click="onSubmit()">Войти</button>
        </b-col>
        <b-col>
          <router-link to="/register">Зарегистрироваться</router-link>
        </b-col>
      </b-row>
    </b-card>
  </b-container>
</template>

<script>
export default {
  name: "login",
  data() {
    return {};
  },
  methods: {
    onSubmit() {
      localStorage.setItem("logged", true);
      this.$router.push("/");
    }
  }
};
</script>

<style scoped>
.loginContainer {
  padding: 0;
}
</style>

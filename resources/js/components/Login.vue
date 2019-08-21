<template>
  <b-container class="loginContainer">
    <b-card title="Авторизация">
      <b-form @submit="onSubmit">
        <b-form-row>
          <b-col>
            <b-form-input type="text" placeholder="Логин" required></b-form-input>
            <b-form-input type="password" placeholder="Пароль" required></b-form-input>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-button type="submit">Войти</b-button>
          </b-col>
          <b-col>
            <router-link to>Зарегистрироваться</router-link>
          </b-col>
        </b-form-row>
      </b-form>
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
      this.$router.replace("/");
    }
  }
};
</script>

<style scoped>
.loginContainer {
  padding: 0;
}
</style>

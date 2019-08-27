<template>
  <b-card title="Авторизация">
    <b-row>
      <b-col>
        <input type="text" v-model="user.login" placeholder="Логин" required />
        <input type="password" v-model="user.password" placeholder="Пароль" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <button @click="onSubmit()">Войти</button>
      </b-col>
      <b-col>
        <label for="remember">Запомнить меня</label>
        <input id="remember" type="checkbox" v-model="user.remember" />
      </b-col>
      <b-col>
        <router-link to="/register">Зарегистрируйтесь</router-link>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <span class="error">{{error}}</span>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import axios from "axios";

export default {
  name: "login",
  data() {
    return {
      error: "",
      user: {
        login: "",
        password: "",
        remember: false
      }
    };
  },
  methods: {
    onSubmit() {
      axios
        .post("/api/login", this.user)
        .then(response => {
          if (response.data.token !== undefined) {
            this.$store.commit("storeToken", response.data.token);
            this.$store.commit("storeUserId", response.data.user_id);
            this.$router.replace("/albums");
          } else {
            this.error = response.data;
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.error {
  color: crimson;
}
</style>

<template>
  <b-container class="loginForm" fluid>
    <div>
      <b-row>
        <b-col>
          <h3>Авторизация</h3>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <input type="text" v-model="user.login" placeholder="Логин" required />
          <input type="password" v-model="user.password" placeholder="Пароль" required />
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <button @click="onSubmit()">Войти</button>
          <router-link to="/register">Зарегистрируйтесь</router-link>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <span class="error">{{error}}</span>
        </b-col>
      </b-row>
    </div>
  </b-container>
</template>

<script>
import axios from "axios";
import Cookies from "js-cookie";

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
            Cookies.set("access_token", response.data.token, { expires: 2 });
            Cookies.set("user_id", response.data.user_id, { expires: 2 });
            Cookies.set("user_name", response.data.login, { expires: 2 });
            this.$store.commit("storeLogin", response.data.login);
            this.$router.push("/albums");
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
.loginForm {
  display: flex;
  justify-content: center;
  align-content: center;
}
.error {
  color: crimson;
}
</style>

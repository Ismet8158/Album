<template>
  <b-card title="Регистрация">
    <b-row>
      <b-col>
        <input v-model="user.login" type="text" placeholder="Логин" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <input v-model="user.password" type="password" placeholder="Пароль" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <input v-model="user.email" type="text" placeholder="Почта" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <input
          id="confirmedPassword"
          v-model="user.confirmedPassword"
          type="password"
          placeholder="Подтвердите пароль"
          required
        />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <button @click="onSubmit">Зарегистрироваться</button>
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
  name: "register",
  data() {
    return {
      error: "",
      user: {
        login: "",
        email: "",
        password: "",
        confirmedPassword: ""
      }
    };
  },
  methods: {
    onSubmit() {
      axios
        .post("/api/register", this.user)
        .then(response => {
          if (response.data === undefined) {
            this.error = Object.values(response.data).join(" ");
          } else this.$router.replace("/login");
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

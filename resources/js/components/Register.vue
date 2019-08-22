<template>
  <b-card title="Регистрация">
    <b-row>
      <b-col>
        <input v-model="login" type="text" placeholder="Логин" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <input v-model="password" type="password" placeholder="Пароль" required />
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <input
          id="confirmedPassword"
          v-model="confirmedPassword"
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
      login: "",
      password: "",
      confirmedPassword: ""
    };
  },
  methods: {
    onSubmit() {
      if (this.password === this.confirmedPassword) {
      } else this.error = "Пароли не совпадают";
    }
  }
};
</script>

<style scoped>
.error {
  color: crimson;
}
</style>

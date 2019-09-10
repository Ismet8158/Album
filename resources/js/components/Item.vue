<template>
  <b-card>
    <b-card-text>{{photo.title}}</b-card-text>
    <b-card-img :src="photo.url"></b-card-img>
    <button @click="handler(photo.id)" :disabled="disable">{{buttonText}}</button>
  </b-card>
</template>

<script>
import axios from "axios";
import Cookies from "js-cookie";

export default {
  name: "item",
  props: {
    photo: {},
    buttonText: "",
    permission: ""
  },
  data() {
    return {
      disable: false,
      user_id: ""
    };
  },
  created() {
    if (this.permission) {
      this.user_id = Cookies.get("user_id");
      axios
        .get(`/api/favorites/${this.user_id}`)
        .then(response => {
          response.data.filter(element => {
            if (element.id === this.photo.id) this.disableOn();
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  methods: {
    handler(photo_id) {
      this.$emit("buttonClick", photo_id);
    },
    disableOn() {
      this.disable = true;
    }
  }
};
</script>

<style scoped>
</style>

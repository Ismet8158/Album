<template>
  <b-card>
    <b-card-img :src="photo.url"></b-card-img>
    <button @click="handler(photo.id)" :disabled="disable">{{buttonText}}</button>
  </b-card>
</template>

<script>
import axios from "axios";

export default {
  name: "item",
  props: {
    photo: {},
    buttonText: "",
    permission: ""
  },
  data() {
    return {
      disable: false
    };
  },
  created() {
    if (this.permission) {
      axios
        .get(`/api/favorites/${this.$store.state.user_id}`, {
          headers: { Authorization: `Bearer ${this.$store.state.token}` }
        })
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

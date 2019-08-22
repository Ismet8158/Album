<template>
  <b-card title="Альбомы">
    <b-row v-if="!albums">
      <b-col class="d-flex justify-content-center">
        <b-spinner></b-spinner>
      </b-col>
    </b-row>
    <div v-else>
      <b-row v-for="album in albums" :key="album.id">
        <b-col>
          <router-link :to="`/albums/${album.id}`">{{album.title}}</router-link>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <router-view></router-view>
        </b-col>
      </b-row>
    </div>
  </b-card>
</template>

<script>
import axios from "axios";

export default {
  name: "albums",
  data() {
    return {
      loading: true,
      albums: null
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios
        .get("/api/albums")
        .then(response => {
          this.albums = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.albumsContainer {
  padding: 0;
}
</style>

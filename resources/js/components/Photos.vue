<template>
  <b-card :title="title">
    <b-row v-if="!photos">
      <b-col class="d-flex justify-content-center">
        <b-spinner></b-spinner>
      </b-col>
    </b-row>
    <div v-else>
      <b-row>
        <b-col>
          <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>
          <b-card-group deck>
            <b-card :key="photo.id" v-for="photo in photoList" :title="photo.title">
              <b-card-img :src="photo.url"></b-card-img>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </b-card>
</template>

<script>
import axios from "axios";

export default {
  name: "favorites",
  data() {
    return {
      photos: null,
      perPage: 2,
      currentPage: 1,
      title: ""
    };
  },
  computed: {
    rows() {
      return this.photos.length;
    },
    photoList() {
      return this.photos.slice(
        (this.currentPage - 1) * this.perPage,
        this.currentPage * this.perPage
      );
    }
  },
  created() {
    this.fetchTitle();
  },
  methods: {
    fetchTitle() {
      axios
        .get(`/api/album/${this.$route.params.id}`)
        .then(response => {
          this.title = response.data[0].title;
          this.fetchData();
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchData() {
      axios
        .get(`/api/albums/${this.$route.params.id}`)
        .then(response => {
          this.photos = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.photosContainer {
  padding: 0;
}
</style>

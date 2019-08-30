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
            <Item
              :key="photo.id"
              v-for="photo in photoList"
              :photo="photo"
              buttonText="Добавить"
              @buttonClick="addToFavorites"
              permission="true"
              :ref="`button${photo.id}`"
            />
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </b-card>
</template>

<script>
import axios from "axios";
import Item from "./Item.vue";

export default {
  name: "favorites",
  components: {
    Item
  },
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
        .get(`/api/album/${this.$route.params.id}`, {
          headers: { Authorization: `Bearer ${this.$store.state.token}` }
        })
        .then(response => {
          this.title = response.data;
          this.fetchData();
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchData() {
      axios
        .get(`/api/albums/${this.$route.params.id}`, {
          headers: { Authorization: `Bearer ${this.$store.state.token}` }
        })
        .then(response => {
          this.photos = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    addToFavorites(id) {
      this.disable = true;
      axios
        .post(
          "/api/addfavorites",
          { photo_id: id, user_id: this.$store.state.user_id },
          {
            headers: { Authorization: `Bearer ${this.$store.state.token}` }
          }
        )
        .then(response => {
          this.$refs[`button${id}`][0].disableOn();
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

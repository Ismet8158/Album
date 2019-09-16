<template>
  <b-container fluid>
    <Navigation />
    <b-row>
      <b-col>
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
                    :allowsToAdd="allowsToAdd"
                    :ref="`button${photo.id}`"
                  />
                </b-card-group>
              </b-col>
            </b-row>
          </div>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import axios from "axios";
import Item from "./Item.vue";
import Navigation from "./Navigation.vue";
import Cookies from "js-cookie";

export default {
  name: "favorites",
  components: {
    Item,
    Navigation
  },
  data() {
    return {
      photos: null,
      perPage: 2,
      currentPage: 1,
      title: "",
      user_id: "",
      allowsToAdd: true
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
    this.user_id = Cookies.get("user_id");
    this.fetchTitle();
  },
  methods: {
    fetchTitle() {
      axios
        .get(`/api/album/${this.$route.params.id}`)
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
        .get(`/api/albums/${this.$route.params.id}`)
        .then(response => {
          this.photos = response.data.photos;
          if (response.data.admin) this.allowsToAdd = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    addToFavorites(id) {
      this.$refs[`button${id}`][0].disableOn();
      axios
        .post("/api/addfavorites", {
          photo_id: id,
          user_id: this.user_id
        })
        .then(response => {
          console.log(response.data);
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

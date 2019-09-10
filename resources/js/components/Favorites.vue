<template>
  <b-container fluid>
    <Navigation />
    <b-row>
      <b-col>
        <b-card title="Избранное">
          <b-row v-if="!favorites">
            <b-col class="d-flex justify-content-center">
              <span>Список пуст</span>
            </b-col>
          </b-row>
          <div v-else>
            <b-row>
              <b-col>
                <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>
                <b-card-group deck>
                  <Item
                    :key="favorite.id"
                    v-for="favorite in photoList"
                    :photo="favorite"
                    buttonText="Удалить"
                    @buttonClick="deleteFavorites"
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
      favorites: null,
      perPage: 2,
      currentPage: 1,
      user_id: ""
    };
  },
  computed: {
    rows() {
      return this.favorites.length;
    },
    photoList() {
      return this.favorites.slice(
        (this.currentPage - 1) * this.perPage,
        this.currentPage * this.perPage
      );
    }
  },
  created() {
    this.user_id = Cookies.get("user_id");
    this.getFavorites();
  },
  methods: {
    getFavorites() {
      axios
        .get(`/api/favorites/${this.user_id}`)
        .then(response => {
          this.favorites = response.data.length ? response.data : null;
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteFavorites(id) {
      axios
        .post("/api/favorites", {
          photo_id: id,
          user_id: this.user_id
        })
        .then(response => {
          this.getFavorites();
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
</style>

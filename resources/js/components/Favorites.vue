<template>
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
      favorites: null,
      perPage: 2,
      currentPage: 1
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
    this.getFavorites();
  },
  methods: {
    getFavorites() {
      axios
        .get(`/api/favorites/${this.$store.state.user_id}`, {
          headers: { Authorization: `Bearer ${this.$store.state.token}` }
        })
        .then(response => {
          this.favorites = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteFavorites(id) {
      axios
        .post(
          "/api/favorites",
          { photo_id: id, user_id: this.$store.state.user_id },
          {
            headers: { Authorization: `Bearer ${this.$store.state.token}` }
          }
        )
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

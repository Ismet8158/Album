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
            <b-card :key="photo.id" v-for="photo in photoList" :title="photo.title">
              <b-card-img :src="photo.url"></b-card-img>
              <button @click="deleteFavorites(photo.id)" :disabled="disable">Удалить</button>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </b-card>
</template>

<script>
export default {
  name: "favorites",
  data() {
    return {
      favorites: null,
      perPage: 2,
      currentPage: 1,
      disable: false
    };
  },
  created() {
    this.getFavorites();
  },
  methods: {
    rows() {
      return this.photos.length;
    },
    photoList() {
      return this.favorites.slice(
        (this.currentPage - 1) * this.perPage,
        this.currentPage * this.perPage
      );
    },
    getFavorites() {}
  }
};
</script>

<style scoped>
</style>

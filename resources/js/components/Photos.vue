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
          <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="photos"
          ></b-pagination>
          <b-table id="photos" :items="photos" :per-page="perPage" :current-page="currentPage"></b-table>
        </b-col>
      </b-row>
    </div>
  </b-card>
</template>

<script>
export default {
  name: "favorites",
  props: {
    title: String
  },
  computed: {
    rows() {
      return this.items.length;
    }
  },
  data() {
    return {
      photos: null,
      perPage: 3,
      currentPage: 1
    };
  }
};
</script>

<style scoped>
.photosContainer {
  padding: 0;
}
</style>

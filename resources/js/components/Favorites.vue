<template>
  <b-container v-if="loading" class="favoritesContainer" fluid>
    <b-card title="Избранное">
      <b-row v-if="loading">
        <b-col class="d-flex justify-content-center">
          <b-spinner></b-spinner>
        </b-col>
      </b-row>
    </b-card>
  </b-container>
</template>

<script>
export default {
  name: "favorites",
  data() {
    return {
      loading: true
    };
  }
};
</script>

<style scoped>
.favoritesContainer {
  padding: 0;
}
</style>

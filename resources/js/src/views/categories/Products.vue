<template>
  <div id="category-page">
    <!-- JUMBOTRON -->
    <div class="category-jumbotron">
      <div class="category-jumbotron-content p-8 rounded-lg mb-base">
        <h1 class="mb-1">Buscar producto en {{category.category}}</h1>

        <vs-input
          icon-no-border
          placeholder="Busque por nombre de producto o marca"
          v-model="productSearchQuery"
          icon-pack="feather"
          icon="icon-search"
          size="large"
          class="w-full mt-6"
        />
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full md:w-2/5 lg:w-1/4">
        <vx-card :title="category.category">
          <ul class="bordered-items">
            <li
              v-for="subcategory in category.subcategory"
              :key="subcategory.id"
              class="py-2"
            >{{ subcategory.category }}</li>
            <li class="py-2">Todos</li>
          </ul>
        </vx-card>
      </div>
      <div class="vx-col w-full md:w-3/5 lg:w-3/4">
        <product-list
          v-for="subcategory in category.subcategory"
          :key="subcategory.id"
          class="py-2 mb-4"
          :subcategory="subcategory"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ProductList from "./ProductList.vue";
export default {
  data() {
    return {
      productSearchQuery: ""
    };
  },
  props: ["id"],
  computed: {
    ...mapGetters("category", ["category"])
  },
  methods: {
    ...mapActions("category", ["fetchCategory"])
  },
  created() {
    this.fetchCategory(this.id);
  },
  components: { ProductList }
};
</script>

<style>
</style>
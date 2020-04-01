<template>
  <div id="category-page">
    <product-sidebar
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />
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
        <vx-card title="Marcas">
          <ul class="bordered-items">
            <li v-for="brand in brands" :key="brand.id" class="py-2">
              <vs-checkbox>{{ brand.name }}</vs-checkbox>
            </li>
          </ul>
        </vx-card>
        <vs-button type="border" text-color="#7367F0" @click="handleBack">Volver</vs-button>
      </div>
      <div class="vx-col w-full md:w-3/5 lg:w-3/4">
        <div v-if="products">
          <vx-card :title="category.category" :subtitle="available + ' items disponibles'">
            <div slot="actions">
              <div class="vx-card__action-buttons">
                <vs-button
                  radius
                  color="primary"
                  type="filled"
                  icon-pack="feather"
                  icon="icon-plus"
                  @click="addNewData(category.id)"
                ></vs-button>
              </div>
            </div>
            <div class="vx-row">
              <product-view v-for="product in products.data" :key="product.id" :product="product"></product-view>
            </div>
          </vx-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ProductView from "./ProductView.vue";
import ProductSidebar from "./ProductSidebar.vue";
export default {
  data() {
    return {
      productSearchQuery: "",
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
      brands: []
    };
  },
  props: ["id"],
  computed: {
    ...mapGetters("category", ["category"]),
    ...mapGetters("products", ["getProducts"]),
    products() {
      return this.getProducts(this.id);
    },
    available() {
      return this.products ? this.products.total : 0;
    }
  },
  methods: {
    ...mapActions("category", ["fetchCategory"]),
    ...mapActions("products", ["fetchProducts", "fetchProductBrands"]),
    addNewData(category_id) {
      this.sidebarData = {
        category_id: category_id
      };
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
    handleBack(fallback) {
      this.$router.back();
    }
  },
  created() {
    this.fetchCategory(this.id);
    this.fetchProducts(this.id, 50);
    this.fetchProductBrands(this.id).then(brands => {
      this.brands = brands;
    });
  },
  components: { ProductView, ProductSidebar }
};
</script>

<style>
</style>
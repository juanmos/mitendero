<template>
  <vx-card :title="subcategory.category">
    <div slot="actions">
      <vs-button
        radius
        color="primary"
        type="filled"
        icon-pack="feather"
        icon="icon-plus"
        @click="openSidebar(subcategory.id)"
      ></vs-button>
    </div>
    <product-view v-for="product in products.data" :key="product.id" :product="product"></product-view>
  </vx-card>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import ProductView from "./ProductView.vue";
export default {
  props: ["subcategory", "openSidebar"],
  data() {
    return {
      products: []
    };
  },
  methods: {
    ...mapActions("products", ["fetchProducts"])
  },
  computed: {
    // ...mapGetters("products", ["products"])
  },
  created() {
    this.fetchProducts(this.subcategory.id).then(products => {
      this.products = products;
    });
  },
  components: { ProductView }
};
</script>

<style>
</style>
<template>
  <vx-card :title="subcategory.category" :subtitle="available + ' items disponibles'">
    <div slot="actions" v-if="viewType === 'admin'">
      <div class="vx-card__action-buttons">
        <vs-button
          radius
          color="primary"
          type="filled"
          icon-pack="feather"
          icon="icon-plus"
          @click="openSidebar(subcategory.id)"
        ></vs-button>
        <vs-button
          radius
          color="success"
          type="border"
          icon-pack="feather"
          icon="icon-eye"
          @click="openAll(subcategory.id)"
        ></vs-button>
      </div>
    </div>
    <div class="vx-row" v-if="products">
      <product-view class="product"
        v-for="product in products.data"
        :key="product.id"
        :product="product"
        :editData="editData"
        limit="6"
      ></product-view>
    </div>
  </vx-card>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import ProductView from "./ProductView.vue";
export default {
  props: ["subcategory", "openSidebar", "editData"],
  data() {
    return {
      viewType: 'client',
      rol: this.$store.getters["auth/getRol"]
    };
  },
  methods: {
    ...mapActions("products", ["fetchProducts"]),
    openAll(subcategory) {
      this.$router.push({
        name: "admin.categories.subcategory.all",
        params: { id: subcategory }
      });
    }
  },
  computed: {
    products() {
      return this.getProducts(this.subcategory.id);
    },
    available() {
      return this.products ? this.products.total : 0;
    },
    ...mapGetters("products", ["getProducts"])
  },
  beforeMount() {
    this.fetchProducts({ category_id: this.subcategory.id, limit: 6 });
  },
  created () {
    this.viewType = (this.$route.params._type === 'client=true') ? 'client' : 'admin'
  },
  components: { ProductView }
};
</script>

<style>
.product {
  /*max-width: 128px;
  max-height: 100px; */
}
</style>

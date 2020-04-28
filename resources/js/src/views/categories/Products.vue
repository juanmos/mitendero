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
        <vs-button
          radius
          color="primary"
          type="border"
          icon-pack="feather"
          icon="icon-arrow-left"
          @click="handleBack"
        ></vs-button>
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
            <li v-for="subcategory in category.subcategory" :key="subcategory.id" class="py-2">
              <router-link
                :to="{name:prefix+'.categories.subcategory.all', params:{id:subcategory.id}}"
              >{{ subcategory.category }}</router-link>
            </li>
            <li class="py-2">Todos</li>
          </ul>
        </vx-card>
      </div>
      <div class="vx-col w-full md:w-3/5 lg:w-3/4">
        <div slot="actions" v-if="viewType === 'client'" style="margin-bottom: 15px;">
          <div class="vx-card__action-buttons">
            <vs-button
              size="small"
              color="orange"
              type="filled"
              icon-pack="feather"
              icon="icon-plus"
              @click="goToShoppingCar()"
            >IR AL CARRITO</vs-button>
          </div>
        </div>
        <product-list
          v-for="subcategory in category.subcategory"
          :key="subcategory.id"
          class="py-2 mb-4"
          :subcategory="subcategory"
          :openSidebar="addNewData"
          :editData="editData"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ProductList from "./ProductList.vue";
import ProductSidebar from "./ProductSidebar.vue";
export default {
  data() {
    return {
      productSearchQuery: "",
      // Data Sidebar
      viewType: 'client',
      addNewDataSidebar: false,
      sidebarData: {}
    };
  },
  props: ["id"],
  computed: {
    ...mapGetters("category", ["category"]),
    prefix() {
      return this.$store.getters["auth/getPrefix"];
    }
  },
  methods: {
    ...mapActions("category", ["fetchCategory"]),
    addNewData(category_id) {
      this.sidebarData = {
        category_id: category_id,
        limit: 6
      };
      this.toggleDataSidebar(true);
    },
    editData(data) {
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
    handleBack(fallback) {
      this.$router.back();
    },
    goToShoppingCar () {
      this.$router.push(`/shopping-list`)
    }
  },
  created() {
    this.fetchCategory(this.id);
    this.viewType = (this.$route.params._type === 'client=true') ? 'client' : 'admin'
  },
  components: { ProductList, ProductSidebar }
};
</script>

<style>
</style>

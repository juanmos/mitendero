<!-- =========================================================================================
    File Name: KnowledgeBase.vue
    Description: Knowledge Base Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div id="category-page">
    <!-- JUMBOTRON -->
    <div class="category-jumbotron">
      <div class="category-jumbotron-content p-8 rounded-lg mb-base">
        <h1 class="mb-1">Buscar categoria</h1>

        <vs-input
          icon-no-border
          placeholder="Busque por categoria"
          v-model="categorySearchQuery"
          icon-pack="feather"
          icon="icon-search"
          size="large"
          class="w-full mt-6"
        />
      </div>
    </div>

    <!-- KNOWLEDGE BASE CARDS  -->
    <div class="vx-row">
      <div
        class="vx-col w-full md:w-1/4 sm:w-1/2 mb-base"
        v-for="item in filteredCategories"
        :key="item.id"
        @click="$router.push(item.url).catch(() => {})"
      >
        <vx-card class="text-center cursor-pointer">
          <div class="category">
            <div class="category-info">
              <p class="font-semibold">
                <router-link
                  :to="{name:prefix+'.categories.subcategory', params:{id:item.id}}"
                >{{ item.category.toUpperCase() }}</router-link>
              </p>
              <span class="activity-desc">{{ item.desc }}</span>
            </div>
            <div class="category-icon">
              <img
                :src="item.icon"
                alt="graphic"
                width="60"
                class="mx-auto mb-4"
                svgClasses="text-white stroke-current w-5 h-5"
              />
            </div>
          </div>
          <ul class="bordered-items">
            <li
              v-for="subcategory in item.subcategory"
              :key="subcategory.id"
              class="py-2 text-left"
            >
              <router-link
                :to="{name:prefix+'.categories.subcategory', params:{id:subcategory.category_id}}"
              >{{ subcategory.category }}</router-link>
            </li>
          </ul>
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      categorySearchQuery: "",
      kb: []
    };
  },
  computed: {
    filteredCategories() {
      return this.categories.filter(
        item =>
          item.category
            .toLowerCase()
            .includes(this.categorySearchQuery.toLowerCase()) ||
          item.subcategory.some(subcategory =>
            subcategory.category
              .toLowerCase()
              .includes(this.categorySearchQuery.toLowerCase())
          )
      );
    },
    prefix() {
      return this.$store.getters["auth/getPrefix"];
    },
    ...mapGetters("category", ["categories"])
  },
  methods: {
    ...mapActions("category", ["fetchCategories"])
  },
  components: {},
  created() {
    this.fetchCategories();
  }
};
</script>

<style lang="scss" scoped>
.category {
  display: inline-block;
  height: 30px;
  .category-icon {
    position: absolute;
    top: 0;
    right: 10px;
    border-radius: 50%;
    padding: 0.75rem;
    padding-bottom: 0.4rem;
    float: right;
    border-color: black;
    border-width: 1px;
  }
  .category-info {
    float: left;
  }
}

.category-jumbotron-content {
  //   background-image: url("../../assets/images/pages/knowledge-base-cover.jpg");
  background-size: cover;
}
</style>

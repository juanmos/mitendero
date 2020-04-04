<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-sidebar
    click-not-close
    position-right
    parent="body"
    default-index="1"
    color="primary"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>{{ isNew() ? $t('newProduct') : $t('updateProduct') }}</h4>
      <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <VuePerfectScrollbar class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">
      <div class="p-6">
        <!-- NAME -->
        <vs-input
          :label="$t('productName')"
          v-model="name"
          class="mt-5 w-full"
          name="productName"
          v-validate="'required'"
        />
        <span
          class="text-danger text-sm"
          v-show="errors.has('productName')"
        >{{ errors.first('productName') }}</span>
        <div class="vs-component vs-con-input-label vs-input mt-5 w-full vs-input-primary">
          <label class="vs-input--label">{{$t('brand')}}</label>
          <vue-simple-suggest
            pattern="\w+"
            v-model="brand"
            :label="$t('brand')"
            :list="getBrands"
            :max-suggestions="10"
            :min-length="3"
            :debounce="200"
            :filter-by-query="false"
            :prevent-submit="true"
            :controls="{
                selectionUp: [38, 33],
                selectionDown: [40, 34],
                select: [13, 36],
                hideList: [27, 35]
            }"
            mode="input"
            :nullable-select="true"
            ref="suggestComponent"
            placeholder="Search information..."
            value-attribute="id"
            display-attribute="name"
            @select="onSuggestSelect"
          >
            <div class="g">
              <input type="text" v-model="brand_name" />
            </div>

            <div
              class="misc-item"
              slot="misc-item-below"
              slot-scope="{ suggestions }"
              v-if="loading"
            >
              <span>Loading...</span>
            </div>
          </vue-simple-suggest>
        </div>

        <vs-input
          :label="$t('price')"
          v-model="price"
          class="mt-5 w-full"
          name="price"
          v-validate="'required'"
        />
        <span class="text-danger text-sm" v-show="errors.has('price')">{{ errors.first('price') }}</span>

        <vs-input
          :label="$t('presentation')"
          v-model="presentation"
          class="mt-5 w-full"
          name="presentation"
          v-validate="'required'"
        />
        <span
          class="text-danger text-sm"
          v-show="errors.has('presentation')"
        >{{ errors.first('presentation') }}</span>

        <vs-input
          :label="$t('description')"
          v-model="description"
          class="mt-5 w-full"
          name="description"
        />
        <span
          class="text-danger text-sm"
          v-show="errors.has('description')"
        >{{ errors.first('description') }}</span>

        <vs-input
          :label="$t('ingredients')"
          v-model="ingredients"
          class="mt-5 w-full"
          name="ingredients"
        />
        <span
          class="text-danger text-sm"
          v-show="errors.has('ingredients')"
        >{{ errors.first('ingredients') }}</span>
        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full mb-2">
            <vs-input
              type="file"
              :label="$t('photos')"
              class="mt-5 w-full"
              name="photo"
              @change="onFileChanged"
            />
            <div class="preview">
              <img v-if="urlPhoto" :src="urlPhoto" />
            </div>
          </div>
          <div class="vx-col sm:w-1/2 w-full mb-2">
            <vs-input
              type="file"
              :label="$t('nutritionalFacts')"
              class="mt-5 w-full"
              name="photo"
              @change="onFileNutsChanged"
            />
            <div class="preview">
              <img v-if="urlNut" :src="urlNut" />
            </div>
          </div>
        </div>
      </div>
    </VuePerfectScrollbar>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">{{$t('save')}}</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">{{$t('cancel')}}</vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import { mapState, mapActions } from "vuex";
import VueSimpleSuggest from "vue-simple-suggest";
import "vue-simple-suggest/dist/styles.css";
import Prism from "vue-prism-component";
import axios from "@/axios";

export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {}
    }
  },
  watch: {
    isSidebarActive(val) {
      if (!val) return;
      if (this.isNew()) {
        this.initValues();
        this.$validator.reset();
        let { category_id, limit } = JSON.parse(JSON.stringify(this.data));
        this.category_id = category_id;
        this.limit = limit;
      } else {
        let {
          name,
          id,
          price,
          brand,
          brand_id,
          description,
          ingredients,
          category_id,
          presentation,
          nutritionalFacts,
          photos,
          limit
        } = JSON.parse(JSON.stringify(this.data));
        this.dataId = id;
        this.name = name;
        this.price = price;
        this.brand = brand;
        this.brand_id = brand_id;
        this.description = description || "";
        this.ingredients = ingredients || "";
        this.category_id = category_id;
        this.presentation = presentation;
        if (photos != undefined) {
          this.urlPhoto = photos.length > 0 ? photos[0].photo : null;
        }
        if (brand != undefined) {
          this.brand_name = brand.name;
        }
        this.limit = limit;
        this.urlNut = nutritionalFacts;
        this.initValues();
        console.log(ingredients);
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  data() {
    return {
      dataId: null,
      name: "",
      price: "",
      brand: "",
      brand_name: "",
      description: "",
      ingredients: "",
      brand_id: 0,
      category_id: "",
      presentation: "",
      loading: false,
      urlPhoto: null,
      urlNut: null,
      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
        url: "http://tiendaweb.test/api/product/photo"
      },
      selectedFile: null,
      nutritionalFile: null,
      limit: 6
    };
  },
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
          // this.$validator.reset()
          // this.initValues()
        }
      }
    },
    isFormValid() {
      return (
        !this.errors.any() &&
        this.price &&
        this.brand &&
        this.presentation &&
        this.name
      );
    }

    // ...mapState("users", ["roles"])
  },
  methods: {
    ...mapActions("products", ["findBrand"]),
    initValues() {
      if (this.data.id) return;
      this.dataId = null;
      this.name = "";
      this.brand = "";
      this.description = "";
      this.ingredients = "";
      this.price = "";
      this.brand_id = 0;
      this.brand_name = "";
      this.presentation = "";
      this.selectedFile = null;
      this.nutritionalFile = null;
      this.urlPhoto = null;
      this.urlNut = null;
    },
    submitData() {
      this.$validator.validateAll().then(result => {
        if (result) {
          const obj = {
            id: this.dataId,
            category_id: this.category_id,
            name: this.name,
            price: this.price,
            ingredients: this.ingredients,
            presentation: this.presentation,
            description: this.description,
            brand_name: this.brand_name,
            brand_id: this.brand_id,
            limit: this.limit
          };
          if (this.selectedFile != null) {
            obj.photo = this.selectedFile;
          }
          if (this.nutritionalFile != null) {
            obj.nutritionalFacts = this.nutritionalFile;
          }

          if (this.dataId !== null && this.dataId > 0) {
            this.$store
              .dispatch("products/updateProduct", obj)
              .then(result => {
                this.$emit("closeSidebar");
                this.initValues();
                this.$validator.reset();
                this.$vs.notify({
                  color: "success",
                  title: this.$t("productUpdated")
                });
              })
              .catch(err => {
                console.error(err);
              });
          } else {
            delete obj.id;
            this.$store
              .dispatch("products/addProduct", obj)
              .then(result => {
                this.$emit("closeSidebar");
                this.initValues();
                this.$validator.reset();
                this.$vs.notify({
                  color: "success",
                  title: this.$t("productAdded")
                });
              })
              .catch(err => {
                console.error(err);
              });
          }
        }
      });
    },
    successUpload() {
      this.$vs.notify({
        color: "success",
        title: "Upload Success",
        text: "Lorem ipsum dolor sit amet, consectetur"
      });
    },
    getBrands(inputValue) {
      return new Promise((resolve, reject) => {
        this.findBrand(inputValue).then(data => {
          resolve(data.brands);
        });
      });
    },
    onSuggestSelect(suggest) {
      this.brand_id = suggest.id;
      this.brand_name = suggest.name;
    },
    onFileChanged(event) {
      this.selectedFile = event.target.files[0];
      this.urlPhoto = URL.createObjectURL(this.selectedFile);
    },
    onFileNutsChanged() {
      this.nutritionalFile = event.target.files[0];
      this.urlNut = URL.createObjectURL(this.nutritionalFile);
    },
    isNew() {
      let obj = Object.assign({}, this.data);
      delete obj.category_id;
      delete obj.limit;
      return Object.entries(obj).length === 0;
    }
  },
  components: {
    VuePerfectScrollbar,
    VueSimpleSuggest,
    Prism
  },
  mounted() {
    // this.fetchRoles();
  }
};
</script>

<style lang="scss" scoped>
@import "@sass/vuexy/extraComponents/autocomplete.scss";
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 600px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);
}
.preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

.preview img {
  max-width: 100%;
  max-height: 500px;
}
</style>

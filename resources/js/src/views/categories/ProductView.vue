<template>
  <div class="vx-col md:w-1/6 lg:w-1/6 product-view" :class="{'no-sale' : noSale}">
    <div class="product-data">
      <img class="grid-view-img px-4" :src="productImage" />
      <h4>$ {{price}}</h4>
      <h5>{{product.name}}</h5>
      <p>{{product.description}}</p>
      <small>{{product.presentation}}</small>
    </div>
    <div class="demo-alignment product-view-buttons" v-if="!noSale">
      <vs-button
        radius
        color="primary"
        type="filled"
        icon-pack="feather"
        icon="icon-edit-2"
        size="small"
        @click="editProduct()"
      ></vs-button>
      <vs-button
        class="pull-right"
        radius
        color="danger"
        type="filled"
        icon-pack="feather"
        icon="icon-x"
        size="small"
        @click="deleteProduct()"
      ></vs-button>
    </div>
    <div class="addProduct" v-if="rol == 'Comercio' && product.company_count == 0">
      <vs-button color="primary" type="filled" icon="add" @click="addProductToCompany">Agregar</vs-button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["product", "editData", "limit"],
  data() {
    return {
      productImage: "",
      rol: this.$store.getters["auth/getRol"]
    };
  },
  computed: {
    noSale() {
      if (this.rol == "SuperAdministrador") {
        return false;
      }
      if (this.rol == "Comercio") {
        if (this.product.company_count > 0) {
          return false;
        }
        return true;
      }
    },
    price() {
      if (this.rol == "SuperAdministrador") {
        return this.product.price;
      } else {
        this.product.priceSuggested = this.product.price;
        if (
          this.product.company_count > 0 &&
          this.product.company[0].pivot.price != null
        ) {
          return this.product.company[0].pivot.price;
        }
        return this.product.price;
      }
    }
  },
  watch: {
    price: function(value) {
      console.log("price", value);
      this.product.priceSuggested = value;
    }
  },
  methods: {
    deleteProduct() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("confirmDeleteTitle"),
        text: this.$t("confirmDeleteProductText"),
        accept: this.acceptAlert,
        acceptText: this.$t("delete")
      });
    },
    acceptAlert() {
      if (this.rol == "SuperAdministrador") {
        this.$store
          .dispatch("products/removeProduct", {
            product: this.product,
            limit: this.limit
          })
          .then(err => {
            this.$vs.notify({
              color: "danger",
              title: this.$t("productDeletedTitle"),
              text: this.$t("productDeletedText")
            });
          });
      } else {
        this.$store
          .dispatch("products/removeProductCompany", {
            product: this.product,
            limit: this.limit
          })
          .then(err => {
            this.$vs.notify({
              color: "danger",
              title: this.$t("productDeletedTitle"),
              text: this.$t("productDeletedText")
            });
          });
      }
    },
    editProduct() {
      if (this.rol == "SuperAdministrador") {
        this.editData(this.product);
      } else {
        this.editData(this.product);
      }
    },
    addProductToCompany() {
      console.log("click");
      this.$store
        .dispatch("products/addToCompany", {
          product: this.product,
          limit: this.limit
        })
        .then(() => {
          this.$vs.notify({
            color: "success",
            title: this.$t("productAdded")
          });
        });
    }
  },
  created() {
    this.productImage =
      this.product.photos.length > 0
        ? this.product.photos[0].photo
        : "http://tiendaweb.test/images/web/categories/soda.svg";
  }
};
</script>

<style lang="scss" scoped>
.grid-view-img {
  max-width: 100%;
  max-height: 100%;
}
h4 {
  text-align: left;
}
.no-sale {
  opacity: 0.3;
}
.no-sale:hover {
  opacity: 1;
}
.product-view {
  position: relative;
  .product-data {
    position: relative;
    top: 0;
  }
  .product-view-buttons {
    display: none;
    //
  }
  .addProduct {
    position: absolute;
    top: 0;
    z-index: 20;
    margin-top: 5rem;
    margin-left: 2rem;

    .con-vs-chip {
      cursor: pointer;
    }
  }
}
.product-view:hover {
  .product-view-buttons {
    display: block;
    position: absolute;
    top: 0;
    .vs-button {
      margin-top: 0;
    }
  }
}
.pull-right {
  float: right;
}
</style>
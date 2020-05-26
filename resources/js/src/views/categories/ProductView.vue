<template>
  <!-- <div class="vx-col md:w-1/6 lg:w-1/6 product-view" :class="{'no-sale' : noSale}"> -->
  <div class="vx-col md:w-1/6 lg:w-1/6 product-view">
    <div class="product-data">
      <img class="grid-view-img px-4 imgProduct" :src="productImage" />
      <center>
        <h4 class="priceProduct">$ {{price}}</h4>
      </center>
      <center v-if="noSale">
        <vs-button color="primary" size="small" type="filled" icon="add" @click="addProductShoppingCart()" v-if="!currentProduct.addToCar">Agregar</vs-button>
        <vs-button v-else color="danger" size="small" type="filled" icon="add" @click="deleteProductShoppingCart()">Quitar</vs-button>
        <vs-input-number min="1" max="10" v-model="quantity" class="inline-flex quantityProduct" />
      </center>
      <h5 class="nameProduct">{{product.name}}</h5>
      <p class="descriptionProduct">{{product.description}}</p>
      <small class="presentationProduct">{{product.presentation}}</small>
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
import {mapGetters, mapActions} from 'vuex'
export default {
  props: ["product", "editData", "limit"],
  data() {
    return {
      productImage: "",
      viewType: '',
      quantity: 1,
      productAdd: false,
      currentProduct: null,
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
      if (this.viewType == "client") {
        /* if (this.product.company_count > 0) {
          return false;
        } */
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
      this.product.priceSuggested = value;
    },
    quantity: function(value) {
      let productsSelected = [...this.getProductsArray()]
      this.upadateQuantity(productsSelected, value)
    }
  },
  methods: {
    ...mapActions([
      'setProductsArray'
    ]),
    ...mapGetters([
      'getProductsArray'
    ]),
    upadateQuantity (list, value) {
      list = list.map(productCart => {
        if (productCart.id === this.currentProduct.id) {
          this.currentProduct.quantity = value
          productCart = {...this.currentProduct}
        }
        return productCart
      })
      this.setProductsArray([...list])
      console.log('agregando---', this.getProductsArray());
    },
    deleteProductListCart () {
      this.currentProduct.addToCar = false
      let newArray = this.getProductsArray().filter(productInCar => productInCar.id !== this.currentProduct.id)
      this.setProductsArray([...newArray])
      console.log('agregando---', this.getProductsArray());
    },
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
    deleteProductShoppingCart() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: "Eliminar del carrito de compras",
        text: 'Va a eliminar el producto del carrito de compras. Quiere continuar ?',
        accept: this.deleteProductListCart,
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
    editProductS() {
      if (this.rol == "SuperAdministrador") {
        this.editData(this.product);
      } else {
        this.editData(this.product);
      }
    },
    addProduct() {
      if (this.rol == "SuperAdministrador") {
        this.editData(this.product);
      } else {
        this.editData(this.product);
      }
    },
    addProductShoppingCart() {
      this.currentProduct.addToCar = true
      let productToCart = {...this.currentProduct, quantity: this.quantity}
      this.setProductsArray([...this.getProductsArray(), productToCart])
      console.log('agregando---', this.getProductsArray());
      // console.log('this.cambiando store---',this.$store.getProductsArray);
      // console.log('array---', this.productsArray);
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
    this.viewType = (this.$route.params._type === 'client=true') ? 'client' : 'admin'
    this.currentProduct = {...this.product, addToCar: false, productImage: this.productImage}
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
.imgProduct {
  max-width: 128px;
  max-height: 120px;
  min-width: 128px;
  min-height: 120px;
  margin-bottom: 25px;
}

.nameProduct {
  font-size: 11.96px !important;
  margin-bottom: 5px;
}
 .descriptionProduct {
   font-size: 10px !important;
   text-align: justify;
 }
 .presentationProduct {
   font-size: 9px !important;
 }
 .priceProduct {
   margin-bottom: 5px;
   text-align: center;
 }
 .quantityProduct {
   margin-bottom: 15px;
 }
</style>

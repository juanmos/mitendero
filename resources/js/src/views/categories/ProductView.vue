<template>
  <div class="vx-col md:w-1/6 lg:w-1/6 product-view">
    <div class="product-data">
      <img class="grid-view-img px-4" :src="productImage" />
      <h4>$ {{product.price}}</h4>
      <h5>{{product.name}}</h5>
      <p>{{product.description}}</p>
      <small>{{product.presentation}}</small>
    </div>
    <div class="demo-alignment product-view-buttons">
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
  </div>
</template>

<script>
export default {
  props: ["product", "editData", "limit"],
  data() {
    return {
      productImage: ""
    };
  },
  methods: {
    deleteProduct() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("confirmDeleteTitle"),
        text: this.$t("confirmDeleteText"),
        accept: this.acceptAlert,
        acceptText: this.$t("delete")
      });
    },
    acceptAlert() {
      this.$store
        .dispatch("products/removeProduct", {
          product: this.product,
          limit: this.limit
        })
        .catch(err => {
          this.$vs.notify({
            color: "danger",
            title: this.$t("productDeletedTitle"),
            text: this.$t("productDeletedText")
          });
        });
    },
    editProduct() {
      this.editData(this.product);
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
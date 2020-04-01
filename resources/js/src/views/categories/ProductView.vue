<template>
  <div class="vx-col md:w-1/6 lg:w-1/6">
    <img class="grid-view-img px-4" :src="productImage" />
    <h4>$ {{product.price}}</h4>
    <h5>{{product.name}}</h5>
    <p>{{product.description}}</p>
    <small>{{product.presentation}}</small>
  </div>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      productImage: ""
    };
  },
  created() {
    this.productImage =
      this.product.photos.length > 0
        ? this.product.photos[0].photo
        : "http://tiendaweb.test/images/web/categories/soda.svg";
  }
};
</script>

<style scoped>
.grid-view-img {
  max-width: 100%;
  max-height: 100%;
}
h4 {
  text-align: left;
}
</style>
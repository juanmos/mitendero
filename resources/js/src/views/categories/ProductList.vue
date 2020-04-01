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
  </vx-card>
</template>

<script>
export default {
  props: ["subcategory", "openSidebar"]
};
</script>

<style>
</style>
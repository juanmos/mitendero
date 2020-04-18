<!-- =========================================================================================
  File Name: FullPage.vue
  Description: Full page layout
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="layout--full-page">
    <!--================ Header Menu Area start =================-->
    <div class="flex w-full vx-row items-center justify-center" id="page-login">
      <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
        <vs-navbar v-model="activeItem" class="p-2">
          <div slot="title">
            <vs-navbar-title>
              <a class="navbar-brand logo_h mb-3" href="/">
                <img src="images/web/logo.png" alt height="50px" />
              </a>
            </vs-navbar-title>
          </div>

          <vs-navbar-item index="0">
            <a href="/">Inicio</a>
          </vs-navbar-item>

          <vs-navbar-item index="1">
            <a href="/shop">Comprar</a>
          </vs-navbar-item>

          <vs-navbar-item index="2">
            <a href="/about">Sobre nosotros</a>
          </vs-navbar-item>
        </vs-navbar>
      </div>
    </div>
    <!--================Header Menu Area =================-->
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  data: () => ({
    activeItem: 0
  })
};
</script>
<style scoped  lang="scss">
</style>
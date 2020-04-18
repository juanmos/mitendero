<!-- =========================================================================================
    File Name: ResetPassword.vue
    Description: Reset Password Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img">
    <div class="vx-col sm:w-3/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row">
            <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
              <img src="@assets/images/pages/reset-password.png" alt="login" class="mx-auto" />
            </div>
            <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg">
              <div class="p-8" v-if="verifyLink ==null">
                <div class="vx-card__title mb-8">
                  <h4 class="mb-4">{{$t('userVerifyTitle')}}</h4>
                  <p>{{$t('userVerifyDescription')}}</p>
                </div>
                <div class="flex flex-wrap justify-between flex-col-reverse sm:flex-row">
                  <vs-button
                    type="border"
                    to="/pages/login"
                    class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto"
                  >{{$t('goToHome')}}</vs-button>
                  <vs-button class="w-full sm:w-auto" @click="resend">{{$t('resendVerification')}}</vs-button>
                </div>
              </div>
              <div class="p-8" v-if="verifyLink !=null && verified">
                <div class="vx-card__title mb-8">
                  <h4 class="mb-4">{{$t('userVerifiedTitle')}}</h4>
                  <p>{{$t('userVerifiedDescription')}}</p>
                  <vs-button class="w-full sm:w-auto" @click="goHome">{{$t('goToHome')}}</vs-button>
                </div>
              </div>
              <div class="p-8" v-if="verifyLink !=null && !verified">
                <div class="vx-card__title mb-8">
                  <h4 class="mb-4">{{$t('verifying')}}</h4>
                  <vs-progress indeterminate color="primary"></vs-progress>
                </div>
              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import axios from "@/axios.js";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      verifyLink: null,
      verified: false
    };
  },
  methods: {
    ...mapActions("auth", ["me"]),
    ...mapGetters("auth", ["getRol"]),
    resend() {
      axios.get("/api/auth/verify/resend").then(() => {
        this.$swal({
          title: this.$t("success"),
          text: this.$t("verifySend"),
          icon: "success"
        });
      });
    },
    goHome() {
      console.log(this.getRol());
      if (this.getRol() == "Comercio") {
        this.$router.push("/wizard/company");
      } else {
        this.$router.push("/home");
      }
    }
  },
  mounted() {
    this.verifyLink = this.$route.query.verifyLink;
    if (this.verifyLink != null) {
      axios.get(this.verifyLink).then(result => {
        if (result.data.status == 1 || result.data.status == 2) {
          this.verified = true;
          this.me();
        }
      });
    }
  }
};
</script>


<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login"
  >
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter justify-center items-center">
            <div class="vx-col hidden lg:block lg:w-1/2">
              <img src="@assets/web/home/ubicar.png" alt="login" class="mx-auto" height="500px" />
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title mb-4">
                  <h4 class="mb-4">{{$t('newCompanyTitle')}}</h4>
                  <p>{{$t('newCompanyDescription')}}</p>
                </div>

                <div>
                  <div class="vx-row">
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-select
                        v-model="company_type_id"
                        class="w-full select-large"
                        :label="$t('companyType')"
                      >
                        <vs-select-item
                          :key="index"
                          :value="item.id"
                          :text="item.type"
                          v-for="(item,index) in companyTypes"
                          class="w-full"
                        />
                      </vs-select>
                    </div>
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-input
                        name="company"
                        icon-no-border
                        icon="icon icon-shopping-bag"
                        icon-pack="feather"
                        :label="$t('company')"
                        :placeholder="$t('company')"
                        v-model="company"
                        class="w-full"
                      />
                    </div>
                  </div>
                  <h6>Datos de la cuenta</h6>
                  <div class="vx-row">
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-input
                        name="first_name"
                        icon-no-border
                        icon="icon icon-user"
                        icon-pack="feather"
                        :label-placeholder="$t('firstName')"
                        v-model="first_name"
                        class="w-full"
                      />
                    </div>
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-input
                        name="last_name"
                        icon-no-border
                        icon="icon icon-user"
                        icon-pack="feather"
                        :label-placeholder="$t('lastName')"
                        v-model="last_name"
                        class="w-full"
                      />
                    </div>
                  </div>

                  <vs-input
                    name="email"
                    icon-no-border
                    icon="icon icon-user"
                    icon-pack="feather"
                    :label-placeholder="$t('email')"
                    v-model="email"
                    class="w-full"
                  />
                  <div class="vx-row">
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-input
                        type="password"
                        name="password"
                        icon-no-border
                        icon="icon icon-lock"
                        icon-pack="feather"
                        :label-placeholder="$t('password')"
                        v-model="password"
                        class="w-full mt-6"
                      />
                    </div>
                    <div class="vx-col sm:w-1/2 w-full mb-2">
                      <vs-input
                        type="password"
                        name="password_confirmation"
                        icon-no-border
                        icon="icon icon-lock"
                        icon-pack="feather"
                        :label-placeholder="$t('passwordConfirmation')"
                        v-model="password_confirmation"
                        class="w-full mt-6"
                      />
                    </div>
                  </div>
                  <br />
                  <vs-button type="border" :to="{ name: 'auth.login' }">{{$t('gotoLogin')}}</vs-button>
                  <vs-button class="float-right" @click="register">{{$t('createCompany')}}</vs-button>
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
import { mapActions } from "vuex";
export default {
  data() {
    return {
      company_type_id: 1,
      first_name: "",
      last_name: "",
      email: "",
      password: "",
      password_confirmation: "",
      company: "",
      companyTypes: null
    };
  },
  methods: {
    ...mapActions("auth", ["signupCompnay"]),
    register() {
      this.signup({
        first_name: this.first_name,
        last_name: this.last_name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        tipo: "comercio"
      })
        .then(res => {
          this.$router.push({ name: "auth.verify" });
        })
        .catch(err => {});
    }
  },
  created() {
    axios
      .get("/api/companies/types")
      .then(response => {
        this.companyTypes = response.data.companyTypes;
      })
      .catch(error => {});
  }
};
</script>

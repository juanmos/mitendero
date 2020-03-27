<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login"
  >
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter justify-center items-center">
            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
              <div class="p-8 login-tabs-container">
                <div class="vx-card__title mb-4">
                  <h4 class="mb-4">{{$t('suggestCompanyTitle')}}</h4>
                  <p>{{$t('suggestCompanyDescription')}}</p>
                </div>

                <div>
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
                  <vs-input
                    name="company"
                    icon-no-border
                    icon="icon icon-shopping-bag"
                    icon-pack="feather"
                    :label-placeholder="$t('company')"
                    v-model="company_name"
                    class="w-full"
                  />
                  <vs-input
                    name="contact"
                    icon-no-border
                    icon="icon icon-user"
                    icon-pack="feather"
                    :label-placeholder="$t('contact')"
                    v-model="contact"
                    class="w-full"
                  />
                  <vs-input
                    name="phone"
                    icon-no-border
                    icon="icon icon-phone"
                    icon-pack="feather"
                    :label-placeholder="$t('phone')"
                    v-model="phone"
                    class="w-full"
                  />

                  <vs-input
                    type="email"
                    name="email"
                    icon-no-border
                    icon="icon icon-mail"
                    icon-pack="feather"
                    :label-placeholder="$t('email')"
                    v-model="email"
                    class="w-full mt-6"
                  />
                  <vs-input
                    name="address"
                    icon-no-border
                    icon="icon icon-map"
                    icon-pack="feather"
                    :label-placeholder="$t('companyAddress')"
                    v-model="address"
                    class="w-full mt-6"
                  />
                </div>
              </div>
            </div>

            <div class="vx-col hidden lg:block lg:w-1/2">
              <GmapMap :center="center" :zoom="14" style="width: 100%; height: 515px">
                <GmapMarker
                  :key="index"
                  v-for="(m, index) in markers"
                  :position="m.position"
                  :clickable="true"
                  :draggable="true"
                  @click="center=m.position"
                  @drag="updateCoordinates"
                />
              </GmapMap>
            </div>
            <div class="vx-col hidden lg:block lg:w-1/2">
              <vs-button type="border" :to="{ name: 'web.init' }">{{$t('goToHome')}}</vs-button>
              <vs-button class="float-right" @click="register">{{$t('send')}}</vs-button>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
import axios from "@/axios.js";
export default {
  data() {
    return {
      company_type_id: 1,
      company_name: "",
      address: "",
      email: "",
      phone: "",
      contact: "",
      coordinates: null,
      companyTypes: null,
      center: { lat: -2.8969556, lng: -79.0125272 },
      markers: []
    };
  },
  methods: {
    updateCoordinates(location) {
      this.coordinates = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng()
      };
    },
    register() {
      axios
        .post("api/company/suggestion", {
          company_name: this.company_name,
          address: this.address,
          email: this.email,
          phone: this.phone,
          contact: this.contact,
          company_type_id: this.company_type_id,
          lat: this.coordinates.lat,
          lng: this.coordinates.lng
        })
        .then(response => {
          this.$swal({
            title: this.$t("success"),
            text: this.$t("companySuggested"),
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Otra sugerencia",
            cancelButtonText: "Ir a la pagina de inicio"
          }).then(result => {
            if (result.value) {
              this.cleanData();
            } else {
              this.$router.push({ name: "web.init" });
            }
          });
        });
    },
    cleanData() {
      this.company_type_id = 1;
      this.company_name = "";
      this.address = "";
      this.email = "";
      this.phone = "";
      this.contact = "";
    }
  },
  created() {
    axios
      .get("/api/companies/types")
      .then(response => {
        this.companyTypes = response.data.companyTypes;
      })
      .catch(error => {});
    this.$getLocation({
      enableHighAccuracy: true //defaults to false
    }).then(coordinates => {
      this.coordinates = coordinates;
      this.center.lat = coordinates.lat;
      this.center.lng = coordinates.lng;
      this.markers.push({
        position: { lat: coordinates.lat, lng: coordinates.lng }
      });
    });
  }
};
</script>
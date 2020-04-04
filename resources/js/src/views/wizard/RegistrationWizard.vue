<template>
  <form-wizard
    color="rgba(var(--vs-primary), 1)"
    errorColor="rgba(var(--vs-danger), 1)"
    :title="$t('fillCompanyData')"
    :subtitle="null"
    :finishButtonText="$t('save')"
    :nextButtonText="$t('next')"
    :backButtonText="$t('back')"
    ref="formWizard"
  >
    <tab-content
      :title="$t('userData')"
      class="mb-5"
      icon="feather icon-user"
      :before-change="validateStep1"
    >
      <!-- tab 1 content -->
      <form data-vv-scope="step-1">
        <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              :label="$t('firstName')"
              v-model="userData.first_name"
              class="w-full"
              name="first_name"
              v-validate="'required|alpha_spaces'"
            />
            <span class="text-danger">{{ errors.first('step-1.first_name') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              :label="$t('lastName')"
              v-model="userData.last_name"
              class="w-full"
              name="last_name"
              v-validate="'required|alpha_spaces'"
            />
            <span class="text-danger">{{ errors.first('step-1.last_name') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              type="email"
              :label="$t('email')"
              v-model="userData.email"
              class="w-full"
              name="email"
              disabled="disabled"
            />
            <span class="text-danger">{{ errors.first('step-1.email') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              type="text"
              :label="$t('identification')"
              v-model="userData.identification"
              class="w-full"
              name="identification"
              v-validate="'required|integer|min:10'"
            />
            <span class="text-danger">{{ errors.first('step-1.identification') }}</span>
          </div>

          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              type="text"
              :label="$t('phone')"
              v-model="userData.phone"
              class="w-full"
              name="phone"
              v-validate="'required|integer|min:6'"
            />
            <span class="text-danger">{{ errors.first('step-1.phone') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-input
              type="text"
              :label="$t('mobile')"
              v-model="userData.mobile"
              class="w-full"
              name="mobile"
              v-validate="'required|integer|min:6'"
            />
            <span class="text-danger">{{ errors.first('step-1.mobile') }}</span>
          </div>
          <!-- <div class="vx-col md:w-1/2 w-full mt-5">
            <vs-select v-model="city" class="w-full select-large" :label="$t('role')">
              <vs-select-item
                :key="index"
                :value="item.value"
                :text="item.text"
                v-for="(item,index) in cityOptions"
                class="w-full"
              />
            </vs-select>
          </div>-->
        </div>
      </form>
    </tab-content>

    <!-- tab 2 content -->
    <tab-content
      :title="$t('companyInfo')"
      class="mb-5"
      icon="feather icon-briefcase"
      :before-change="validateStep2"
    >
      <form data-vv-scope="step-2">
        <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full">
            <vs-input
              :label="$t('companyName')"
              v-model="company.company_name"
              class="w-full mt-4"
              name="company_name"
              v-validate="'required|alpha_spaces'"
            />
            <span class="text-danger">{{ errors.first('step-2.company_name') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full">
            <vs-input
              :label="$t('companyAlias')"
              v-model="company.company_alias"
              class="w-full mt-4"
              name="company_alias"
              v-validate="'required|alpha_spaces'"
            />
            <span class="text-danger">{{ errors.first('step-2.company_alias') }}</span>
          </div>

          <div class="vx-col md:w-1/2 w-full">
            <vs-input
              :label="$t('identification')"
              v-model="company.ruc"
              class="w-full mt-4"
              name="identification"
              v-validate="'required|integer|min:10'"
            />
            <span class="text-danger">{{ errors.first('step-2.identification') }}</span>
          </div>
        </div>
      </form>
    </tab-content>

    <!-- tab 3 content -->
    <tab-content
      :title="$t('locationCompany')"
      class="mb-5"
      icon="feather icon-file"
      :before-change="validateStep3"
    >
      <form data-vv-scope="step-3">
        <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full">
            <vs-input
              :label="$t('companyPhone')"
              v-model="phone"
              class="w-full mt-4"
              name="company_phone"
              v-validate="'required|integer|min:6'"
            />
            <span class="text-danger">{{ errors.first('step-3.company_phone') }}</span>
          </div>
          <div class="vx-col md:w-1/2 w-full">
            <vs-input
              :label="$t('companyAddress')"
              v-model="address"
              class="w-full mt-4"
              name="company_address"
              v-validate="'required'"
            />
            <span class="text-danger">{{ errors.first('step-3.company_address') }}</span>
          </div>
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
      </form>
    </tab-content>
  </form-wizard>
</template>

<script>
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import { mapGetters, mapActions } from "vuex";

// For custom error message
import { Validator } from "vee-validate";
const dict = {
  custom: {
    first_name: {
      required: "First name is required",
      alpha_spaces: "First name may only contain alphabetic characters"
    },
    last_name: {
      required: "Last name is required",
      alpha_spaces: "Last name may only contain alphabetic characters"
    },
    email: {
      required: "Email is required",
      email: "Please enter valid email"
    },
    identification: {
      required: "Identification is required",
      integer: "Please enter only digits",
      min: "Must be at least 10 digits"
    },
    phone: {
      required: "Email is required",
      integer: "Please enter only digits",
      min: "Must be at least 6 digits"
    },
    mobile: {
      required: "Mobile is required",
      integer: "Please enter only digits",
      min: "Must be at least 6 digits"
    },
    compnay_name: {
      required: "Company name is required",
      alpha: "Company name may only contain alphabetic characters"
    },
    compnay_alias: {
      required: "Company alias is required",
      alpha: "Company alias may only contain alphabetic characters"
    },
    compnay_phone: {
      required: "Company phone is required",
      alpha: "Company phone may only contain alphabetic characters"
    },
    compnay_address: {
      required: "Company address is required",
      alpha: "Company address may only contain alphabetic characters"
    },
    proposal_title: {
      required: "Proposal title name is required",
      alpha: "Proposal title may only contain alphabetic characters"
    },
    event_name: {
      required: "Event name is required",
      alpha: "Event name may only contain alphabetic characters"
    }
  }
};

// register custom messages
Validator.localize("en", dict);
Validator.localize("es", dict);

export default {
  data() {
    return {
      phone: "",
      address: "",
      center: { lat: -2.8969556, lng: -79.0125272 },
      markers: [],
      coordinates: { lat: -2.8969556, lng: -79.0125272 },
      userData: {},
      company: {}
    };
  },
  created() {
    this.config = this.$store.state.configuration.configuration;

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
  },
  mounted() {
    this.$store.dispatch("auth/me").then(response => {
      this.userData = response.user;
      this.company = response.user.company;
    });
  },
  methods: {
    ...mapActions(["updateProfile"]),
    ...mapActions("company", [
      "saveCompanyData",
      "saveCompanyLocation",
      "changeCompanyStatus"
    ]),
    ...mapActions("auth", ["me"]),
    ...mapActions("configuration", ["saveConfigData"]),
    validateStep1() {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll("step-1").then(result => {
          if (result) {
            this.updateProfile(this.userData);
            resolve(true);
          } else {
            reject("correct all values");
          }
        });
      });
    },
    validateStep2() {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll("step-2").then(result => {
          if (result) {
            this.saveCompanyData(this.company);
            resolve(true);
          } else {
            reject("correct all values");
          }
        });
      });
    },
    validateStep3() {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll("step-3").then(result => {
          if (result) {
            this.saveCompanyLocation({
              id: this.company.id,
              lat: this.coordinates.lat,
              lng: this.coordinates.lng,
              phone: this.phone,
              address: this.address
            }).then(result => {
              this.changeCompanyStatus(2).then(result => {
                this.$router.replace({ name: "company.home" });
                resolve(true);
              });
            });
          } else {
            reject("correct all values");
          }
        });
      });
    },
    updateCoordinates(location) {
      this.coordinates = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng()
      };
    }
  },
  components: {
    FormWizard,
    TabContent
  }
};
</script>
    
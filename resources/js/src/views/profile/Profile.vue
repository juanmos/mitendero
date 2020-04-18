<!-- =========================================================================================
    File Name: CardBasic.vue
    Description: Basic Cards
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="demo-basic-card">
    <div class="vx-row">
      <!-- USER PROFILE CARD 2 - MINIMAL -->
      <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
        <vx-card class="p-2">
          <vs-avatar class="mx-auto mb-6 block" size="80px" :src="card_4.userImg" />
          <div class="text-center">
            <h4>{{ card_4.name }}</h4>
            <p class="text-grey">{{ card_4.profession }}</p>
          </div>
          <div class="flex justify-between flex-wrap">
            <vs-button
              class="mt-4 mr-2 shadow-lg"
              type="gradient"
              color="#7367F0"
              gradient-color-secondary="#CE9FFC"
            >{{ card_4.btn_1_text }}</vs-button>
            <vs-button class="mt-4" type="border" color="#b9b9b9">{{ card_4.btn_2_text }}</vs-button>
          </div>
          <template slot="footer">
            <vs-divider />
            <div class="flex justify-between">
              <span class="flex items-center">
                <feather-icon
                  :icon="card_4.footer_text_1_icon"
                  svgClasses="h-5 w-5 text-warning stroke-current"
                />
                <span class="ml-2">{{ card_4.footer_text_1 }}</span>
              </span>
              <span class="flex items-center">
                <feather-icon
                  :icon="card_4.footer_text_2_icon"
                  svgClasses="h-5 w-5 text-primary stroke-current"
                />
                <span class="ml-2">{{ card_4.footer_text_2 }}</span>
              </span>
            </div>
          </template>
        </vx-card>
      </div>

      <!-- USER PRODFILE CARD -->
      <div class="vx-col w-full lg:w-1/3 sm:w-1/2 mb-base">
        <vx-card class="p-2">
          <div class="text-center">
            <h4>{{ card_5.name }}</h4>
            <p class="text-grey">{{ card_5.profession }}</p>
          </div>
          <vs-avatar class="mx-auto my-6 block" size="80px" :src="card_5.userImg" />
          <div class="flex justify-between text-center">
            <span>
              <p class="text-xl font-semibold">{{ card_5.user_meta_1_title }}</p>
              <small class="text-grey">{{ card_5.user_meta_1_label }}</small>
            </span>
            <span>
              <p class="text-xl font-semibold">{{ card_5.user_meta_2_title }}</p>
              <small class="text-grey">{{ card_5.user_meta_2_label }}</small>
            </span>
            <span>
              <p class="text-xl font-semibold">{{ card_5.user_meta_3_title }}</p>
              <small class="text-grey">{{ card_5.user_meta_3_label }}</small>
            </span>
          </div>
          <vs-button
            type="gradient"
            class="w-full mt-6"
            color="#7367F0"
            gradient-color-secondary="#CE9FFC"
          >{{ card_5.btn_text }}</vs-button>
        </vx-card>
      </div>

      <!-- ACTIVITY TIMELINE -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 mb-base">
        <vx-card title="Activity Timeline">
          <vx-timeline :data="timelineData"></vx-timeline>
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import { videoPlayer } from "vue-video-player";
import VxTimeline from "@/components/timeline/VxTimeline.vue";
import "video.js/dist/video-js.css";

export default {
  data() {
    return {
      // card 1
      card_1: {},
      card_2: {},
      card_3: {},
      card_4: {},
      card_5: {},
      card_6: {},
      card_7: {},
      card_8: {},

      chatLog: [],
      chatMsgInput: "",

      card_9: {},

      timelineData: [
        {
          color: "primary",
          icon: "PlusIcon",
          title: "New Task Added",
          desc: "Bonbon macaroon jelly beans gummi bears jelly lollipop apple",
          time: "25 Days Ago"
        },
        {
          color: "warning",
          icon: "AlertCircleIcon",
          title: "Task Update Found",
          desc: "Cupcake gummi bears soufflé caramels candy",
          time: "15 Days Ago"
        },
        {
          color: "success",
          icon: "CheckIcon",
          title: "Task Finished",
          desc: "Candy ice cream cake. Halvah gummi bears",
          time: "20 mins ago"
        }
      ],

      name: "",
      email: "",
      msg: "",

      playerOptions: {},
      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6
      }
    };
  },
  components: {
    VuePerfectScrollbar,
    videoPlayer,
    VxTimeline
  },
  mounted() {
    this.$refs.chatLogPS.$el.scrollTop = this.$refs.chatLog.scrollHeight;
  },
  created() {
    // Card 1
    this.$http
      .get("/api/users/pixinvent/product/1")
      .then(response => {
        this.card_1 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 2
    this.$http
      .get("/api/users/pixinvent/product/sales/1")
      .then(response => {
        this.card_2 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 3
    this.$http
      .get("/api/users/pixinvent/product/goals/1")
      .then(response => {
        this.card_3 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 4
    this.$http
      .get("/api/users/89")
      .then(response => {
        this.card_4 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 5
    this.$http
      .get("/api/users/58")
      .then(response => {
        this.card_5 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 6
    this.$http
      .get("/api/users/16")
      .then(response => {
        this.card_6 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 7
    this.$http
      .get("/api/place/18")
      .then(response => {
        this.card_7 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 8
    this.$http
      .get("/api/place/76/weather")
      .then(response => {
        this.card_8 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Chat Log
    this.$http
      .get("/api/chat/demo-1/log")
      .then(response => {
        this.chatLog = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Card 9
    this.$http
      .get("/api/item/12/review")
      .then(response => {
        this.card_9 = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    // Player Options
    this.$http
      .get("/api/card/card-basic/player-option")
      .then(response => {
        this.playerOptions = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style lang="scss">
#demo-basic-card {
  .overlay-card {
    .vx-card__collapsible-content {
      max-height: 485px;
    }
  }

  .chat-card-log {
    height: 360px;

    .chat-sent-msg {
      background-color: #f2f4f7 !important;
    }
  }

  .card-video {
    .video-js {
      height: 370px;
    }
  }
}
</style>

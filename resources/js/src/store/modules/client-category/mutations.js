/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    SET_CLIENT_CATEGORIES(state, clientCategories) {
        state.clientCategories = clientCategories
    },
    SET_CLIENT_CATEGORY(state, clientCategory) {
        state.clientCategory = clientCategory;
    }
}

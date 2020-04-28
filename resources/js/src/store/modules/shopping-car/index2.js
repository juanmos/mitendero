const state = {
  productsArray: []
}
const getters = {
  getProductsArray: (state) => {
    return state.productsArray
  }
}
const mutations = {
  setProductsArray: (state, productsArray) => {
    state.productsArray = productsArray
  }
}
const actions = {
  setProductsArray: ({ commit }, productsArray) => {
    commit('setProductsArray', productsArray)
  }
}
export default {
  state,
  getters,
  mutations,
  actions
}

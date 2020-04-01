export default {
    SET_PRODUCTS(state, products) {
        state.products.unshift(products);
    },
}
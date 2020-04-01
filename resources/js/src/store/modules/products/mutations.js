export default {
    SET_PRODUCTS(state, products, category) {
        state.products.push({
            category: category,
            products: products
        });
    },
}
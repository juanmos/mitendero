export default {
    products: state => state.products,
    getProducts: state => (categoryId) => state.products.find((product) => product.category_id == categoryId),
}
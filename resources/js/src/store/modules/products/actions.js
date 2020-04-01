import axios from "@/axios.js"

export default {
    fetchProducts({
        commit
    }, category_id) {
        return new Promise((resolve, reject) => {
            axios.get(`api/category/${category_id}/products`).then(response => {
                commit('SET_PRODUCTS', response.data.products, category_id);
                resolve(response.data.products);
            })
        })
    },
    addProduct({
        commit
    }, product) {
        return new Promise((resolve, reject) => {
            axios.post(`api/category/${product.category_id}/product`, product).then(response => {
                console.log(response);
                resolve(response);
            })
        })
    },
    findBrand({
        commit
    }, brand) {
        return new Promise((resolve, reject) => {
            axios.get(`api/brand/search/${brand}`).then(({
                data
            }) => {
                resolve(data);
            })
        })
    }
}
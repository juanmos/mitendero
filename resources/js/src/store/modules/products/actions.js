import axios from "@/axios.js"

export default {
    fetchProducts({
        commit
    }, {
        category_id,
        limit
    }) {
        return new Promise((resolve, reject) => {
            if (limit == undefined) {
                limit = 6;
            }
            axios.get(`api/category/${category_id}/products/${limit}`).then(response => {
                commit('SET_PRODUCTS', Object.assign(response.data.products, {
                    category_id: category_id
                }))
                resolve(response.data.products);
            })
        })
    },
    fetchProductBrands({
        commit
    }, category_id) {
        return new Promise((resolve, reject) => {
            axios.get(`api/category/${category_id}/brands`).then(response => {
                resolve(response.data.brands);
            })
        })
    },
    addProduct({
        commit,
        dispatch
    }, product) {
        return new Promise((resolve, reject) => {
            var formData = new FormData();
            Object.keys(product).forEach(key => {
                formData.append(key, product[key]);
            })
            axios.post(`api/category/${product.category_id}/product`, formData).then(response => {
                dispatch('fetchProducts', {
                    category_id: product.category_id,
                    limit: product.limit
                })
                resolve(response);
            }).catch(err => {
                reject(err);
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
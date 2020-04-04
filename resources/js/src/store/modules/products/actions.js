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
    addToCompany({
        dispatch
    }, {
        product,
        limit
    }) {
        return new Promise((resolve, reject) => {
            axios.post(`api/my/product/${product.id}`).then(response => {
                dispatch('fetchProducts', {
                    category_id: product.category_id,
                    limit: limit
                })
                resolve();
            })
        })
    },
    addProduct({
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
    updateProduct({
        commit,
        dispatch
    }, product) {
        return new Promise((resolve, reject) => {
            var formData = new FormData();
            formData.append("_method", "PUT");
            Object.keys(product).forEach(key => {
                formData.append(key, product[key]);
            })
            axios.post(`api/category/${product.category_id}/product/${product.id}`, formData).then(response => {
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
    removeProduct({
        commit,
        dispatch
    }, {
        product,
        limit
    }) {
        return new Promise((resolve, reject) => {
            axios.delete(`api/category/${product.category_id}/product/${product.id}`).then(response => {
                dispatch('fetchProducts', {
                    category_id: product.category_id,
                    limit: limit
                })
                resolve(response);
            }).catch(err => {
                reject(err);
            })
        })
    },
    removeProductCompany({
        commit,
        dispatch
    }, {
        product,
        limit
    }) {
        return new Promise((resolve, reject) => {
            axios.delete(`api/my/product/${product.id}`).then(response => {
                dispatch('fetchProducts', {
                    category_id: product.category_id,
                    limit: limit
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
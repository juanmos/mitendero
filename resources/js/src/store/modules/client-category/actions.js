import axios from "@/axios.js"

export default {
    fetchClientCategories({
        commit
    }) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/shop/v1/categories`)
                .then((response) => {
                    commit('SET_CLIENT_CATEGORIES', response.data.categories)
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
    },
    fetchClientCategory({
        commit
    }, categoryId) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/shop/v1/category/${categoryId}`)
                .then((response) => {
                    commit('SET_CLIENT_CATEGORY', response.data.category)
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
    },
}

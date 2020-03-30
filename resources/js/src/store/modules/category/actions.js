import axios from "@/axios.js"

export default {
    fetchCategories({
        commit
    }) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/categories`)
                .then((response) => {
                    commit('SET_CATEGORIES', response.data.categories)
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
    },
    fetchCategory({
        commit
    }, categoryId) {
        return new Promise((resolve, reject) => {
            axios.get(`/api/category/${categoryId}`)
                .then((response) => {
                    commit('SET_CATEGORY', response.data.category)
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })
        })
    },
}
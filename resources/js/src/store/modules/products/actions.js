import axios from "@/axios.js"

export default {
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
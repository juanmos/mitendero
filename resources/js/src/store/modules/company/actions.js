import axios from "@/axios.js"
export default {
    saveCompanyData({
        commit,
        state,
        dispatch
    }, data) {
        return new Promise((resolve, reject) => {
            if (state.company.id == 0) {
                axios
                    .post("api/company", data)
                    .then(({
                        data
                    }) => {
                        commit('setCompany', data.company);
                        if (data.company.configuration.configurations != null)
                            dispatch('configuration/setConfigData', data.company.configuration.configurations);
                        resolve(data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            } else {
                axios.put(`api/company/${data.id}`, data).then(({
                    data
                }) => {
                    commit('setCompany', data.company);
                    if (data.company.configuration.configurations != null)
                        dispatch('configuration/setConfigData', data.company.configuration.configurations);
                    resolve(data);
                }).catch(err => {
                    reject(err);
                });
            }

        })

    },
    setCompanyData({
        commit,
        dispatch
    }, data) {
        commit('setCompany', data);
        if (data.configuration.configurations != null)
            dispatch('configuration/setConfigData', data.configuration.configurations, {
                root: true
            });
    },
    saveCompanyLocation({
        commit,
        dispatch
    }, data) {
        return new Promise((resolve, reject) => {
            axios.post(`api/company/${data.id}/location`, data).then(result => {
                commit('setCompany', result.data.company);
                if (result.data.company.configuration.configurations != null)
                    dispatch('configuration/setConfigData', result.data.company.configuration.configurations);
                resolve(result.data);
            });
        });
    },
    changeCompanyStatus({
        commit,
        state
    }, status) {
        return new Promise((resolve, reject) => {
            axios.put(`api/company/${state.company.id}/status/${status}`, {}).then(result => {
                commit('setCompany', result.data.company);
                if (result.data.company.configuration.configurations != null)
                    dispatch('configuration/setConfigData', result.data.company.configuration.configurations);
                resolve(result.data);
            })
        })
    }
}
import actions from './actions'

export default {
    namespaced: true,
    state: {
        company: {
            id: 0,
            company_name: '',
            company_alias: '',
            ruc: '',
            address: '',
            phone: '',
        }
    },
    mutations: {
        setCompany(state, company) {
            state.company = company;
        }
    },
    actions: actions,
    getters: {
        getCompany(state) {
            return state.rol;
        }
    }
}
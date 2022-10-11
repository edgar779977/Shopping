
export default {

    state: {
        auth: null,
        auth_id: null
    },
    actions: {
        async login({commit, state}, params) {

            try {
                let {data} = await axios.post(`/api/login`, params)
                commit('SET_AUTH', data.token)
                commit('SET_AUTH_ID', data.user.id)
                return data
            } catch (error) {

                return false

            }

        },

        async logout({commit}) {

            try {
                let {data} = await axios.get(`/api/logout`)
                commit('REMOVE_AUTH')
                commit('REMOVE_AUTH_ID')
                return data.data
            } catch (error) {

                return false
            }
        }
    },

    mutations: {
        SET_AUTH(state, data) {
            if (data) $cookies.set('Authorization', data)
            state.auth = data
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${data}`;
        },

        SET_AUTH_ID(state, data) {
            if (data) $cookies.set('auth_id', data)
            state.auth_id = data
        },

        REMOVE_AUTH(state) {
            $cookies.remove('Authorization')
            state.auth = null
            delete axios.defaults.headers.common["Authorization"];
        },

        REMOVE_AUTH_ID(state) {
            $cookies.remove('auth_id')
            state.auth_id = null
        }
    },

    getters: {
        GET_AUTH(state) {
            return state.auth
        },

        GET_AUTH_ID(state) {
            return state.auth_id
        }
    }
}

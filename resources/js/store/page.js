// store/modules/page.js
const state = {
    page: null,
    isLoading: true,
    errors: [],
    lastSaving: null,
    files: []
};

const getters = {
    page: (state) => state.page,
    isLoading: (state) => state.isLoading,
    errors: (state) => state.errors,
    lastSaving: (state) => state.lastSaving,
};

const actions = {
    async fetchPage({ commit }, id) {
        if (!id) {
            commit('setPage', {
                id: null,
                title: 'Новая страница',
                content: 'Текст',
                slug: '',
            })
            commit('setLoading', false);
        } else {
            try {
                axios.get(`/dashboard/page/${id}/data`).then(response => {
                    commit("setPage", response.data.item);
                });
            } catch (error) {
                commit('setErrors', [error]);
            } finally {
                commit('setLoading', false);
            }
        }
        
    },
    async savePage({ commit }, page) {
        commit('setLoading', true);
        try {
            axios.post('/dashboard/page/store', page).then(response => {
                commit('setPage', response.data.item);
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    let allErrorMessages = [];
                    for (const field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            const errorMessages = errors[field];
                            allErrorMessages = allErrorMessages.concat(errorMessages);
                        }
                    }
                    commit('setErrors', allErrorMessages);
                }
            });
        } catch (error) {
            commit('setError', error);
        } finally {
            commit('setLoading', false);
        }
    },
    async updatePage({ commit }, page) {
        commit('setLoading', true);
        try {
            axios.post(`/dashboard/page/update`, page).then(response => {
                commit('setPage', response.data.item);
                commit('setLastSaving', response.data.time);
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    let allErrorMessages = [];
                    for (const field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            const errorMessages = errors[field];
                            allErrorMessages = allErrorMessages.concat(errorMessages);
                        }
                    }
                    commit('setErrors', allErrorMessages);
                }
            });
        } catch (error) {
            commit('setErrors', [error]);
        } finally {
            commit('setLoading', false);
        }
    }, 
};

const mutations = {
    setPage(state, page) { 
        state.page = page;
    },
    setLoading(state, isLoading) {
        state.isLoading = isLoading;
    },
    setErrors(state, errors) {
        state.errors = errors;
    },
    setLastSaving(state, time) {
        state.lastSaving = time;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};

// store/modules/article.js
const state = {
  article: null,
  isLoading: true,
  errors: [],
  lastSaving: null,
  files: []
};

const getters = {
  article: (state) => state.article,
  isLoading: (state) => state.isLoading,
  errors: (state) => state.errors,
  lastSaving: (state) => state.lastSaving,
};

const actions = {
  setCategory({commit}, $category_id){
    commit('setCategory', $category_id);
  },
  fetchArticle({ commit }, id) {
    if(!id){ 
      commit('setArticle', {
        id: null,
        title: 'Новая статья',
        description: '',
        content: 'Текст',
        published_at: null,
        category_id: 0,
        slug: '',
        status: false,
    })
      commit('setLoading', false);
    } else {
      try {
        axios.get(`/dashboard/article/${id}/data`).then(response => {
            commit("setArticle", response.data.item);
        });
      } catch (error) {
        commit('setErrors', [error]);
      } finally {
        commit('setLoading', false);
      }
    }
    
  },
  async saveArticle({ commit }, article) {
    commit('setLoading', true);
    try {
      axios.post('/dashboard/article/store', article).then(response => {
          commit('setArticle', response.data.item);
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
});;
    } catch (error) {
      commit('setError', error);
    } finally {
      commit('setLoading', false);
    }
  },
  async updateArticle({ commit }, article) { 
    commit('setLoading', true); 
    try {
      axios.post(`/dashboard/article/update`, article).then(response => { 
          commit('setArticle', response.data.item);
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
  clearArticle({ commit }) {
    commit('clearArticle');
  },
};

const mutations = {
  setArticle(state, article) {
    if(!article.hasOwnProperty('status')){
       article.status = !!article.published_at;
    }
    state.article = article;
  }, 
  setLoading(state, isLoading) {
    state.isLoading = isLoading;
  },
  setErrors(state, errors) {
    state.errors = errors;
  },
  setLastSaving(state, time){
    state.lastSaving = time;
  },
  setCategory(state, category_id){
    if(state.article) {
      state.article.category_id = category_id;
    }
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};

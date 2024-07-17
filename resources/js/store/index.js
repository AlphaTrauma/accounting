// store/index.js
import { createStore } from 'vuex';
import article from './article';
import page from './page'

const store = createStore({
  modules: {
    article, page
  },
});

export default store;

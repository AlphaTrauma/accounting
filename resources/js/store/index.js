// store/index.js
import { createStore } from 'vuex';
import article from './article';
import page from './page';
import slides from './slides';

const store = createStore({
  modules: {
    article, page, slides
  },
});

export default store;

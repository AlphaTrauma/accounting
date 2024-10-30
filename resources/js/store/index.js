// store/index.js
import { createStore } from 'vuex';
import article from './article';
import page from './page';
import slides from './slides';
import util from './util';

const store = createStore({
  modules: {
    article, page, slides, util
  },
});

export default store;

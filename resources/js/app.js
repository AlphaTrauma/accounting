import './bootstrap';
import store from "./store";
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import MenuItems from './Components/Dashboard/MenuItems.vue';
import PageEditor from './Components/Dashboard/PageEditor.vue';
import ArticleEditor from './Components/Dashboard/ArticleEditor.vue';
import axios from 'axios';
import Categories from './Components/Dashboard/Categories.vue';

const token = document.head.querySelector('meta[name="csrf-token"]').content;

axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp();
app.use(store);
app.config.globalProperties.$axios = axios;
app.component('menu-items', MenuItems);
app.component('article-editor', ArticleEditor);
app.component('page-editor', PageEditor);
app.component('categories', Categories);

app.mount('#app');

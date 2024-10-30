import './bootstrap';
import store from "./store";
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import MenuItems from './Components/Dashboard/MenuItems.vue';
import PageEditor from './Components/Dashboard/PageEditor.vue';
import ArticleEditor from './Components/Dashboard/ArticleEditor.vue';
import axios from 'axios';
import Categories from './Components/Dashboard/Categories.vue';
import SliderEditor from './Components/Dashboard/Slider/Index.vue';
import Slider from './Components/Site/Slider.vue';
import Affiliates from './Components/Site/Affiliates.vue';
import FileManager from './Components/Site/FileManager.vue';
import RequestAction from './Components/Utilities/RequestAction.vue';
import RequestForm from './Components/Utilities/RequestForm.vue';
import ModalWindow from './Components/Utilities/ModalWindow.vue';
import ModalButton from './Components/Utilities/ModalButton.vue';
import Responses from './Components/Site/Responses.vue';

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
app.component('slider-editor', SliderEditor);
app.component('slider-main', Slider);
app.component('affiliates', Affiliates);
app.component('request-action', RequestAction);
app.component('request-form', RequestForm);

app.component('file-manager', FileManager);
app.component('modal-window', ModalWindow);
app.component('modal-button', ModalButton);
app.component('responses-list', Responses);

app.mount('#app');

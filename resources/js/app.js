import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import router from './router';
import 'vue3-toastify/dist/index.css';

const app = createApp({});

app.use(router);

app.mount("#app")

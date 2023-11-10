import './bootstrap';
import { createApp } from 'vue';
import router from './routes/routers.js';
import app from './layouts/app.vue';

createApp(app).use(router).mount("#app");

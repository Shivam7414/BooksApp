import './bootstrap';
import { createApp } from 'vue';
import routes from './routes/routes.js';
import app from './layouts/app.vue';

createApp(app).use(routes).mount("#app");

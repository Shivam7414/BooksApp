import './bootstrap';
import Swal from 'sweetalert2';
import { createApp } from 'vue';
import app from './layouts/app.vue';
import router from './routes/index.js';

createApp(app).use(router).mount("#app");

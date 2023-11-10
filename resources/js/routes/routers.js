import { createWebHashHistory, createRouter } from "vue-router";
import home from '../pages/home.vue';
import register from '../pages/register.vue';
import login from '../pages/login.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },{
        path: '/register',
        name: 'Register',
        component: register
    },{
        path: '/login',
        name: 'Login',
        component: login
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router;
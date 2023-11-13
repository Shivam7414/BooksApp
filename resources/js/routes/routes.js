import { createWebHistory, createRouter } from "vue-router";
import home from '../pages/home.vue';
import adminLogin from '../pages/Admin/login.vue'
import addBook from '../pages/Admin/book/modal/add.vue';
import editBook from '../pages/Admin/book/modal/edit.vue';
import login from '../pages/login.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },{
        path: '/admin/login',
        name: 'admin',
        component: adminLogin
    },{
        path: '/admin/book/index',
        name: 'Login',
        component: login
    },{
        path: '/admin/book/add',
        name: 'addBook',
        component: addBook
    },{
        path: '/admin/book/edit',
        name: 'editBook',
        component: editBook
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
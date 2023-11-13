import { createWebHistory, createRouter } from "vue-router";
import editBook from '../pages/Admin/book/modal/edit.vue';
import addBook from '../pages/Admin/book/modal/add.vue';
import adminLogin from '../pages/Admin/login.vue';
import books from '../pages/Admin/book/index.vue';
import BookDetail from '../pages/BookDetail.vue';
import home from '../pages/home.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },{
        path: '/book-detail/:id',
        name: 'BookDetail',
        component: BookDetail
    },{
        path: '/admin_login',
        name: 'admin',
        component: adminLogin
    },{
        path: '/admin/book/index',
        name: 'books',
        component: books
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
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
        name: 'adminLogin',
        component: adminLogin,
        meta:{
            requireAuth: false
        }
    },{
        path: '/admin/book/index',
        name: 'booksIndex',
        component: books,
        meta:{
            requireAuth: true
        }
    },{
        path: '/admin/book/add',
        name: 'addBook',
        component: addBook,
        meta:{
            requireAuth: true
        }
    },{
        path: '/admin/book/edit',
        name: 'editBook',
        component: editBook,
        meta:{
            requireAuth: true
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from) =>{
    if(to.meta.requireAuth && !localStorage.getItem('token')){
        return { name : 'adminLogin' }
    }
    if(to.meta.requireAuth == false && localStorage.getItem('token')){
        return { name : 'booksIndex' }
    }
});

export default router;
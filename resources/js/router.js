import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import LoginComponent from './components/LoginComponent';
import AdminComponent from './components/AdminComponent';

const routes = [
    {
        path: "/",
        redirect: '/login'
    },
    {
        path: "/login",
        component: LoginComponent,
        name: 'Login',

    },
    {
        path: "/admin",
        component: AdminComponent,
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('token')) {
                next();
            } else {
                next('/login');
            }
        }
    }
];

export default new VueRouter({routes});

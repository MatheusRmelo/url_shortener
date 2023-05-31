import { createRouter, createWebHistory } from 'vue-router';

import Login from '../pages/Login.vue';
import Home from '../pages/Home.vue';
import Register from '../pages/Register.vue';
import Open from '../pages/Open.vue';
import NotFound from '../pages/NotFound.vue';

import apiClient from '../api/apiClient';
import User from '../types/user';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
        path: '/auth',
        children: [
            {
                name: 'login',
                path: 'login',
                component: Login
            },
            {
                name: 'register',
                path: 'register',
                component: Register
            }
        ]
    },
    {
        path: '/',
        component: Home
    },
    {
        path: '/open/:slug',
        component: Open
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
  ]
});

router.beforeEach(async (to, from) => {
    let authenticated = true;
    let token = localStorage.getItem('token');
    if(token == null){
        authenticated = false;
    }
    var response = await apiClient.get<User|null>('/user');
    if(!response.ok){
        authenticated = false;
    }
    if (!to.path.startsWith("/auth") && !authenticated) {
        await router.push("/auth/login");
        return false;
    }else if(to.path.startsWith("/auth") && authenticated){
        await router.push("/");
        return false;
    }
});

export default router



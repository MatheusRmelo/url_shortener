import { createRouter, createWebHistory } from 'vue-router';

import Login from '../pages/Login.vue';
import Home from '../pages/Home.vue';
import apiClient from '../api/apiClient';
import User from '../types/user';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
        path: '/auth',
        children: [
            {
                path: 'login',
                component: Login
            }
        ]
    },
    {
        path: '/',
        component: Home
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
        return false;
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



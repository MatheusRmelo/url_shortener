import { createRouter, createWebHistory } from 'vue-router';

import Login from '../pages/Login.vue';

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
    }
  ]
});

// router.beforeEach(async (to, from) => {
//   if (to.name !== 'auth_callback' && to.name !== 'landing') {
//     var client = await ClientSSO.create();
//     if (!await client.isAuthenticated()) {
//       var result = await client.authorize();
//       if (result) {
//         window.location.href = result;
//       }
//       return false;
//     }
//   }
// });

export default router



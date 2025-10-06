import { createRouter, createWebHistory } from 'vue-router'
import Homes from '../pages/Frontend/Home/Homes.vue';
import FormQoutation from '../pages/Frontend/Qoutation/form.vue';
import Network from '../pages/Frontend/Network/network.vue';
import Login from '../pages/Frontend/Auth/login.vue';
import Registeration from '../pages/Frontend/Auth/registeration.vue';
import FormQout from '../pages/Frontend/Qoutations/Form.vue';





const routes = [

  // for dashboard admin
  { path: '/wpc-esys/login', component: Login },
  { path: '/wpc-esys/registration', component: Registeration },


  // for users

  { 
    path: '/wpc-esys/home', 
    component: Homes, 
    // meta: { requiresAuth: true } // ✅ hanya bisa diakses jika login
  },

  { 
    path: '/wpc-esys/form-qoutation', 
    component: FormQoutation, 
    // meta: { requiresAuth: true } // ✅ hanya bisa diakses jika login
  },

   { 
    path: '/wpc-esys/network', 
    component: Network, 
    // meta: { requiresAuth: true } // ✅ hanya bisa diakses jika login
  },

   { 
    path: '/wpc-esys/qoutation-request', 
    component: FormQout, 
    // meta: { requiresAuth: true } // ✅ hanya bisa diakses jika login
  },



 

 
  
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// ✅ Navigation Guard
// router.beforeEach((to, from, next) => {
//   const auth = useAuthStore();

//   // kalau route butuh login tapi belum login
//   if (to.meta.requiresAuth && !auth.token) {
//     next('/login');
//   } 
//   // kalau sudah login tapi buka /login atau /register
//   else if ((to.path === '/login' || to.path === '/register') && auth.token) {
//     next('/dashboard'); // redirect ke dashboard
//   } 
//   else {
//     next(); // lanjut
//   }
// });




export default router;
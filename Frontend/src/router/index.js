import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/useAuthStore.js';


function checkIfNotLogged() {
  const storeAuth = useAuthStore();
  if (!storeAuth.user) {
    return "/login";
  }
}

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/kartyak',
      name: 'kartyak',
      component: () => import('../views/KartyakView.vue'),
    },
    {
      path: '/diakkeres',
      name: 'diakkeres',
      component: () => import('@/views/Diakkeres.vue'),
    },
    {
      path: '/sportok',
      name: 'sportok',
      component: () => import('@/views/Sportok.vue'),
      beforeEnter: [checkIfNotLogged],
    },
    {
      path: '/osztalyok',
      name: 'osztalyok',
      component: () => import('@/views/Osztalyok.vue'),
      beforeEnter: [checkIfNotLogged],
    },
    {
      path: '/diakok',
      name: 'diakok',
      component: () => import('@/views/Diakok.vue'),
      beforeEnter: [checkIfNotLogged],
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/components/Auth/Login.vue'),
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('@/components/Auth/Profile.vue'),
      beforeEnter: [checkIfNotLogged],
    },
    {
      path: '/registration',
      name: 'registration',
      component: () => import('@/components/Auth/Registration.vue'),
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: HomeView
    },
  ],
})

export default router

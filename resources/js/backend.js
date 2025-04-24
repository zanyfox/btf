import './bootstrap.js'
import '../assets/backend/js/plugins/popper.min.js'
import '../assets/backend/js/plugins/bootstrap.min.js'
import '../assets/backend/js/script.js'
import '../assets/backend/js/theme.js'
import '../assets/backend/js/plugins/feather.min.js'

/* document.addEventListener('DOMContentLoaded', () => {

  if(document.getElementById('mobile-collapse')) {
    document.getElementById('mobile-collapse').addEventListener('click', () => {

      if (document.querySelector('.pcoded-navbar').classList.contains('navbar-collapsed')) {
        localStorage.setItem('sidebarState', 'collapsed')
      } else {
        localStorage.setItem('sidebarState', 'expanded')
      }
    })

    const sidebarState = localStorage.getItem('sidebarState')
    if (sidebarState === 'collapsed') {
      document.querySelector('.pcoded-navbar').classList.add('navbar-collapsed')
    } else {
      document.querySelector('.pcoded-navbar').classList.remove('navbar-collapsed')
    }
  }

}) */

import { createApp } from 'vue/dist/vue.esm-bundler.js'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
const pinia = createPinia()
const app = createApp({})
const router = createRouter({
  history: createWebHistory(import.meta.env.VITE_BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'backend.login',
      component: () => import('./views/LoginView.vue'),
      meta: {
        requiresAuth: false,
        requiresVerified: false
      }
    },
    {
      path: '/backend/dashboard',
      name: 'backend.dashboard',
      component: () => import('./views/backend/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/pages',
      name: 'backend.pages',
      component: () => import('./views/backend/pages/ListView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/colors',
      name: 'backend.colors',
      component: () => import('./views/backend/ColorsView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/types',
      name: 'backend.types',
      component: () => import('./views/backend/TypesView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/categories',
      name: 'backend.categories',
      component: () => import('./views/backend/categories/СategoriesList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/categories/create',
      name: 'backend.categories.create',
      component: () => import('./views/backend/categories/CreateСategory.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/categories/:id/edit',
      name: 'backend.categories.edit',
      component: () => import('./views/backend/categories/EditСategory.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/goods',
      name: 'backend.goods',
      component: () => import('./views/backend/goods/GoodsList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/goods/create',
      name: 'backend.goods.create',
      component: () => import('./views/backend/goods/GoodsList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/goods/:id/edit',
      name: 'backend.goods.edit',
      component: () => import('./views/backend/goods/GoodsList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/goods/import',
      name: 'backend.goods.import',
      component: () => import('./views/backend/goods/GoodsList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/features',
      name: 'backend.features',
      component: () => import('./views/backend/goods/GoodsList.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/messages',
      name: 'backend.messages',
      component: () => import('./views/backend/messages/ListView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/orders',
      name: 'backend.orders',
      component: () => import('./views/backend/orders/ListView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/users',
      name: 'backend.users',
      component: () => import('./views/backend/UsersView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/settings',
      name: 'backend.settings',
      component: () => import('./views/backend/SettingsView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    },
    {
      path: '/backend/profile',
      name: 'backend.profile',
      component: () => import('./views/backend/ProfileView.vue'),
      meta: {
        requiresAuth: true,
        requiresVerified: true
      }
    }
  ]
})
app.use(pinia)
app.use(router)
app.mount('#app')

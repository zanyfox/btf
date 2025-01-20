import './bootstrap'
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from './pages/Dashboard.vue'
import Orders from './pages/orders/List.vue'
import Users from './pages/users/List.vue'
import Profile from './pages/profile/Index.vue'


const app = createApp()

const router = createRouter({
  routes: [
    {
      path: '/backend/dashboard',
      name: 'Dashboard',
      component: Dashboard
    },
    {
      path: '/backend/orders',
      name: 'Orders',
      component: Orders
    },
    {
      path: '/backend/users',
      name: 'Users',
      component: Users
    },
    {
      path: '/backend/profile',
      name: 'Profile',
      component: Profile
    }
  ],
  history: createWebHistory()
})

app.use(router)
app.mount('#backend')
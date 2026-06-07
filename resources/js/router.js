import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from './stores/user'
const router = createRouter({
  history: createWebHistory(import.meta.env.VITE_BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'backend.login',
      component: () => import('./views/LoginView.vue'),
      /* meta: {
        requiresAuth: false,
        requiresVerified: false
      } */
    },
    {
      path: '/backend/dashboard',
      name: 'backend.dashboard',
      component: () => import('./views/backend/DashboardView.vue'),
      /* meta: {
        requiresAuth: true,
        requiresVerified: true
      } */
      beforeEnter: async(to, from, next) => {
        //next()
        try {
          const userStore = useUserStore()
          //await userStore.fetchUser()
          next()
        } catch(error) {
          console.log(error.message)
          next(false)
        }
      }
    },
    {
      path: '/backend/pages',
      name: 'BackendPageIndex',
      component: () => import('./views/backend/pages/IndexView.vue'),
    },
    {
      path: '/backend/pages/create',
      name: 'BackendPageCreate',
      component: () => import('./views/backend/pages/CreateView.vue'),
    },
    {
      path: '/backend/pages/:id/edit',
      name: 'BackendPageEdit',
      component: () => import('./views/backend/pages/EditView.vue'),
      props: true
    },
    {
      path: '/backend/rubrics',
      name: 'backend.rubrics',
      component: () => import('./views/backend/rubrics/RubricsList.vue'),
    },
    {
      path: '/backend/posts',
      name: 'backend.posts',
      //component: () => import('./views/backend/posts/PostIndex.vue'),
      children: [
        {
          path: '/backend/posts',
          name: 'PostIndex',
          component: () => import('./views/backend/posts/PostIndex.vue'),
        },
        {
          path: '/backend/posts/create',
          name: 'PostCreate',
          component: () => import('./views/backend/posts/PostCreate.vue'),
        },
        {
          path: '/backend/posts/:id/edit',
          name: 'PostEdit',
          component: () => import('./views/backend/posts/PostEdit.vue'),
        }
      ]
    },
    /* {
      path: '/backend/posts/create',
      name: 'PostCreate',
      component: () => import('./views/backend/posts/PostCreate.vue'),
    },
    {
      path: '/backend/posts/:id/edit',
      name: 'PostEdit',
      component: () => import('./views/backend/posts/PostEdit.vue'),
    }, */
    /* {
      path: '/backend/posts/create',
      name: 'PostCreate',
      component: () => import('./views/backend/posts/PostCreate.vue'),
    },
    {
      path: '/backend/posts/:id/edit',
      name: 'PostEdit',
      component: () => import('./views/backend/posts/PostEdit.vue'),
    }, */
    /* {
      path: '/backend/mainslider',
      children: [
        {
          path: '/backend/mainslider',
          name: 'PostIndex',
          component: () => import('./views/backend/posts/PostIndex.vue'),
        },
        {
          path: '/backend/mainslider/create',
          name: 'PostCreate',
          component: () => import('./views/backend/posts/PostCreate.vue'),
        },
        {
          path: '/backend/mainslider/:id/edit',
          name: 'PostEdit',
          component: () => import('./views/backend/posts/PostEdit.vue'),
        }
      ]
    }, */
    {
      path: '/backend/colors',
      name: 'backend.colors',
      component: () => import('./views/backend/ColorsView.vue'),
    },
    {
      path: '/backend/types',
      name: 'backend.types',
      component: () => import('./views/backend/TypesView.vue'),
    },
    {
      path: '/backend/categories',
      name: 'backend.categories',
      component: () => import('./views/backend/categories/СategoriesList.vue'),
    },
    {
      path: '/backend/categories/create',
      name: 'backend.categories.create',
      component: () => import('./views/backend/categories/CreateСategory.vue'),
    },
    {
      path: '/backend/categories/:id/edit',
      name: 'backend.categories.edit',
      component: () => import('./views/backend/categories/EditСategory.vue'),
    },
    {
      path: '/backend/goods',
      name: 'backend.goods',
      component: () => import('./views/backend/goods/GoodsList.vue'),
    },
    {
      path: '/backend/goods/create',
      name: 'backend.goods.create',
      component: () => import('./views/backend/goods/GoodsList.vue'),
    },
    {
      path: '/backend/goods/:id/edit',
      name: 'backend.goods.edit',
      component: () => import('./views/backend/goods/GoodsList.vue'),
    },
    {
      path: '/backend/goods/import',
      name: 'backend.goods.import',
      component: () => import('./views/backend/goods/GoodsList.vue'),
    },
    {
      path: '/backend/features',
      name: 'backend.features',
      component: () => import('./views/backend/goods/GoodsList.vue'),
    },
    {
      path: '/backend/messages',
      name: 'backend.messages',
      component: () => import('./views/backend/Messages.vue'),
    },
    {
      path: '/backend/orders',
      name: 'backend.orders',
      component: () => import('./views/backend/orders/ListView.vue'),
    },
    {
      path: '/backend/users',
      name: 'backend.users',
      component: () => import('./views/backend/Users.vue'),
    },
    {
      path: '/backend/settings',
      name: 'backend.settings',
      component: () => import('./views/backend/SettingsView.vue'),
    },
    {
      path: '/backend/profile',
      name: 'backend.profile',
      component: () => import('./views/backend/ProfileView.vue'),
    },
    {
      path: '/backend/:pathMatch(.*)*',
      name: 'backend.NotFound',
      component: () => import('./views/backend/NotFound.vue'),
    }
  ]
})

export default router

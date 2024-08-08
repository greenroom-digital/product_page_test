import { createRouter, createWebHashHistory } from 'vue-router'

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: '/',
      redirect: () => ({ name: 'product', params: { slug: 'fall-limited-edition-sneakers' } })
    },
    {
      path: '/client/products/:slug',
      name: 'product',
      component: () => import('./views/Product.vue')
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: () => import('./views/NotFound.vue')
    },
  ],
})

export default router;
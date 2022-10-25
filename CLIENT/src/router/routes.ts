import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/IndexLayout.vue'),
    children: [{ path: '', component: () => import('pages/Index.vue') }],
  },
  {
    path: '/game/:code',
    component: () => import('layouts/MainLayout.vue'),
    children: [{ path: '', component: () => import('pages/Game/Index.vue') }],
  },
  {
    path: '/undercover',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'indexUndercover',
        component: () => import('pages/Undercover/Index.vue'),
      },

      {
        name: 'new-players',
        path: 'players',
        component: () => import('pages/Undercover/players.vue'),
      },
      {
        name: 'reveal',
        path: 'reveal/:id',
        component: () => import('pages/Undercover/DiscoverMember.vue'),
      },
    ],
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;

function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { 
    path: '/',
    component: page('app/index.vue'),
    children: [
      {
        path: '', 
        name: 'index', 
        component: page('app/home.vue'),
      }
    ],
  },
  { 
    path: '/',
    component: page('auth/index.vue'),
    meta: {
      middleware: ['guest']
    },
    children: [
      { path: '/admin/login', name: 'login', component: page('auth/login.vue') },
      // { path: '/admin/register', name: 'register', component: page('auth/register.vue') },
      // { path: '/admin/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
      // { path: '/admin/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
      // { path: '/admin/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
      // { path: '/admin/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
    ]
  },
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: page('app/admin/index.vue'),
    meta: {
      middleware: ['auth']
    },

    children: [
      
      {
        path: 'subjects', 
        name: 'admin.subjects',
        component: page('app/admin/subjects/index.vue'),
        children: [
          {
            path: '/admin/subjects',
            name: 'admin.subjects.index', 
            component: page('app/admin/subjects/index.vue'),
          },
          {
            path: 'create', 
            name: 'admin.subjects.create', 
            component: page('app/admin/subjects/create.vue'),
          },
          {
            path: 'edit', 
            name: 'admin.subjects.edit', 
            component: page('app/admin/subjects/edit.vue'),
          },
        ]
      },
      {
        path: 'categories', 
        name: 'admin.categories',
        component: page('app/admin/categories/index.vue'),
        children: [
          {
            path: '/admin/categories',
            name: 'admin.categories.index', 
            component: page('app/admin/categories/index.vue'),
          },
          {
            path: 'create', 
            name: 'admin.categories.create', 
            component: page('app/admin/categories/create.vue'),
          },
          {
            path: 'edit', 
            name: 'admin.categories.edit', 
            component: page('app/admin/categories/edit.vue'),
          },
        ]
      },
      {
        path: 'subcategories', 
        name: 'admin.subcategories',
        component: page('app/admin/subcategories/index.vue'),
        children: [
          {
            path: '/admin/subcategories',
            name: 'admin.subcategories.index', 
            component: page('app/admin/subcategories/index.vue'),
          },
          {
            path: 'create', 
            name: 'admin.subcategories.create', 
            component: page('app/admin/subcategories/create.vue'),
          },
          {
            path: 'edit', 
            name: 'admin.subcategories.edit', 
            component: page('app/admin/subcategories/edit.vue'),
          },
        ]
      },
      
    ]
  },

  // { path: '/login', name: 'login', component: page('auth/login.vue') },
  // { path: '/register', name: 'register', component: page('auth/register.vue') },
  // { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  // { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  // { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  // { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  // { path: '/home', name: 'home', component: page('home.vue') },
  // {
  //   path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
  //     { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
  //   ]
  // },

  { path: '*', component: page('errors/404.vue') }
]

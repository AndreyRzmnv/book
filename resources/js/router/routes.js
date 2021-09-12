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
    path: '/admin',
    component: page('app/admin/index.vue'),
    children: [
      {
        path: '/admin', 
        name: 'admin.index', 
        component: page('app/admin/index.vue'),
      },
      {
        path: 'subjects', 
        name: 'subjects', 
        // component: page('app/admin/index.vue'),
        children: [
          {
            path: '/subjects',
            name: 'admin.subjects.index', 
            component: page('app/home/index.vue'),
          },
          {
            path: 'create', 
            name: 'admin.subjects.create', 
            component: page('app/home/create.vue'),
          },
          {
            path: 'edit', 
            name: 'admin.subjects.edit', 
            component: page('app/home/edit.vue'),
          },
        ]
      }
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

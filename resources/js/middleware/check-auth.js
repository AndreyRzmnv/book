import store from '~/store'

export default async (to, from, next) => {
  console.log(store.getters['auth/check']);
  if (!store.getters['auth/check'] && store.getters['auth/token']) {
    try {
      await store.dispatch('auth/fetchUser')
    } catch (e) { }
  }

  next()
}

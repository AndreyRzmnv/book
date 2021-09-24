import store from '~/store'

export default (to, from, next) => {
  console.log(store.getters['auth/check']);
  if (store.getters['auth/check']) {
    next({ name: 'home' })
  } else {
    next()
  }
}

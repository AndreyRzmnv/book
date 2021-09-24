import store from '~/store'
import Cookies from 'js-cookie'

export default async (to, from, next) => {
  console.log(!store.getters['auth/check']);
  if (!store.getters['auth/check']) {
    Cookies.set('intended_url', to.path)

    next({ name: 'login' })
  } else {
    next()
  }
}

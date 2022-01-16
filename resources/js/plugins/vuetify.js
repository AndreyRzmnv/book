import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import i18n from '~/plugins/i18n'
import store from '~/store'
import en from 'vuetify/es5/locale/en'
import ru from 'vuetify/es5/locale/ru'


Vue.use(Vuetify)
const opts = {
    theme: { dark: true },
    lang: {
        locales: { en, ru },
        current: store.getters['lang/locale'] || 'en',
        t: (key, ...params) => i18n.t(key, params)
      },
    
}

export default new Vuetify(opts)
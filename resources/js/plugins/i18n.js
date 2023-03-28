// import Vue from 'vue'
// import store from '~/store'
import { createI18n } from 'vue-i18n'

// Vue.use(VueI18n)

const i18n = createI18n({
  locale: 'fr',
  messages: {},
  silentTranslationWarn: true,
})
// const localeI18n = useI18n()
const localeI18n = i18n.global
/**
 * @param {String} locale
 */

export async function loadMessages() {
  const locale = 'fr'
  if (Object.keys(localeI18n.getLocaleMessage(locale)).length === 0) {
    const messages = await import(/* webpackChunkName: '' */ `~/lang/${locale}`)
    localeI18n.setLocaleMessage(locale, messages)
  }

  if (localeI18n.locale !== locale) {
    localeI18n.locale = locale
  }
}

; (async function () {
  await loadMessages()
})()

export default i18n

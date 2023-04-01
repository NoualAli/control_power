import { createApp } from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import { user } from './plugins/helpers'
import api from './plugins/api'
import '~/plugins'
import { LoadingPlugin } from 'vue-loading-overlay'
import { createMetaManager as createVueMetaManager, defaultConfig, plugin as pluginVueMeta } from 'vue-meta'
import Swal from 'sweetalert2'
import Vue3Breadcrumbs from 'vue-3-breadcrumbs'
import App from '~/components/App'
import '~/components'

import { useComponents } from './components'
import { aclMixin, defineDirectives } from './plugins/acl.js'
window.Swal = Swal
window.api = api
window.user = user
const app = createApp(App)
app.use(store)
app.use(router)
app.use(i18n)
app.use(createVueMetaManager(false, { ...defaultConfig, meta: { tag: 'meta', nameless: true } })) // gotta update meta and use it differently
app.use(pluginVueMeta) // gotta update meta and use it differently
app.use(LoadingPlugin, {
  'is-full-page': true
}, {})

app.use(Vue3Breadcrumbs)

app.config.globalProperties.$api = api

app.mixin(aclMixin)

useComponents(app)
defineDirectives(app)
app.config.performance = true
app.config.errorHandler = (err, vm, info) => {
  // handle error
  console.error(err)
  console.log(vm)
  console.log(info)
}
app.mount('#app')

require('./bootstrap')

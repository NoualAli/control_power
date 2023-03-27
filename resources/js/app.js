import { createApp } from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import { user } from './plugins/helpers'
import { useChartJs } from './plugins/charts'
import * as swal from './plugins/swal'
import api from './plugins/api'
import '~/plugins'
// import loader from 'vue-ui-preloader'
import Meta from 'vue-meta'
// import Router from 'vue-router'
import Swal from 'sweetalert2'
import Vue3Breadcrumbs from 'vue-3-breadcrumbs'
import App from '~/components/App'
import '~/components'

import { useComponents } from './components'
import { aclMixin, defineDirectives } from './plugins/acl.js'
import Vuex from 'vuex'
window.Swal = Swal
window.api = api
window.user = user
const app = createApp(App)
app.use(router)
app.use(store)
app.use(i18n)
// currently there is no support for vue-meta for vue 3  except alpha
// app.use(Meta) // gotta update meta and use it differently 
// app.use(Router)
app.use(Vue3Breadcrumbs)
// app.use(loader)
app.use(swal)
app.use(api)
app.use(Vuex)
app.mixin(aclMixin)
useChartJs(app)
useComponents(app)
// defineDirectives(app)
app.mount('#App')

router.$app = app
// window.$app = app


// Vue.use(Vue3Breadcrumbs)
// Vue.use(loader)
// Vue.use(swal)
// Vue.use(api)

// Vue.config.productionTip = false

// /* eslint-disable no-new */
// new Vue({
//   i18n,
//   store,
//   router,
//   ...App
// })





require('./bootstrap')

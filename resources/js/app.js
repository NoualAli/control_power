import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import loader from "vue-ui-preloader";
import Swal from 'sweetalert2'
import * as swal from './plugins/swal'
import Vue2Crumbs from 'vue-2-crumbs'
import api from './plugins/api'
import { user } from './plugins/helpers'
import App from '~/components/App'
import '~/plugins'
import '~/components'
window.Swal = Swal
window.swal = swal
window.api = api
window.user = user

Vue.use(Vue2Crumbs)
Vue.use(loader);
Vue.use(swal)
Vue.use(api)
Vue.use(collect)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})

require('./bootstrap')

<template>
  <div id="app">
    <!-- <loading
      v-model:="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    /> -->
    <transition name="page" mode="out-in">
      <component :is="layout" v-if="layout" />
      <!-- <h1 class="im-here">
        I AM HERE don't FEAR
      </h1> -->
    </transition>
  </div>
</template>

<script>
// import Loading from './Loading'
import Loading from 'vue-loading-overlay'
// import { shallowRef } from 'vue'
// Load layout components dynamically.
// const requireContext = require.context('~/layouts', false, /.*\.vue$/)

// const layouts = requireContext.keys()
//   .map(file =>
//     [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
//   )
//   .reduce((components, [name, component]) => {
//     components[name] = component.default || component
//     return components
//   }, {})

export default {
  el: '#app',

  components: {
    Loading
  },

  data: () => ({
    // layout: null,
    // defaultLayout: 'default',
    layout: null,
    isLoading: false
    // namespace: 'layout'
  }),

  metaInfo () {
    const {
      appName
    } = window.config

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`
    }
  },
  computed: {
    // layout () {
    //   return this.$store.getters['layout/layout']
    // }
  },
  beforeCreate () {
    // this.$store.dispatch('layout/setLayout', '')
    // this.$store.dispatch['layout/setLayout', '']
  },
  mounted () {
    console.log(this.layout)
    console.log(this.$store.getters['layout/layout'])
    // this.layout = 'something'
    // this.$loading = this.$refs.loading
  },
  methods: {
    setLayout (v) {
      return this.$store.dispatch('layout/setLayout', '')
    }
  }
}
</script>
<!--
import {
    Search
} from "@element-plus/icons-vue";
import {
    shallowRef
} from "vue";
components: {
    Search
}, Data() {
    return {
        Search: shallowRef(Search)
    }
} -->

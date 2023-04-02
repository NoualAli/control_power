// eslint-disable-next-line vue/first-attribute-linebreak
<template>
  <div id="app">
    <!-- <loading
      v-model:="isLoading"
      :can-cancel="true"
      :on-cancel="onCancel"
      :is-full-page="fullPage"
    /> -->
    <!-- <router-view v-slot="{layout}"> -->
    <transition name="page" mode="out-in">
      <template v-if="layout">
        <component :is="layout">
          <slot />
        </component>
      </template>
    </transition>
    <!-- <h1 class="im-here">
        I AM HERE don't FEAR
      </h1> -->
    <!-- </router-view> -->
  </div>
</template>

<script>
// import Loading from './Loading'
import Loading from 'vue-loading-overlay'
import defaultLayout from '~/layouts/default.vue'
import { markRaw } from 'vue'
// Load layout components dynamically.
const requireContext = require.context('~/layouts', false, /.*\.vue$/)

// const layouts = requireContext.keys()
//   .map(file =>
//     [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
//   )
//   .reduce((components, [name, component]) => {
//     components[name] = shallowRef(component.default || component)
//     return components
//   }, {})
export default {
  el: '#app',

  components: {
    Loading
  },

  data: () => ({
    layout: null,
    defaultLayout: markRaw(defaultLayout),
    isLoading: false
  }),

  metaInfo () {
    const { appName } = window.config

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`
    }
  },
  computed: {
    layouts () {
      return requireContext.keys()
        .map(file =>
          [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
        )
        .reduce((components, [name, component]) => {
          components[name] = component.default || component
          return components
        }, {})
    }
  },
  watch: {
    $route: {
      // immediate: true,
      async handler (route) {
        try {
          this.setLayout(route.meta.layout)
        } catch (e) {
          this.layout = defaultLayout
        }
      }
    }
  },
  mounted () {
    // this.$loading = this.$refs.loading
  },

  methods: {
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    async setLayout (layout) {
      const component = await import(`~/layouts/${layout}.vue`)
      const tempLayout = markRaw(component?.default || this.defaultLayout)
      this.layout = markRaw(tempLayout)
    }
  }
}
</script>

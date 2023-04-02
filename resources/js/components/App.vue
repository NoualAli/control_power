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
      <!-- <h1 class="im-here">
        I AM HERE don't FEAR
      </h1> -->
    </transition>
    <!-- </router-view> -->
  </div>
</template>

<script>
// import Loading from './Loading'
import Loading from 'vue-loading-overlay'
import defaultLayout from '~/layouts/default.vue'
import { shallowRef, markRaw } from 'vue'
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
console.log(defaultLayout)
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
          console.log(components)
          return components
        }, {})
    }
  },
  watch: {
    $route: {
      // immediate: true,
      async handler (route) {
        try {
          console.log(route)
          this.setLayout(route.meta.layout)

          // const component = await import(`~/layouts/${route.meta.layout}.vue`)
          // const tempLayout = markRaw(component?.default || defaultLayout)
          // console.log(tempLayout.name === this.layouts[route.meta.layout].value.name)
          //  {
          //   console.log('m here')
          //   this.layout = tempLayout
          // }

          // this.getLayout(route.meta.layout)
          // console.log('between get ')
          // console.log(this.layout)
          // console.log(this.layouts[route.meta.layout])
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
    setLayout (layout) {
      if (!layout || !this.layouts[layout]) {
        layout = this.defaultLayout
      }

      this.layout = markRaw(this.layouts[layout])
    },
    getLayout (layout) {
      if (!layout || !this.layouts[layout]) {
        layout = this.defaultLayout
      }
      console.log(this.layouts[layout])
      console.log(this.layouts)
      console.log(layout)
      // return layouts[layout]
    }
  }
}
</script>

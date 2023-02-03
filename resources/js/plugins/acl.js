import Vue from "vue";
import api from "./api";
import { user } from "./helpers";

api.get('user').then(success => {
  localStorage.setItem("authorizations", JSON.stringify(success.data.authorizations));
});

/**
 * v-can: Check user abilities to determine if he can perform or not some action
 */
Vue.directive('can', {
  bind: function (el, binding, vnode) {
    const authorizations = JSON.parse(localStorage.getItem('authorizations'))
    const abilities = binding.value.split(',') || binding.value.split(', ')
    let hasAbilities = []
    abilities.forEach((ability) => {
      ability = ability.trim()
      hasAbilities.push(!authorizations[ ability ] || authorizations[ ability ] == undefined)
    })
    if (!hasAbilities.includes(false)) {
      const comment = document.createComment(' ');
      Object.defineProperty(comment, 'setAttribute', {
        value: () => undefined,
      });
      vnode.elm = comment;
      vnode.text = ' ';
      vnode.isComment = true;
      vnode.context = undefined;
      vnode.tag = undefined;
      vnode.data.directives = undefined;

      if (vnode.componentInstance) {
        vnode.componentInstance.$el = comment;
      }

      if (el.parentNode) {
        el.parentNode.replaceChild(comment, el);
      }
    }
  }
})
// Vue.directive('cannot', {
//   bind: function (el, binding, vnode) {
//     const authorizations = JSON.parse(localStorage.getItem('authorizations'))
//     return !(!authorizations[ binding.value ] || authorizations[ binding.value ] == undefined)
//   }
// })


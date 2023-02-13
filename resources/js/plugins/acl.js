
import Vue from "vue";
import api from "./api";

api.get('user').then(success => {
  localStorage.setItem("authorizations", JSON.stringify(success.data.authorizations));
});
/**
 * v-can: Check user abilities to determine if he can perform or not some action
*/
Vue.directive('can', {
  bind: function (el, binding, vnode) {
    let can = []
    const authorizations = JSON.parse(localStorage.getItem('authorizations')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    abilities.some(ability => {
      can.push(!authorizations.hasOwnProperty(ability.trim()))
    });
    if (can.every(value => value === true)) {
      customComment(vnode, el)
    }
    return
  }
})

/**
 * v-has-role: Check user roles to determine if he can perform or not some action
 */
Vue.directive('has-role', {
  bind: function (el, binding, vnode) {
    const roles = JSON.parse(localStorage.getItem('roles')) || [];
    const data = (binding.value || '').split(/\s*,\s*/);
    const hasRole = data.some(item => roles.some(role => role.code === item.trim()));
    if (!hasRole) {
      customComment(vnode, el)
    }
    return
  }
})

/**
 * Create a custom comment
 *
 * @param {Object} vnode
 * @param {Object} el
 *
 * @return {void}
 */
function customComment(vnode, el) {
  const comment = document.createComment(' ');
  Object.defineProperty(comment, 'setAttribute', {
    value: () => undefined
  });
  vnode.elm = comment;
  vnode.text = ' ';
  vnode.isComment = true;
  vnode.context = undefined;
  vnode.tag = undefined;
  vnode.data.directives = undefined;

  if (vnode.componentInstance) {
    vnode.componentInstance.$el.classList.add('d-none')
    vnode.componentInstance.$el.style = 'display:none !important'
    vnode.componentInstance.$el = comment;
  }

  if (el.parentNode) {
    el.parentNode.replaceChild(comment, el);
  }
}

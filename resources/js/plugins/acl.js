
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
    const vifDirective = vnode.data.directives.find(directive => directive.name === 'if');
    const authorizations = JSON.parse(localStorage.getItem('authorizations')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    if (abilities.every(ability => !authorizations.hasOwnProperty(ability.trim()) && !authorizations[ ability.trim() ]) && (!vifDirective || vnode.context[ vifDirective.expression ])) {
      abilities.forEach(ability => {
        if (!authorizations.hasOwnProperty(ability.trim())) {
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
            vnode.componentInstance.$parent = comment
            vnode.componentInstance.$el = comment;
          }

          if (el.parentNode) {
            el.parentNode.replaceChild(comment, el);
          }
        }
      });
    }

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
        vnode.componentInstance.$el = comment;
      }

      if (el.parentNode) {
        el.parentNode.replaceChild(comment, el);
      }
    }

  }
})


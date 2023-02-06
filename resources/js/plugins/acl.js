
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
    const hasIfCond = vnode.data.directives.find(directive => directive.name === 'if')
    const ifCondResult = hasIfCond ? vnode.context[ vifDirective.expression ] : true
    const hasElseCond = vnode.data.directives.find(directive => directive.name === 'else')
    const elseCondResult = hasElseCond ? false : true
    const authorizations = JSON.parse(localStorage.getItem('authorizations'))
    const abilities = binding.value.split(',') || binding.value.split(', ')
    let hasAbilities = []
    hasAbilities.push(ifCondResult)
    hasAbilities.push(elseCondResult)
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

/**
 * v-has-role: Check user roles to determine if he can perform or not some action
 */
Vue.directive('has-role', {
  bind: function (el, binding, vnode) {
    const roles = JSON.parse(localStorage.getItem('roles'))
    const data = binding.value.split(',') || binding.value.split(', ')
    let hasRoles = []
    data.forEach((item) => {
      item = item.trim()
      roles.forEach(role => {
        hasRoles.push(role.code == item)
      })
    })
    if (!hasRoles.includes(true)) {
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


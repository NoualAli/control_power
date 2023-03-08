import Vue from "vue";
import api from "./api";
import { hasRole, isAbleTo } from './user'

Vue.mixin({
  computed: {
    can() {
      return (permissions) => {
        return isAbleTo(permissions)
      };
    },
    is() {
      return (roles) => {
        return hasRole(roles)
      };
    },
  }
})

/**
 * v-can: Check user abilities to determine if he can perform or not some action
*/
Vue.directive('can', {
  bind: function (el, binding, vnode) {
    let can = []
    const permissions = JSON.parse(localStorage.getItem('permissions')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    const vifDirective = checkVIfDire(vnode, binding)
    abilities.some(ability => {
      can.push(!permissions.hasOwnProperty(ability.trim()) || vifDirective)
    });
    if (can.every(value => value === true)) {
      customComment(vnode, el)
    }
    return
  },
  update: function (el, binding, vnode) {
    let can = []
    const permissions = JSON.parse(localStorage.getItem('permissions')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    const vifDirective = checkVIfDire(vnode, binding)
    abilities.some(ability => {
      can.push(!permissions.hasOwnProperty(ability.trim()))
    });
    if (vifDirective || can.every(value => value === true)) {
      customComment(vnode, el)
    }
    return
  },
})

Vue.directive('can-hide', {
  bind: function (el, binding, vnode) {
    const permissions = JSON.parse(localStorage.getItem('permissions')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    abilities.forEach(ability => {
      if (!permissions.hasOwnProperty(ability.trim())) {
        el.style.display = 'none';
      }
    });
  }
});

Vue.directive('can-strict', {
  bind: function (el, binding, vnode) {
    let can = []
    const permissions = JSON.parse(localStorage.getItem('permissions')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    const vifDirective = checkVIfDire(vnode, binding)
    abilities.every(ability => {
      can.push(!permissions.hasOwnProperty(ability.trim()) && vifDirective)
    });
    if (can.every(value => value === true)) {
      customComment(vnode, el)
    }
    return
  },
  update: function (el, binding, vnode) {
    let can = []
    const permissions = JSON.parse(localStorage.getItem('permissions')) || [];
    const abilities = (binding.value || '').split(/\s*,\s*/);
    const vifDirective = checkVIfDire(vnode, binding)
    abilities.every(ability => {
      can.push(!permissions.hasOwnProperty(ability.trim()) && vifDirective)
    });
    if (can.every(value => value === true)) {
      customComment(vnode, el)
    }
    return
  },
})

/**
 * v-has-role: Check user roles to determine if he can perform or not some action
 */
Vue.directive('has-role', {
  bind: function (el, binding, vnode) {
    const roles = JSON.parse(localStorage.getItem('roles')) || [];
    const data = (binding.value || '').split(/\s*,\s*/);
    const vifDirective = checkVIfDire(vnode, binding)
    const hasRole = data.some(item => roles.some(role => role.code === item.trim()));
    if (!hasRole && !vifDirective) {
      customComment(vnode, el)
    }
    return
  },
  update: function (el, binding, vnode) {
    const roles = JSON.parse(localStorage.getItem('roles')) || [];
    const data = (binding.value || '').split(/\s*,\s*/);
    const hasRole = data.some(item => roles.some(role => role.code === item.trim()));
    const vifDirective = checkVIfDire(vnode, binding)
    if (!hasRole && !vifDirective) {
      customComment(vnode, el)
    }
    return
  }
})

Vue.directive('is-current-user', {
  bind: function (el, binding, vnode) {
    hide(binding, el)
    const user = binding.value;
    api.get('user').then((response) => {
      if (response.data.id !== user) {
        customComment(vnode, el)
      } else {
        show(binding, el)
      }
    })
    return
  }
})

Vue.directive('is-not-current-user', {
  bind: function (el, binding, vnode) {
    hide(binding, el)
    const user = binding.value;
    api.get('user').then((response) => {
      if (response.data.id == user) {
        customComment(vnode, el)
      } else {
        show(binding, el)
      }
    })
    return
  }
})

function getVIfDireRes(binding) {
  return !!binding.value
}

/**
 * Test v-if result
 *
 * @param {Object} vnode
 * @param {Object} binding
 *
 * @return {Boolean}
 */
function checkVIfDire(vnode, binding) {
  return getVIfDireRes(binding) ? vnode.data.directives.some((directive) => directive.name === 'if') : false;
}
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

/**
 * Hide html element
 *
 * @param {HTMLElement} el
 *
 * @return {void}
 */
function hide(binding, el) {
  const element = el.nodeType == 1 ? el : null
  if (element) {
    element.classList.add('d-none')
    element.style = 'display:none !important'
  }
}

/**
 * Show html element
 *
 * @param {HTMLElement} el
 *
 * @return {void}
 */
function show(binding, el) {
  const element = el.nodeType == 1 ? el : null
  if (element) {
    element.classList.remove('d-none')
    element.style = ''
  }
}

function isHtmlTag(element) {
  return /^<([a-zA-Z0-9]+)(\s[^>]*|\/>|>)/i.test(element)
}

"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1425],{1425:(t,e,n)=>{n.r(e),n.d(e,{default:()=>c});var i=n(2097),o=n(629);function a(t){return a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},a(t)}function r(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,i)}return n}function s(t,e,n){return(e=function(t){var e=function(t,e){if("object"!==a(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var i=n.call(t,e||"default");if("object"!==a(i))return i;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===a(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const l={components:{NLDatatable:i.Z},layout:"backend",middleware:["auth","admin"],metaInfo:function(){return{title:"Domaines"}},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?r(Object(n),!0).forEach((function(e){s(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},(0,o.Se)({domains:"domains/paginated",domain:"domains/current"})),data:function(){return{rowSelected:null,config:{data:null,columns:[{label:"Famille",field:"familly.name"},{label:"Nom",field:"name",orderable:!0},{label:"Nombres de processus",field:"processes_count"}],actions:{show:function(t){return user().authorizations.view_domain},edit:function(t){return user().authorizations.edit_domain},delete:function(t){return user().authorizations.delete_domain}}}}},created:function(){this.initData()},methods:{show:function(t){var e=this;this.$store.dispatch("domains/fetch",{id:t.id}).then((function(){return e.rowSelected=e.domain.current}))},edit:function(t){this.$router.push({name:"domains-edit",params:{domain:t.id}})},destroy:function(t){var e=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&api.delete("domains/"+t.id).then((function(t){t.data.status?(e.rowSelected=null,e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error()}))},initData:function(){var t=this;this.$store.dispatch("domains/fetchPaginated").then((function(){t.config.data=t.domains.paginated}))}}};const c=(0,n(1900).Z)(l,(function(){var t=this,e=t._self._c;return e("div",{directives:[{name:"can",rawName:"v-can",value:"view_domain",expression:"'view_domain'"}]},[e("ContentHeader",{scopedSlots:t._u([{key:"actions",fn:function(){return[e("router-link",{directives:[{name:"can",rawName:"v-can",value:"create_domain",expression:"'create_domain'"}],staticClass:"btn btn-info",attrs:{to:{name:"domains-create"}}},[t._v("\n        Ajouter\n      ")])]},proxy:!0}])}),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{config:t.config,title:"Liste des domaines",namespace:"domains"},on:{show:t.show,delete:t.destroy,edit:t.edit}}),t._v(" "),e("NLModal",{attrs:{show:t.rowSelected},on:{close:function(e){t.rowSelected=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("Informations domaine")]},proxy:!0},{key:"default",fn:function(){var n,i,o;return[e("div",{staticClass:"grid list"},[e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Domaine\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(n=t.rowSelected)||void 0===n?void 0:n.name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Famille\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(i=t.rowSelected)||void 0===i||null===(o=i.familly)||void 0===o?void 0:o.name)+"\n            ")])])])]},proxy:!0},{key:"footer",fn:function(){var n,i,o,a;return[null!==(n=t.rowSelected)&&void 0!==n&&n.authorizations.delete||null!==(i=t.rowSelected)&&void 0!==i&&i.authorizations.edit?e("div",{staticClass:"d-flex justify-end align-center gap-5 w-100"},[null!==(o=t.rowSelected)&&void 0!==o&&o.authorizations.delete?e("button",{staticClass:"btn btn-danger has-icon",on:{click:function(e){return e.preventDefault(),t.destroy(t.rowSelected)}}},[e("i",{staticClass:"las la-trash icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Supprimer\n            ")])]):t._e(),t._v(" "),null!==(a=t.rowSelected)&&void 0!==a&&a.authorizations.edit?e("button",{staticClass:"btn btn-warning has-icon",on:{click:function(e){return e.preventDefault(),t.edit(t.rowSelected)}}},[e("i",{staticClass:"las la-edit icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Modifier\n            ")])]):t._e()]):t._e()]},proxy:!0}])})],1)],1)}),[],!1,null,null,null).exports}}]);
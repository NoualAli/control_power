"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[8165],{8165:(t,e,n)=>{n.r(e),n.d(e,{default:()=>l});var r=n(330),i=n(629);function o(t){return o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},o(t)}function a(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function s(t,e,n){return(e=function(t){var e=function(t,e){if("object"!==o(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var r=n.call(t,e||"default");if("object"!==o(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===o(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const c={components:{NLDatatable:r.Z},layout:"backend",middleware:["auth","admin"],metaInfo:function(){return{title:"Dre"}},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?a(Object(n),!0).forEach((function(e){s(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},(0,i.Se)({dres:"dre/paginated",dre:"dre/current"})),data:function(){var t=this;return{rowSelected:null,config:{data:null,columns:[{label:"Code",field:"code",orderable:!0},{label:"Nom",field:"name",orderable:!0},{label:"Nombre d'agences",field:"agencies_count"}],actions:{show:function(e){return t.can("view_dre")},edit:function(e){return t.can("edit_dre")},delete:function(e){return t.can("delete_dre")}}}}},created:function(){this.initData()},methods:{show:function(t){var e=this;this.$store.dispatch("dre/fetch",t.id).then((function(){return e.rowSelected=e.dre.current}))},edit:function(t){this.$router.push({name:"dre-edit",params:{dre:t.id}})},destroy:function(t){var e=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&api.delete("dre/"+t.id).then((function(t){t.data.status?(e.rowSelected=null,e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error()}))},initData:function(){var t=this;this.$store.dispatch("dre/fetchPaginated").then((function(){t.config.data=t.dres.paginated}))}}};const l=(0,n(1900).Z)(c,(function(){var t=this,e=t._self._c;return t.can("view_dre")?e("div",[e("ContentHeader",{scopedSlots:t._u([{key:"actions",fn:function(){return[t.can("create_dre")?e("router-link",{staticClass:"btn btn-info",attrs:{to:{name:"dre-create"}}},[t._v("\n        Ajouter\n      ")]):t._e()]},proxy:!0}],null,!1,2261056348)}),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{config:t.config,namespace:"dre",title:"Liste des DRE"},on:{show:t.show,delete:t.destroy,edit:t.edit}}),t._v(" "),e("NLModal",{attrs:{show:t.rowSelected},on:{close:function(e){t.rowSelected=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("Informations dre")]},proxy:!0},{key:"default",fn:function(){var n,r;return[e("div",{staticClass:"grid list"},[e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Dre\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(n=t.rowSelected)||void 0===n?void 0:n.full_name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Agences\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(r=t.rowSelected)||void 0===r?void 0:r.agencies_str)+"\n            ")])])])]},proxy:!0},{key:"footer",fn:function(){return[t.can(["delete_dre","edit_dre"])?e("div",{staticClass:"d-flex justify-end align-center gap-5 w-100"},[t.can("delete_dre")?e("button",{staticClass:"btn btn-danger has-icon",on:{click:function(e){return e.preventDefault(),t.destroy(t.rowSelected)}}},[e("i",{staticClass:"las la-trash icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Supprimer\n            ")])]):t._e(),t._v(" "),t.can("edit_dre")?e("button",{staticClass:"btn btn-warning has-icon",on:{click:function(e){return e.preventDefault(),t.edit(t.rowSelected)}}},[e("i",{staticClass:"las la-edit icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Modifier\n            ")])]):t._e()]):t._e()]},proxy:!0}],null,!1,3378123160)})],1)],1):t._e()}),[],!1,null,null,null).exports}}]);
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[998],{1998:(e,t,n)=>{n.r(t),n.d(t,{default:()=>l});var i=n(1241),s=n(629);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,i)}return n}function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const a={components:{NLDatatable:i.Z},layout:"backend",middleware:["auth","admin"],metaInfo:function(){return{title:"Permissions"}},computed:function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},(0,s.Se)({permissions:"permissions/paginated",permission:"permissions/current"})),data:function(){return{rowSelected:null,config:{data:null,namespace:"permissions",state_key:"paginated",rowKey:"id",search:!0,columns:[{label:"Name",field:"name",orderable:!0},{label:"Rôles",field:"roles"}],actions:{show:function(e){return user().authorizations.view_permission},edit:function(e){return user().authorizations.edit_permission},delete:function(e){return user().authorizations.delete_permission}}}}},created:function(){this.initData()},methods:{show:function(e){this.rowSelected=e},edit:function(e){this.$router.push({name:"permissions-edit",params:{permission:e.id}})},destroy:function(e){var t=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&api.delete("permissions/"+e.id).then((function(e){e.data.status?(t.rowSelected=null,t.initData(),swal.toast_success(e.data.message)):swal.toast_error(e.data.message)}))})).catch((function(e){swal.alert_error()}))},initData:function(){var e=this;this.$store.dispatch("permissions/fetchPaginated").then((function(){e.config.data=e.permissions.paginated}))}}};const l=(0,n(1900).Z)(a,(function(){var e=this,t=e._self._c;return t("div",{directives:[{name:"can",rawName:"v-can",value:"view_permission",expression:"'view_permission'"}]},[t("ContentHeader",{attrs:{title:"Liste des permissions"},scopedSlots:e._u([{key:"actions",fn:function(){return[t("router-link",{directives:[{name:"can",rawName:"v-can",value:"create_permission",expression:"'create_permission'"}],staticClass:"btn btn-info",attrs:{to:{name:"permissions-create"}}},[e._v("\n        Ajouter\n      ")])]},proxy:!0}])}),e._v(" "),t("ContentBody",[t("NLDatatable",{attrs:{config:e.config},on:{show:e.show,delete:e.destroy,edit:e.edit}}),e._v(" "),t("NLModal",{attrs:{show:e.rowSelected},on:{close:function(t){e.rowSelected=null}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("Informations permission")]},proxy:!0},{key:"default",fn:function(){var n,i;return[t("div",{staticClass:"grid list"},[t("div",{staticClass:"col-12 col-lg-6 list-item"},[t("div",{staticClass:"list-item-label"},[e._v("\n              Permission\n            ")]),e._v(" "),t("div",{staticClass:"list-item-content"},[e._v("\n              "+e._s(null===(n=e.rowSelected)||void 0===n?void 0:n.name)+"\n            ")])]),e._v(" "),t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-label"},[e._v("\n              Rôles\n            ")]),e._v(" "),t("div",{staticClass:"list-item-content"},[e._v("\n              "+e._s(null===(i=e.rowSelected)||void 0===i?void 0:i.roles)+"\n            ")])])])]},proxy:!0},{key:"footer",fn:function(){var n,i,s,r;return[null!==(n=e.rowSelected)&&void 0!==n&&n.authorizations.delete||null!==(i=e.rowSelected)&&void 0!==i&&i.authorizations.edit?t("div",{staticClass:"d-flex justify-end align-center gap-5 w-100"},[null!==(s=e.rowSelected)&&void 0!==s&&s.authorizations.delete?t("button",{staticClass:"btn btn-danger has-icon",on:{click:function(t){return t.preventDefault(),e.destroy(e.rowSelected)}}},[t("i",{staticClass:"las la-trash icon"}),e._v(" "),t("span",{staticClass:"icon-text"},[e._v("\n              Supprimer\n            ")])]):e._e(),e._v(" "),null!==(r=e.rowSelected)&&void 0!==r&&r.authorizations.edit?t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return t.preventDefault(),e.edit(e.rowSelected)}}},[t("i",{staticClass:"las la-edit icon"}),e._v(" "),t("span",{staticClass:"icon-text"},[e._v("\n              Modifier\n            ")])]):e._e()]):e._e()]},proxy:!0}])})],1)],1)}),[],!1,null,null,null).exports}}]);
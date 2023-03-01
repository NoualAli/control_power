"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1170],{1170:(t,e,s)=>{s.r(e),s.d(e,{default:()=>u});var i=s(2097),l=s(2671),n=s(629);const a={props:{avatar:{type:null|String},alt:{type:null|String,default:"Avatar"}}};var r=s(1900);const o=(0,r.Z)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"avatar"},[e("img",{attrs:{src:t.avatar,alt:t.alt}})])}),[],!1,null,null,null).exports;var c=s(7565);const d={components:{NLDatatable:i.Z,NLModal:l.Z,Avatar:o},layout:"backend",middleware:["auth","admin"],metaInfo:function(){return{title:"Utilisateurs"}},data:function(){var t=this;return{rowSelected:null,config:{data:null,columns:[{label:"Nom d'utilisateur",field:"username",orderable:!0},{label:"Nom complet",field:"full_name"},{label:"Adresse email",field:"email",orderable:!0},{label:"DRE",field:"dres"},{label:"Rôles",field:"roles"}],actions:{show:!0,edit:function(e){return!t.isCurrent(e)&&(0,c.EA)().authorizations.edit_user&&!e.roles.includes("root")},delete:function(e){return!t.isCurrent(e)&&(0,c.EA)().authorizations.delete_user&&!e.roles.includes("root")}}}}},computed:(0,n.Se)({users:"users/paginated",user:"users/current"}),methods:{isCurrent:function(t){var e;return(null==t?void 0:t.id)==(null===(e=(0,c.EA)())||void 0===e?void 0:e.id)},show:function(t){var e=this;this.$store.dispatch("users/fetch",t.id).then((function(){return e.rowSelected=e.user.current}))},edit:function(t){this.$router.push({name:"users-edit",params:{user:t.id}})},destroy:function(t){var e=this;swal.confirm_destroy().then((function(s){s.isConfirmed&&api.delete("users/"+t.id).then((function(t){t.data.status?(e.rowSelected=null,e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error()}))},initData:function(){var t=this;this.$store.dispatch("users/fetchPaginated").then((function(){t.config.data=t.users.paginated}))}},mounted:function(){this.initData()}};const u=(0,r.Z)(d,(function(){var t=this,e=t._self._c;return e("div",{directives:[{name:"can",rawName:"v-can",value:"view_user",expression:"'view_user'"}]},[e("ContentHeader",{scopedSlots:t._u([{key:"actions",fn:function(){return[e("router-link",{directives:[{name:"can",rawName:"v-can",value:"create_user",expression:"'create_user'"}],staticClass:"btn btn-info",attrs:{to:{name:"users-create"}}},[t._v("\n        Ajouter\n      ")])]},proxy:!0}])}),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{config:t.config,title:"Liste des utilisateurs",namespace:"users"},on:{show:t.show,delete:t.destroy,edit:t.edit}}),t._v(" "),e("NLModal",{attrs:{show:t.rowSelected},on:{close:function(e){t.rowSelected=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("Informations utilisateur")]},proxy:!0},{key:"default",fn:function(){var s,i,l,n,a,r,o,c;return[e("div",{staticClass:"grid list"},[e("div",{staticClass:"col-12 d-flex justify-center align-center"},[e("Avatar",{attrs:{avatar:null===(s=t.rowSelected)||void 0===s?void 0:s.avatar}})],1),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Nom complet\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(i=t.rowSelected)||void 0===i?void 0:i.full_name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Rôle\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(l=t.rowSelected)||void 0===l?void 0:l.roles_str)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Adresse email\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(n=t.rowSelected)||void 0===n?void 0:n.email)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Nom d'utilisateur\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(a=t.rowSelected)||void 0===a?void 0:a.username)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              N° de téléphone\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null!==(r=t.rowSelected)&&void 0!==r&&r.phone?null===(o=t.rowSelected)||void 0===o?void 0:o.phone:"-")+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              DRE\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(c=t.rowSelected)||void 0===c?void 0:c.dres_str)+"\n            ")])])])]},proxy:!0},{key:"footer",fn:function(){var s,i;return[t.isCurrent(t.rowSelected)?t._e():e("div",{staticClass:"d-flex justify-end align-center gap-5 w-100"},[null!==(s=t.rowSelected)&&void 0!==s&&s.authorizations.delete?e("button",{staticClass:"btn btn-danger has-icon",on:{click:function(e){return e.preventDefault(),t.destroy(t.rowSelected)}}},[e("i",{staticClass:"las la-trash icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Supprimer\n            ")])]):t._e(),t._v(" "),null!==(i=t.rowSelected)&&void 0!==i&&i.authorizations.edit?e("button",{staticClass:"btn btn-warning has-icon",on:{click:function(e){return e.preventDefault(),t.edit(t.rowSelected)}}},[e("i",{staticClass:"las la-edit icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Modifier\n            ")])]):t._e()])]},proxy:!0}])})],1)],1)}),[],!1,null,null,null).exports}}]);
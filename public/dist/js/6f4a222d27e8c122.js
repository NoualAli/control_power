"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1033],{1033:(t,e,n)=>{n.r(e),n.d(e,{default:()=>c});var o=n(2097),i=n(629);function l(t){return l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},l(t)}function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,o)}return n}function r(t,e,n){return(e=function(t){var e=function(t,e){if("object"!==l(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var o=n.call(t,e||"default");if("object"!==l(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===l(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const a={components:{NLDatatable:o.Z},layout:"backend",middleware:["auth","admin"],metaInfo:function(){return{title:"Points de contrôle"}},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){r(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},(0,i.Se)({controlPoints:"controlPoints/paginated",controlPoint:"controlPoints/current"})),data:function(){return{rowSelected:null,config:{data:null,columns:[{label:"Famille",field:"familly_name"},{label:"Domaine",field:"domain_name"},{label:"Processus",field:"process_name"},{label:"Nom",field:"name"}],actions:{show:function(t){return user().authorizations.view_control_point},edit:function(t){return user().authorizations.edit_control_point},delete:function(t){return user().authorizations.delete_control_point}}}}},created:function(){this.initData()},methods:{show:function(t){var e=this;this.$store.dispatch("controlPoints/fetch",t.id).then((function(){e.rowSelected=e.controlPoint.current}))},edit:function(t){this.$router.push({name:"control-points-edit",params:{controlPoint:t.id}})},destroy:function(t){var e=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&api.delete("control-points/"+t.id).then((function(t){t.data.status?(e.rowSelected=null,e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error(t.message)}))},initData:function(){var t=this;this.$store.dispatch("controlPoints/fetchPaginated").then((function(){t.config.data=t.controlPoints.paginated}))}}};const c=(0,n(1900).Z)(a,(function(){var t=this,e=t._self._c;return e("div",{directives:[{name:"can",rawName:"v-can",value:"view_control_point",expression:"'view_control_point'"}]},[e("ContentHeader",{scopedSlots:t._u([{key:"actions",fn:function(){return[e("router-link",{directives:[{name:"can",rawName:"v-can",value:"create_control_point",expression:"'create_control_point'"}],staticClass:"btn btn-info",attrs:{to:{name:"control-points-create"}}},[t._v("\n        Ajouter\n      ")])]},proxy:!0}])}),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{config:t.config,namespace:"controlPoints",title:"Liste des Points de contrôle"},on:{show:t.show,delete:t.destroy,edit:t.edit}}),t._v(" "),e("NLModal",{attrs:{show:t.rowSelected},on:{close:function(e){t.rowSelected=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("Informations point de contrôle")]},proxy:!0},{key:"default",fn:function(){var n,o,i,l,s,r,a,c,d,u,v,_,f;return[e("div",{staticClass:"grid list"},[e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Famille\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(n=t.rowSelected)||void 0===n||null===(o=n.familly)||void 0===o?void 0:o.name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Domaine\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(i=t.rowSelected)||void 0===i||null===(l=i.domain)||void 0===l?void 0:l.name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Processus\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(s=t.rowSelected)||void 0===s||null===(r=s.process)||void 0===r?void 0:r.name)+"\n            ")])]),t._v(" "),e("div",{staticClass:"col-12 col-lg-6 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Point de contrôle\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content"},[t._v("\n              "+t._s(null===(a=t.rowSelected)||void 0===a?void 0:a.name)+"\n            ")])]),t._v(" "),""!==(null===(c=t.rowSelected)||void 0===c?void 0:c.scores)&&null!==(null===(d=t.rowSelected)||void 0===d?void 0:d.scores)?e("div",{staticClass:"col-12 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Notations\n            ")]),t._v(" "),e("div",{staticClass:"tags",domProps:{innerHTML:t._s(null===(u=t.rowSelected)||void 0===u?void 0:u.scores_str)}})]):t._e(),t._v(" "),""!==(null===(v=t.rowSelected)||void 0===v?void 0:v.fields)&&null!==(null===(_=t.rowSelected)||void 0===_?void 0:_.fields)?e("div",{staticClass:"col-12 list-item"},[e("div",{staticClass:"list-item-label"},[t._v("\n              Metadata\n            ")]),t._v(" "),e("div",{staticClass:"list-item-content no-bg"},[e("table",[e("thead",[e("tr",[e("th",[t._v("Type")]),t._v(" "),e("th",[t._v("Label")]),t._v(" "),e("th",[t._v("Nom")]),t._v(" "),e("th",[t._v("Taille")]),t._v(" "),e("th",[t._v("Identifiant")]),t._v(" "),e("th",[t._v("Placeholder")]),t._v(" "),e("th",[t._v("Text d'aide")])])]),t._v(" "),e("tbody",t._l(null===(f=t.rowSelected)||void 0===f?void 0:f.fields,(function(n,o){return e("tr",{key:o},[e("td",[t._v("\n                      "+t._s(n[0].type)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[1].label)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[2].name)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[3].length)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[5].id)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[6].placeholder)+"\n                    ")]),t._v(" "),e("td",[t._v("\n                      "+t._s(n[7].help_text)+"\n                    ")])])})),0)])])]):t._e()])]},proxy:!0},{key:"footer",fn:function(){var n,o,i,l;return[null!==(n=t.rowSelected)&&void 0!==n&&n.authorizations.delete||null!==(o=t.rowSelected)&&void 0!==o&&o.authorizations.edit?e("div",{staticClass:"d-flex justify-end align-center gap-5 w-100"},[null!==(i=t.rowSelected)&&void 0!==i&&i.authorizations.delete?e("button",{staticClass:"btn btn-danger has-icon",on:{click:function(e){return e.preventDefault(),t.destroy(t.rowSelected)}}},[e("i",{staticClass:"las la-trash icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Supprimer\n            ")])]):t._e(),t._v(" "),null!==(l=t.rowSelected)&&void 0!==l&&l.authorizations.edit?e("button",{staticClass:"btn btn-warning has-icon",on:{click:function(e){return e.preventDefault(),t.edit(t.rowSelected)}}},[e("i",{staticClass:"las la-edit icon"}),t._v(" "),e("span",{staticClass:"icon-text"},[t._v("\n              Modifier\n            ")])]):t._e()]):t._e()]},proxy:!0}])})],1)],1)}),[],!1,null,null,null).exports}}]);
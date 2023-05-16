"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6025],{6025:(t,n,a)=>{a.r(n),a.d(n,{default:()=>d});var i=a(330),e=a(629),o=a(2661);function s(t){return s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},s(t)}function l(t,n){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);n&&(i=i.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),a.push.apply(a,i)}return a}function r(t,n,a){return(n=function(t){var n=function(t,n){if("object"!==s(t)||null===t)return t;var a=t[Symbol.toPrimitive];if(void 0!==a){var i=a.call(t,n||"default");if("object"!==s(i))return i;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===n?String:Number)(t)}(t,"string");return"symbol"===s(n)?n:String(n)}(n))in t?Object.defineProperty(t,n,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[n]=a,t}const c={layout:"backend",middleware:["auth"],components:{NLDatatable:i.Z},breadcrumb:function(){var t,n;return{label:"Détails campagne "+(null===(t=this.campaign)||void 0===t||null===(n=t.current)||void 0===n?void 0:n.reference)}},data:function(){return{rowSelected:null,config:{data:null,columns:[{label:"Famille",field:"familly_name"},{label:"Domaine",field:"domain_name"},{label:"Processus",field:"name"},{label:"Total points de contrôle",field:"control_points_count"}],actions:{show:!0}}}},computed:function(t){for(var n=1;n<arguments.length;n++){var a=null!=arguments[n]?arguments[n]:{};n%2?l(Object(a),!0).forEach((function(n){r(t,n,a[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):l(Object(a)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(a,n))}))}return t}({},(0,e.Se)({processes:"campaigns/processes",process:"processes/controlPoints",campaign:"campaigns/current"})),created:function(){this.initData()},methods:{initData:function(){var t=this;this.close();var n=this.$route.params.campaignId;this.$store.dispatch("campaigns/fetch",{campaignId:n}),this.$store.dispatch("campaigns/fetchProcesses",n).then((function(){return t.config.data=t.processes.processes}))},loadControlPoints:function(t){var n=this;this.$store.dispatch("processes/fetch",{id:t.id,onlyControlPoints:!0}).then((function(){return n.control_points=n.process.controlPoints}))},validate:function(t){var n=this;swal.confirm({title:"Validation",message:"Validation de la campagne de contrôle "+t.reference,icon:"success"}).then((function(a){a.isConfirmed&&o.Z.put("campaigns/"+t.id+"/validate").then((function(t){t.data.status?(n.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error(t)}))},destroy:function(){var t=this;swal.confirm_destroy().then((function(n){var a,i;n.isConfirmed&&o.Z.delete("campaigns/"+(null===(a=t.campaign)||void 0===a||null===(i=a.current)||void 0===i?void 0:i.id)).then((function(n){n.data.status?(swal.toast_success(n.data.message),t.$router.push({name:"campaigns"})):swal.alert_error(n.data.message)})).catch((function(t){console.log(t)}))}))},detachProcess:function(t){var n=this;swal.confirm_destroy().then((function(a){var i,e;a.isConfirmed&&o.Z.delete("campaigns/"+(null===(i=n.campaign)||void 0===i||null===(e=i.current)||void 0===e?void 0:e.id)+"/process/"+t.id).then((function(t){t.data.status?(n.initData(),swal.toast_success(t.data.message)):swal.alert_error(t.data.message)})).catch((function(t){console.log(t)}))}))},show:function(t){this.rowSelected=t,this.loadControlPoints(t)},close:function(){this.rowSelected=null}}};const d=(0,a(1900).Z)(c,(function(){var t,n,a,i,e,o,s,l,r,c,d,u,v,p,m,_,f,g,b,y,h,C,w,P,k,S,x,O,j,D,E,L,N=this,Z=N._self._c;return N.can("view_control_campaign")?Z("ContentBody",[Z("div",{staticClass:"d-flex justify-end align-center gap-3 my-2"},[N.can("view_mission")?Z("router-link",{staticClass:"btn",attrs:{to:{name:"campaign-missions",params:{campaignId:null===(t=N.campaign)||void 0===t||null===(n=t.current)||void 0===n?void 0:n.id}}}},[N._v("\n      Missions\n    ")]):N._e(),N._v(" "),(null===(a=N.campaign)||void 0===a||null===(i=a.current)||void 0===i?void 0:i.remaining_days_before_start)>5&&N.can("edit_control_campaign")&&(null===(e=N.campaign)||void 0===e||!e.current.validated_by_id)&&N.is("dcp")?Z("router-link",{staticClass:"btn btn-warning",attrs:{to:{name:"campaigns-edit",params:{campaignId:null===(o=N.campaign)||void 0===o||null===(s=o.current)||void 0===s?void 0:s.id}}}},[Z("i",{staticClass:"las la-edit icon"})]):N._e(),N._v(" "),(null===(l=N.campaign)||void 0===l||null===(r=l.current)||void 0===r?void 0:r.remaining_days_before_start)>5&&N.can("delete_control_campaign")&&(null===(c=N.campaign)||void 0===c||!c.current.validated_by_id)&&N.is("dcp")?Z("button",{staticClass:"btn btn-danger",on:{click:function(t){return t.stopPropagation(),N.destroy.apply(null,arguments)}}},[Z("i",{staticClass:"las la-trash icon"})]):N._e(),N._v(" "),null!==(d=N.campaign)&&void 0!==d&&null!==(u=d.current)&&void 0!==u&&u.validated_by_id||!N.can("validate_control_campaign")?N._e():Z("button",{staticClass:"btn btn-info has-icon",on:{click:function(t){var n;return t.stopPropagation(),N.validate(null===(n=N.campaign)||void 0===n?void 0:n.current)}}},[Z("i",{staticClass:"las la-check icon"})])],1),N._v(" "),Z("div",{staticClass:"box mb-10 border-primary-dark border-1"},[Z("div",{staticClass:"grid gap-12"},[Z("div",{staticClass:"col-12 col-lg-4"},[Z("span",{staticClass:"text-bold"},[N._v("\n          Référence:\n        ")]),N._v(" "),Z("span",{staticClass:"text-bold"},[N._v("\n          "+N._s(null===(v=N.campaign)||void 0===v||null===(p=v.current)||void 0===p?void 0:p.reference)+"\n        ")])]),N._v(" "),Z("div",{directives:[{name:"has-role",rawName:"v-has-role",value:"cdcr,dcp",expression:"'cdcr,dcp'"}],staticClass:"col-12 col-lg-4"},[Z("span",{staticClass:"text-bold"},[N._v("\n          Etat:\n        ")]),N._v(" "),Z("span",[N._v("\n          "+N._s(null!==(m=N.campaign)&&void 0!==m&&null!==(_=m.current)&&void 0!==_&&_.validated_by_id?"Validé":"En attente de validation")+"\n        ")])]),N._v(" "),Z("div",{staticClass:"col-12 col-lg-4"},[Z("div",{staticClass:"grid"},[Z("div",{staticClass:"col-12 grid"},[Z("div",{staticClass:"col-12 col-lg-6"},[Z("span",{staticClass:"text-bold"},[N._v("\n                Début:\n              ")]),N._v(" "),Z("span",[N._v("\n                "+N._s((null===(f=N.campaign)||void 0===f||null===(g=f.current)||void 0===g?void 0:g.start)+" / "+(null===(b=N.campaign)||void 0===b||null===(y=b.current)||void 0===y?void 0:y.remaining_days_before_start_str))+"\n              ")])]),N._v(" "),Z("div",{staticClass:"col-12 col-lg-6"},[Z("span",{staticClass:"text-bold"},[N._v("\n                Fin:\n              ")]),N._v(" "),Z("span",[N._v("\n                "+N._s((null===(h=N.campaign)||void 0===h||null===(C=h.current)||void 0===C?void 0:C.end)+" / "+(null===(w=N.campaign)||void 0===w||null===(P=w.current)||void 0===P?void 0:P.remaining_days_before_end_str))+"\n              ")])])])])]),N._v(" "),Z("div",{staticClass:"col-12"},[Z("span",{staticClass:"text-bold"},[N._v("\n          Description:\n        ")]),N._v(" "),Z("br"),N._v(" "),"-"!==(null===(k=N.campaign)||void 0===k||null===(S=k.current)||void 0===S?void 0:S.description)?Z("div",{staticClass:"mt-2",domProps:{innerHTML:N._s(null===(x=N.campaign)||void 0===x||null===(O=x.current)||void 0===O?void 0:O.description)}}):Z("span")])])]),N._v(" "),Z("NLDatatable",{attrs:{namespace:"campaigns",stateKey:"processes",config:N.config,title:"Liste des processus de la campagne de contrôle"},on:{show:N.show,delete:N.destroy},scopedSlots:N._u([{key:"actions",fn:function(t){var n,a,i,e,o;return[(null===(n=N.campaign)||void 0===n||null===(a=n.current)||void 0===a?void 0:a.remaining_days_before_start)>5&&N.can("edit_control_campaign")&&(null===(i=N.campaign)||void 0===i||!i.current.validated_by_id)&&(null===(e=N.config.data)||void 0===e||null===(o=e.meta)||void 0===o?void 0:o.total)>1&&N.is("dcp")?Z("button",{staticClass:"btn btn-danger has-icon",on:{click:function(n){return n.stopPropagation(),N.detachProcess(t.item)}}},[Z("i",{staticClass:"las la-unlink icon"})]):N._e()]}}],null,!1,2324669536)}),N._v(" "),Z("NLModal",{attrs:{show:N.rowSelected},on:{close:N.close},scopedSlots:N._u([{key:"title",fn:function(){var t,n,a;return[Z("small",{staticClass:"tag is-info text-small"},[N._v("\n        "+N._s(null===(t=N.rowSelected)||void 0===t?void 0:t.familly_name)+"\n      ")]),N._v(" "),Z("small",{staticClass:"tag is-primary-dark text-small mx-1"},[N._v("\n        "+N._s(null===(n=N.rowSelected)||void 0===n?void 0:n.domain_name)+"\n      ")]),N._v(" "),Z("small",{staticClass:"tag is-warning text-small"},[N._v("\n        "+N._s(null===(a=N.rowSelected)||void 0===a?void 0:a.name)+"\n      ")])]},proxy:!0},{key:"default",fn:function(){var t;return[Z("p",{staticClass:"text-bold mb-6"},[N._v("\n        Points de contrôle\n      ")]),N._v(" "),Z("div",{staticClass:"grid list"},N._l(null===(t=N.process)||void 0===t?void 0:t.controlPoints,(function(t){return Z("div",{key:t.id,staticClass:"col-12 list-item"},[Z("div",{staticClass:"list-item-content"},[N._v("\n            "+N._s(t.label)+"\n          ")])])})),0)]},proxy:!0},(null===(j=N.campaign)||void 0===j||null===(D=j.current)||void 0===D?void 0:D.remaining_days_before_start)>5&&N.can("edit_control_campaign")&&(null===(E=N.config.data)||void 0===E||null===(L=E.meta)||void 0===L?void 0:L.total)>1&&N.is("dcp")?{key:"footer",fn:function(){return[Z("button",{staticClass:"btn btn-danger has-icon",on:{click:function(t){var n,a,i;t.stopPropagation(),N.destroy(N.rowSelected,null===(n=N.campaign)||void 0===n?void 0:n.current)&&(null===(a=N.config.data)||void 0===a||null===(i=a.meta)||void 0===i||i.total)}}},[Z("i",{staticClass:"las la-unlink icon"}),N._v("\n        Détacher\n      ")])]},proxy:!0}:null],null,!0)})],1):N._e()}),[],!1,null,null,null).exports}}]);
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[8278],{8278:(t,e,n)=>{n.r(e),n.d(e,{default:()=>f});var a=n(2904),i=n(8056),r=n(629),l=n(7565),o=n(2661);function s(t){return s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},s(t)}function c(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function d(t,e,n){return(e=function(t){var e=function(t,e){if("object"!==s(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!==s(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===s(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const u={components:{ContentBody:a.Z,NLDatatable:i.Z},layout:"backend",middleware:["auth"],metaInfo:function(){return{title:"Suivi du planning annuel"}},data:function(){var t=this;return{rowSelected:null,config:{data:null,columns:[{label:"Référence",field:"reference",orderable:!0},{label:"Date début",field:"start",orderable:!0},{label:"Date fin",field:"end",orderable:!0},{label:"Début",field:"remaining_days_before_start_str"},{label:"Fin",field:"remaining_days_before_end_str"},{label:"Etat",field:"validated_by_id",hide:!(0,l.nu)(["dcp","cdcr"]),methods:{showField:function(t){return t.validated_by_id?"Validé":"En attente de validation"}}}],actions:{show:!0,edit:function(e){return t.can("edit_control_campaign")&&e.remaining_days_before_start>5&&!e.validated_by_id&&t.is("dcp")},delete:function(e){return t.can("delete_control_campaign")&&e.remaining_days_before_start>5&&!e.validated_by_id&&t.is("dcp")}}},filters:{reference:{label:"Année",data:null,value:null},validated:{label:"Etat",hide:!(0,l.nu)(["dcp","cdcr"]),data:[{id:0,label:"En attente de validation"},{id:1,label:"Validé"}],value:null},between:{value:[],type:"date-range",cols:"col-lg-4",attributes:{start:{cols:"col-lg-6",label:"De",value:null},end:{cols:"col-lg-6",label:"À",value:null}}}}}},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?c(Object(n),!0).forEach((function(e){d(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},(0,r.Se)({controlCampaigns:"campaigns/paginated"})),methods:{resetData:function(){this.initFilters(!1),this.initData()},initYearsList:function(){for(var t=2023,e=(new Date).getFullYear(),n=[];t<=e;t++)n.push({id:t,label:t});this.filters.reference.data=n},show:function(t){this.$router.push({name:"campaign",params:{campaignId:t.id}})},edit:function(t){this.$router.push({name:"campaigns-edit",params:{campaignId:t.id}})},validate:function(t){var e=this;swal.confirm({title:"Validation",message:"Validation de la campagne de contrôle "+t.reference,icon:"success"}).then((function(n){n.isConfirmed&&o.Z.put("campaigns/"+t.id+"/validate").then((function(t){t.data.status?(e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error(t)}))},destroy:function(t){var e=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&o.Z.delete("campaigns/"+t.id).then((function(t){t.data.status?(e.initData(),swal.toast_success(t.data.message)):swal.toast_error(t.data.message)}))})).catch((function(t){swal.alert_error(t)}))},initData:function(){var t=this;this.$store.dispatch("campaigns/fetchPaginated").then((function(){t.config.data=t.controlCampaigns.paginated}))},initFilters:function(){(!(arguments.length>0&&void 0!==arguments[0])||arguments[0])&&this.initYearsList()}},created:function(){this.initFilters(),this.initData()}};const f=(0,n(1900).Z)(u,(function(){var t=this,e=t._self._c;return t.can("view_control_campaign")?e("div",[e("div",{staticClass:"d-flex justify-between align-center"},[e("div",{staticClass:"w-100 d-flex justify-end align-center"},[t.can("create_control_campaign")?e("router-link",{staticClass:"btn btn-info",attrs:{to:{name:"campaigns-create"}}},[t._v("\n        Ajouter\n      ")]):t._e()],1)]),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{namespace:"campaigns",config:t.config,filters:t.filters},on:{delete:t.destroy,show:t.show,edit:t.edit,filterReset:function(e){return t.resetData()}},scopedSlots:t._u([{key:"actions",fn:function(n){var a;return[null!=n&&null!==(a=n.item)&&void 0!==a&&a.validated_by_id||!t.can("validate_control_campaign")?t._e():e("button",{staticClass:"btn btn-info has-icon",on:{click:function(e){return e.stopPropagation(),t.validate(n.item)}}},[e("i",{staticClass:"las la-check icon"})])]}}],null,!1,1629492681)})],1)],1):t._e()}),[],!1,null,null,null).exports}}]);
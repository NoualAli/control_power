"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[281],{5714:(e,t,a)=>{a.d(t,{ZP:()=>C,l0:()=>y});var i=a(9669),s=a.n(i),r=Object.defineProperty,o=Object.prototype.hasOwnProperty,n=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,a)=>t in e?r(e,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):e[t]=a,d=(e,t)=>{for(var a in t||(t={}))o.call(t,a)&&c(e,a,t[a]);if(n)for(var a of n(t))l.call(t,a)&&c(e,a,t[a]);return e};const u=e=>void 0===e,m=e=>Array.isArray(e),f=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,v=(e,t,a,i)=>((t=t||{}).indices=!u(t.indices)&&t.indices,t.nullsAsUndefineds=!u(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!u(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!u(t.allowEmptyArrays)&&t.allowEmptyArrays,a=a||new FormData,u(e)||(null===e?t.nullsAsUndefineds||a.append(i,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?a.append(i,e?1:0):a.append(i,e):m(e)?e.length?e.forEach(((e,s)=>{const r=i+"["+(t.indices?s:"")+"]";v(e,t,a,r)})):t.allowEmptyArrays&&a.append(i+"[]",""):(e=>e instanceof Date)(e)?a.append(i,e.toISOString()):!(e=>e===Object(e))(e)||(e=>f(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||f(e)?a.append(i,e):Object.keys(e).forEach((s=>{const r=e[s];if(m(r))for(;s.length>2&&s.lastIndexOf("[]")===s.length-2;)s=s.substring(0,s.length-2);v(r,t,a,i?i+"["+s+"]":s)}))),a);var g={serialize:v};function p(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((a=>{t[a]=p(e[a])})),t}function _(e){return Array.isArray(e)?e:[e]}function h(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>h(e)))}class b{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(d(d({},this.errors),{[e]:_(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return _(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const a=this.get(e);a&&t.push(a)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((a=>{a!==e&&(t[a]=this.errors[a])})),this.set(t)}}class y{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new b,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,p(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>d(d({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!y.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),y.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!y.ignore.includes(e))).forEach((e=>{this[e]=p(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,a={}){return this.startProcessing(),a=d({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},a),"get"===e.toLowerCase()?a.params=d(d({},this.data()),a.params):(a.data=d(d({},this.data()),a.data),h(a.data)&&!a.transformRequest&&(a.transformRequest=[e=>g.serialize(e)])),new Promise(((e,t)=>{(y.axios||s()).request(a).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?d({},e.data.errors):e.data.message?{error:e.data.message}:d({},e.data):{error:y.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let a=e;return Object.prototype.hasOwnProperty.call(y.routes,e)&&(a=decodeURI(y.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{a=a.replace(`{${e}}`,t[e])})),a}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}y.routes={},y.errorMessage="Something went wrong. Please try again.",y.recentlySuccessfulTimeout=2e3,y.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const C=y},281:(e,t,a)=>{a.r(t),a.d(t,{default:()=>f});var i=a(6828),s=a(2904),r=a(629),o=a(5714),n=a(8181),l=a(7565);function c(e){return c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},c(e)}function d(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,i)}return a}function u(e,t,a){return(t=function(e){var t=function(e,t){if("object"!==c(e)||null===e)return e;var a=e[Symbol.toPrimitive];if(void 0!==a){var i=a.call(e,t||"default");if("object"!==c(i))return i;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(e,"string");return"symbol"===c(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const m={layout:"backend",middleware:["auth"],components:{ContentHeader:i.Z,ContentBody:s.Z,Notification:n.Z},metaInfo:function(){var e,t;return{title:(null===(e=this.mission)||void 0===e?void 0:e.reference)+" - "+(null===(t=this.process)||void 0===t?void 0:t.name)}},data:function(){return{rowSelected:null,currentMetadata:{},process:null,mission:null,details:[],modals:{show:!1,edit:!1},regularizationTypes:[{id:"Cause",label:"Cause"},{id:"Action à engagé",label:"Action à engagé"}],regularization_mode:!1,forms:{regularization:new o.ZP({regularization_id:null,detail_id:null,regularized:!1,reason:null,committed_action:null,action_to_be_taken:null,type:null}),generic:new o.ZP({process_mode:!1,mission:null,process:null,media:[],detail:null,report:null,recovery_plan:null,score:null,major_fact:!1,metadata:[]})}}},computed:function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?d(Object(a),!0).forEach((function(t){u(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):d(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({formErrorsCount:function(){return Object.entries(this.forms.generic.errors.all()).length}},(0,r.Se)({config:"details/config"})),breadcrumb:function(){var e;return{label:null===(e=this.process)||void 0===e?void 0:e.name}},created:function(){this.initData()},methods:{show:function(e){this.rowSelected=e,this.modals.show=!0,this.currentMetadata.keys=Object.keys(e.parsed_metadata)},edit:function(e){this.rowSelected=e,this.modals.edit=!0,this.currentMetadata.keys=Object.keys(e.parsed_metadata),this.initForm()},close:function(e){this.rowSelected=null,this.modals.hasOwnProperty(e)&&(this.modals[e]=!1),this.forms.generic.reset(),this.currentMetadata={}},initData:function(){var e=this;this.$store.dispatch("details/fetchConfig",{missionId:this.$route.params.missionId,processId:this.$route.params.processId}).then((function(){e.details=e.config.config.details,e.mission=e.config.config.mission,e.process=e.config.config.process,e.modals.show=!1,e.modals.edit=!1}))},initForm:function(){this.regularization_mode=(0,l.nu)("da"),this.regularization_mode?this.initRegularizationForm():this.initGenericForm()},initGenericForm:function(){var e,t=this;this.$store.dispatch("details/fetchConfig",{missionId:this.$route.params.missionId,processId:this.$route.params.processId,detailId:null===(e=this.rowSelected)||void 0===e?void 0:e.id}).then((function(){var e=t.config.config;t.rowSelected=e.detail,t.forms.generic.process_mode=e.mission.dre_report_is_validated,t.forms.generic.mission=t.$route.params.missionId,t.forms.generic.process=t.$route.params.processId,t.forms.generic.detail=e.detail.id,t.forms.generic.media=e.detail.media.length?e.detail.media.map((function(e){return e.id})):[],t.forms.generic.detail=e.detail.id,t.forms.generic.report=e.detail.report,t.forms.generic.recovery_plan=e.detail.recovery_plan,t.forms.generic.score=e.detail.score,t.forms.generic.metadata=e.detail.metadata||[],t.forms.generic.major_fact=!!e.detail.major_fact,t.forms.generic.process_mode=t.is(["dcp","cdcr","cc"])}))},initRegularizationForm:function(){var e,t=this;this.$store.dispatch("details/fetchConfig",{missionId:this.$route.params.missionId,processId:this.$route.params.processId,detailId:null===(e=this.rowSelected)||void 0===e?void 0:e.id}).then((function(){var e,a,i,s,r,o,n,l=t.config.config;t.rowSelected=l.detail,t.forms.regularization.detail_id=t.rowSelected.id,t.forms.regularization.id=null===(e=l.detail.regularization)||void 0===e?void 0:e.id,t.forms.regularization.regularized=!(null===(a=l.detail.regularization)||void 0===a||!a.regularized_at),t.forms.regularization.reason=null===(i=l.detail.regularization)||void 0===i?void 0:i.reason,t.forms.regularization.committed_action=null===(s=l.detail.regularization)||void 0===s?void 0:s.committed_action,t.forms.regularization.action_to_be_taken=null===(r=l.detail.regularization)||void 0===r?void 0:r.action_to_be_taken,null!==(o=l.detail.regularization)&&void 0!==o&&o.reason?t.forms.regularization.type="Cause":null!==(n=l.detail.regularization)&&void 0!==n&&n.action_to_be_taken&&(t.forms.regularization.type="Action à engagé")}))},setupFields:function(e){return null==e?void 0:e.map((function(e){return{type:e.hasOwnProperty(0)?e[0].type:"",label:e.hasOwnProperty(1)?e[1].label:"",name:e.hasOwnProperty(2)?e[2].name:"",length:e.hasOwnProperty(3)?e[3].length:null,style:e.hasOwnProperty(4)?e[4].style:"",id:e.hasOwnProperty(5)?e[5].id:"",placeholder:e.hasOwnProperty(6)?e[6].placeholder:"",help_text:e.hasOwnProperty(7)?e[7].help_text:"",rules:e.hasOwnProperty(8)?e[8].rules:[]}}))},setupScores:function(e){return"object"==c(e)?null==e?void 0:e.map((function(e){return{id:e[0].score,label:e[1].label}})):[]},save:function(){var e=this;swal.confirm_update().then((function(t){t.isConfirmed&&e.forms.generic.post("/api/missions/details/"+e.mission.id).then((function(t){t.data.status?(swal.toast_success(t.data.message),e.initData()):swal.alert_error(t.data.message)})).catch((function(e){var t=e.message;422==e.response.status&&(t="Les données fournies sont invalides."),swal.toast_error(t)}))}))},regularize:function(){var e=this;this.forms.regularization.post("/api/regularize/"+this.forms.regularization.detail_id).then((function(t){t.data.status?(swal.toast_success(t.data.message),e.forms.regularization.reset(),e.initData(),e.close("edit"),e.close("show")):swal.alert_error(t.data.message)})).catch((function(e){var t=e.message;422==e.response.status&&(t="Les données fournies sont invalides."),swal.toast_error(t)}))},addRow:function(e){e=this.setupFields(e);for(var t=[],a=0;a<e.length;a++){var i,s=e[a],r=s.name,o=void 0!==s.default&&s.default;o=s.multiple?[]:"",t.push((u(i={},r,o),u(i,"label",s.label),u(i,"rules",s.rules),i))}this.forms.generic.metadata&&this.forms.generic.metadata.push(t)},removeRow:function(e,t){this.forms.generic.metadata.splice(t,1)},isInput:function(e){return["text","date","datetime","time","week","number","tel","email","month","url"].includes(e)},notify:function(e){var t=this;swal.confirm_update("Voulez-vous notifier les autorités concernées?").then((function(a){a.isConfirmed&&api.post("notifications/major-fact/"+(null==e?void 0:e.id)).then((function(e){swal.toast_success(e.data.message),t.initData(),t.close("edit"),t.close("show")})).catch((function(e){swal.alert_error(e)}))}))}}};const f=(0,a(1900).Z)(m,(function(){var e=this,t=e._self._c;return e.can("view_mission_detail")?t("div",[t("ContentHeader",{scopedSlots:e._u([{key:"title",fn:function(){var a,i,s,r,o;return[t("div",{staticClass:"tags w-90"},[t("span",{staticClass:"tag is-info"},[e._v(e._s(null===(a=e.process)||void 0===a||null===(i=a.familly)||void 0===i?void 0:i.name))]),e._v(" "),t("span",{staticClass:"tag"},[e._v(e._s(null===(s=e.process)||void 0===s||null===(r=s.domain)||void 0===r?void 0:r.name))]),e._v(" "),t("span",{staticClass:"tag is-warning"},[e._v(e._s(null===(o=e.process)||void 0===o?void 0:o.name))])])]},proxy:!0}],null,!1,893816708)}),e._v(" "),t("ContentBody",[t("div",{staticClass:"grid"},e._l(e.details,(function(a){var i,s,r,o,n,l,c,d,u;return t("div",{key:null==a?void 0:a.id,staticClass:"col-12"},[t("div",{staticClass:"box"},[t("div",{staticClass:"grid gap-4"},[t("div",{staticClass:"col-12"},[t("h3",[e._v(e._s(null==a||null===(i=a.control_point)||void 0===i?void 0:i.name))])]),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Fait majeur:")])]),e._v(" "),t("div",{staticClass:"col-8"},[null!=a&&a.major_fact?t("span",[t("i",{staticClass:"las la-times-circle icon text-danger"}),e._v("\n                Oui\n              ")]):t("span",[t("i",{staticClass:"las la-check-circle icon text-success"}),e._v("\n                Non\n              ")])]),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Appréciation:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s(null==a?void 0:a.appreciation))]),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Constat:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s((null==a?void 0:a.report)||"-"))]),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Plan de redressement:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s((null==a?void 0:a.recovery_plan)||"-"))]),e._v(" "),(null==a?void 0:a.score)>1&&null!=a&&null!==(s=a.regularization)&&void 0!==s&&s.regularized?t("div",{staticClass:"col-12"},[t("div",{staticClass:"grid gap-4"},[t("div",{staticClass:"col-4"},[t("b",[e._v("Régularisation:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s((null==a||null===(r=a.regularization)||void 0===r?void 0:r.regularized)||"-"))])])]):e._e(),e._v(" "),t("div",{staticClass:"col-12 d-flex justify-end align-center"},[t("div",{staticClass:"d-flex gap-2 align-center"},[t("button",{staticClass:"btn btn-info has-icon",on:{click:function(t){return e.show(a)}}},[t("i",{staticClass:"las la-eye icon"}),e._v("\n                  Voir plus\n                ")]),e._v(" "),null!==(o=e.mission)&&void 0!==o&&o.controller_opinion_is_validated||null!=a&&a.major_fact||!e.can("create_opinion")?e._e():t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return e.edit(a)}}},[t("i",{staticClass:"las la-pen icon"}),e._v("\n                  Modifier\n                ")]),e._v(" "),null!==(n=e.mission)&&void 0!==n&&n.dre_report_is_validated||null!=a&&a.major_fact||!e.can("create_dre_report,validate_dre_report")?e._e():t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return e.edit(a)}}},[t("i",{staticClass:"las la-pen icon"}),e._v("\n                  Modifier\n                ")]),e._v(" "),null!==(l=e.mission)&&void 0!==l&&l.cdcr_validation_at||null!=a&&a.major_fact_dispatched_at||!e.can("make_first_validation,process_mission")||![2,3,4].includes(null==a?void 0:a.score)?e._e():t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return e.edit(a)}}},[t("i",{staticClass:"las la-pen icon"}),e._v("\n                  Traiter\n                ")]),e._v(" "),null!==(c=e.mission)&&void 0!==c&&c.dcp_validation_at||!e.mission.cdcr_validation_at||null!=a&&a.major_fact_dispatched_at||!e.can("make_second_validation")||![2,3,4].includes(null==a?void 0:a.score)?e._e():t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return e.edit(a)}}},[t("i",{staticClass:"las la-pen icon"}),e._v("\n                  Traiter\n                ")]),e._v(" "),null!=a&&a.major_fact_dispatched_at||null==a||!a.major_fact||!e.can("dispatch_major_fact")?e._e():t("button",{staticClass:"btn btn-info has-icon",on:{click:function(t){return t.preventDefault(),e.notify(a)}}},[t("i",{staticClass:"las la-bell icon"}),e._v("\n                  Notifier\n                ")]),e._v(" "),null===(d=e.mission)||void 0===d||!d.dcp_validation_at||null!=a&&null!==(u=a.regularization)&&void 0!==u&&u.regularized_at||null!=a&&a.major_fact||1===(null==a?void 0:a.score)||!e.can("regularize_mission_detail")?e._e():t("button",{staticClass:"btn btn-warning has-icon",on:{click:function(t){return e.edit(a)}}},[t("i",{staticClass:"las la-pen icon"}),e._v("\n                  Régulariser\n                ")])])])])])])})),0),e._v(" "),t("NLModal",{attrs:{show:e.modals.show},on:{close:function(t){return e.close("show")}},scopedSlots:e._u([{key:"title",fn:function(){var a;return[t("small",[e._v("\n          "+e._s(null===(a=e.rowSelected)||void 0===a?void 0:a.control_point.name)+"\n        ")])]},proxy:!0},{key:"default",fn:function(){var a,i,s,r,o,n,l,c,d,u,m,f,v,g,p,_,h,b,y,C,w,z,S,k,j,x,O,P,I,A,N,R,$,L,E,D,T,q;return[t("div",{staticClass:"grid list"},[t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-4"},[t("b",[e._v("Fait majeur:")])]),e._v(" "),t("div",{staticClass:"col-8"},[null!==(a=e.rowSelected)&&void 0!==a&&a.major_fact?t("span",[t("i",{staticClass:"las la-times-circle icon text-danger"}),e._v("\n                  Oui\n                ")]):t("span",[t("i",{staticClass:"las la-check-circle icon text-success"}),e._v("\n                  Non\n                ")])])])]),e._v(" "),t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-4"},[t("b",[e._v("Appréciation:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s(null===(i=e.rowSelected)||void 0===i?void 0:i.appreciation))])])]),e._v(" "),t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-4"},[t("b",[e._v("Constat:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s((null===(s=e.rowSelected)||void 0===s?void 0:s.report)||"-"))])])]),e._v(" "),t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-4"},[t("b",[e._v("Plan de redressement:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s((null===(r=e.rowSelected)||void 0===r?void 0:r.recovery_plan)||"-"))])])]),e._v(" "),null!==(o=e.rowSelected)&&void 0!==o&&null!==(n=o.metadata)&&void 0!==n&&n.length?t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-12",class:{"col-lg-4":!(null!==(l=e.rowSelected)&&void 0!==l&&l.metadata)}},[t("b",[e._v("Informations supplémentaires:")])]),e._v(" "),t("div",{staticClass:"col-12",class:{"col-lg-8":!(null!==(c=e.rowSelected)&&void 0!==c&&c.metadata)}},[null!==(d=e.rowSelected)&&void 0!==d&&d.metadata?t("table",[t("thead",[t("tr",e._l(e.currentMetadata.keys,(function(a){return t("th",{staticClass:"text-left"},[e._v("\n                        "+e._s(a)+"\n                      ")])})),0)]),e._v(" "),t("tbody",e._l(null===(u=e.rowSelected)||void 0===u?void 0:u.metadata,(function(a,i){return t("tr",{key:"metadata-row-"+i},e._l(a,(function(a,i){return t("td",{key:"metadata-item-"+i,staticClass:"text-left"},e._l(a,(function(a,s){return"label"!==s&&"rules"!==s?t("span",{key:"metadata-item-"+i+"-content"},[e._v("\n                          "+e._s(a||"-")+"\n                        ")]):e._e()})),0)})),0)})),0)]):t("span",[e._v("-")])])])]):e._e(),e._v(" "),null!==(m=e.rowSelected)&&void 0!==m&&null!==(f=m.media)&&void 0!==f&&f.length?t("div",{staticClass:"col-12 list-item"},e._l(null===(v=e.rowSelected)||void 0===v?void 0:v.media,(function(a){var i;return t("div",{staticClass:"list-item-content",on:{click:function(e){e.stopPropagation()}}},[t("div",{staticClass:"files-list list is-visible grid gap-4 text-medium"},[t("div",{staticClass:"col-11 d-flex justify-between align-center"},[t("a",{staticClass:"text-dark text-small",attrs:{href:a.link,target:"_blank"}},[e._v("\n                    "+e._s(a.original_name)+"\n                  ")]),e._v(" "),t("span",{staticClass:"text-small"},[e._v(e._s(a.size))])]),e._v(" "),t("div",{staticClass:"col-1 d-flex justify-end align-center gap-4"},[t("a",{attrs:{href:a.link,download:a.original_name}},[t("i",{staticClass:"las la-download text-info icon"})]),e._v(" "),null!==(i=e.mission)&&void 0!==i&&i.dre_report_is_validated?e._e():t("i",{staticClass:"las la-trash text-danger icon is-clickable",on:{click:function(t){return t.stopPropagation(),e.deleteItem(a,e.index)}}})])])])})),0):e._e(),e._v(" "),(null===(g=e.rowSelected)||void 0===g?void 0:g.score)>1&&null!==(p=e.rowSelected)&&void 0!==p&&null!==(_=p.regularization)&&void 0!==_&&_.regularized?t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-12"},[t("h2",[e._v("Régularisation")])]),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Etat:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s(null===(h=e.rowSelected)||void 0===h||null===(b=h.regularization)||void 0===b?void 0:b.regularized))]),e._v(" "),null!==(y=e.rowSelected)&&void 0!==y&&null!==(C=y.regularization)&&void 0!==C&&C.reason?t("div",{staticClass:"col-4"},[t("b",[e._v("Cause:")])]):e._e(),e._v(" "),null!==(w=e.rowSelected)&&void 0!==w&&null!==(z=w.regularization)&&void 0!==z&&z.reason?t("div",{staticClass:"col-8"},[e._v("\n                "+e._s(null===(S=e.rowSelected)||void 0===S||null===(k=S.regularization)||void 0===k?void 0:k.reason)+"\n              ")]):e._e(),e._v(" "),null!==(j=e.rowSelected)&&void 0!==j&&null!==(x=j.regularization)&&void 0!==x&&x.action_to_be_taken?t("div",{staticClass:"col-4"},[t("b",[e._v("Actions à engagé:")])]):e._e(),e._v(" "),null!==(O=e.rowSelected)&&void 0!==O&&null!==(P=O.regularization)&&void 0!==P&&P.action_to_be_taken?t("div",{staticClass:"col-8"},[e._v("\n                "+e._s(null===(I=e.rowSelected)||void 0===I||null===(A=I.regularization)||void 0===A?void 0:A.action_to_be_taken)+"\n              ")]):e._e(),e._v(" "),null!==(N=e.rowSelected)&&void 0!==N&&null!==(R=N.regularization)&&void 0!==R&&R.committed_action?t("div",{staticClass:"col-4"},[t("b",[e._v("Actions engagé:")])]):e._e(),e._v(" "),null!==($=e.rowSelected)&&void 0!==$&&null!==(L=$.regularization)&&void 0!==L&&L.committed_action?t("div",{staticClass:"col-8"},[e._v("\n                "+e._s(null===(E=e.rowSelected)||void 0===E||null===(D=E.regularization)||void 0===D?void 0:D.committed_action)+"\n              ")]):e._e(),e._v(" "),t("div",{staticClass:"col-4"},[t("b",[e._v("Date Régularisation:")])]),e._v(" "),t("div",{staticClass:"col-8"},[e._v(e._s(null===(T=e.rowSelected)||void 0===T||null===(q=T.regularization)||void 0===q?void 0:q.regularized_at))])])]):e._e()])]},proxy:!0}],null,!1,115628475)}),e._v(" "),e.modals.edit?t("NLModal",{attrs:{show:e.modals.edit,defaultMode:!0},on:{close:function(t){return e.close("edit")}},scopedSlots:e._u([{key:"title",fn:function(){var a;return[t("small",[e._v("\n          "+e._s(null===(a=e.rowSelected)||void 0===a?void 0:a.control_point.name)+"\n        ")])]},proxy:!0},{key:"default",fn:function(){var a,i,s,r,o,n,l,c,d,u;return[e.forms.generic.errors.any()?t("Notification",{attrs:{type:"is-danger"}},[e._v("\n          Il y a "+e._s(e.formErrorsCount)+"\n          "+e._s(e.formErrorsCount>1?"problèmes avec vos entrées":"problème avec une entrée")+".\n        ")]):e._e(),e._v(" "),e.regularization_mode?t("form",{staticClass:"grid gap-6",attrs:{enctype:"multipart/form-data"},on:{submit:function(t){return t.preventDefault(),e.regularize.apply(null,arguments)},keydown:function(t){return e.forms.detail.onKeydown(t)}}},[t("div",{staticClass:"col-12"},[t("NLSwitch",{attrs:{type:"is-success",name:"regularized",form:e.forms.regularized,label:"Levé"},model:{value:e.forms.regularization.regularized,callback:function(t){e.$set(e.forms.regularization,"regularized",t)},expression:"forms.regularization.regularized"}})],1),e._v(" "),t("div",{staticClass:"col-12"},[e.forms.regularization.regularized?e._e():t("NLSelect",{attrs:{name:"type",options:e.regularizationTypes,form:e.forms.regularization,label:"Choisissez un type",labelRequired:""},model:{value:e.forms.regularization.type,callback:function(t){e.$set(e.forms.regularization,"type",t)},expression:"forms.regularization.type"}})],1),e._v(" "),e.forms.regularization.regularized?t("div",{staticClass:"col-12"},[t("NLTextarea",{attrs:{name:"committed_action",label:"Action engagé",form:e.forms.regularization,length:"3000",labelRequired:""},model:{value:e.forms.regularization.committed_action,callback:function(t){e.$set(e.forms.regularization,"committed_action",t)},expression:"forms.regularization.committed_action"}})],1):e._e(),e._v(" "),e.forms.regularization.regularized||"Cause"!=e.forms.regularization.type?e._e():t("div",{staticClass:"col-12"},[t("NLTextarea",{attrs:{name:"reason",label:"Cause",form:e.forms.regularization,length:"1000",labelRequired:""},model:{value:e.forms.regularization.reason,callback:function(t){e.$set(e.forms.regularization,"reason",t)},expression:"forms.regularization.reason"}})],1),e._v(" "),e.forms.regularization.regularized||"Action à engagé"!=e.forms.regularization.type?e._e():t("div",{staticClass:"col-12"},[t("NLTextarea",{attrs:{name:"action_to_be_taken",label:"Action à engagé",form:e.forms.regularization,length:"3000",labelRequired:""},model:{value:e.forms.regularization.action_to_be_taken,callback:function(t){e.$set(e.forms.regularization,"action_to_be_taken",t)},expression:"forms.regularization.action_to_be_taken"}})],1),e._v(" "),t("div",{staticClass:"col-12 d-flex justify-end align-center"},[e.forms.regularization.id?t("NLButton",{staticClass:"is-radius",attrs:{loading:e.forms.regularization.busy,label:"Validate"}}):t("NLButton",{staticClass:"is-radius",attrs:{loading:e.forms.regularization.busy,label:"Save"}})],1)]):t("form",{staticClass:"grid gap-2",attrs:{enctype:"multipart/form-data"},on:{submit:function(t){return t.preventDefault(),e.save.apply(null,arguments)},keydown:function(t){return e.forms.generic.onKeydown(t)}}},[null!==(a=e.rowSelected)&&void 0!==a&&null!==(i=a.control_point)&&void 0!==i&&i.has_major_fact?t("div",{staticClass:"col-12"},[t("NLSwitch",{attrs:{name:"major_fact",form:e.forms.generic,label:"Fait majeur"},model:{value:e.forms.generic.major_fact,callback:function(t){e.$set(e.forms.generic,"major_fact",t)},expression:"forms.generic.major_fact"}})],1):e._e(),e._v(" "),t("div",{staticClass:"col-12"},[t("NLSelect",{attrs:{name:"score",label:"Notation",form:e.forms.generic,options:e.setupScores(null===(s=e.rowSelected)||void 0===s?void 0:s.control_point.scores),labelRequired:""},model:{value:e.forms.generic.score,callback:function(t){e.$set(e.forms.generic,"score",t)},expression:"forms.generic.score"}})],1),e._v(" "),null!==(r=e.rowSelected)&&void 0!==r&&r.control_point.fields&&e.forms.generic.score>1&&!e.forms.generic.process_mode?t("div",{staticClass:"col-12"},[t("div",{staticClass:"repeater"},[t("h2",{staticClass:"mb-6"},[e._v("Informations supplémentaires")]),e._v(" "),e._l(e.forms.generic.metadata,(function(a,i){var s;return t("div",{key:"metadata-"+i,staticClass:"grid my-6 repeater-row"},[t("div",{staticClass:"col-12"},[t("div",{staticClass:"grid gap-2"},[t("div",{staticClass:"col-11"},[t("div",{staticClass:"grid"},e._l(e.setupFields(null===(s=e.rowSelected)||void 0===s?void 0:s.control_point.fields),(function(a,s){return t("div",{key:"metadata-input-"+a.name+"-"+i+"-id",class:a.style},[e.isInput(a.type)?t("NLInput",{attrs:{form:e.forms.generic,label:a.label,placeholder:a.placeholder,type:a.type,labelRequired:a.required,name:"metadata."+i+"."+s+"."+a.name,id:"metadata."+i+"."+s+"."+a.name},model:{value:e.forms.generic.metadata[i][s][a.name],callback:function(t){e.$set(e.forms.generic.metadata[i][s],a.name,t)},expression:"forms.generic.metadata[dataRow][index][input.name]"}}):e._e(),e._v(" "),"textarea"==a.type?t("NLTextarea",{attrs:{form:e.forms.generic,label:a.label,placeholder:a.placeholder,type:a.type,labelRequired:a.required,name:"metadata."+i+"."+s+"."+a.name,id:"metadata."+i+"."+s+"."+a.name,length:a.length},model:{value:e.forms.generic.metadata[i][s][a.name],callback:function(t){e.$set(e.forms.generic.metadata[i][s],a.name,t)},expression:"forms.generic.metadata[dataRow][index][input.name]"}}):e._e(),e._v(" "),"wyswyg"==a.type?t("NLWyswyg",{attrs:{form:e.forms.generic,label:a.label,placeholder:a.placeholder,type:a.type,labelRequired:a.required,name:"metadata."+i+"."+s+"."+a.name,id:"metadata."+i+"."+s+"."+a.name,length:a.length},model:{value:e.forms.generic.metadata[i][s][a.name],callback:function(t){e.$set(e.forms.generic.metadata[i][s],a.name,t)},expression:"forms.generic.metadata[dataRow][index][input.name]"}}):e._e(),e._v(" "),"select"==a.type?t("NLSelect",{attrs:{form:e.forms.generic,label:a.label,type:a.type,labelRequired:a.required,name:"metadata."+i+"."+s+"."+a.name,id:"metadata."+i+"."+s+"."+a.name,options:a.options,placeholder:a.placeholder||"Choisissez une option...",multiple:a.multiple},model:{value:e.forms.generic.metadata[i][s][a.name],callback:function(t){e.$set(e.forms.generic.metadata[i][s],a.name,t)},expression:"forms.generic.metadata[dataRow][index][input.name]"}}):e._e()],1)})),0)]),e._v(" "),i>=0?t("div",{staticClass:"col-1 p-0 d-flex justify-start align-center"},[t("div",{staticClass:"btn btn-danger",on:{click:function(t){return e.removeRow(i)}}},[e._v("\n                        Supprimer\n                      ")])]):e._e()])])])})),e._v(" "),t("div",{staticClass:"d-flex justify-start align-center"},[t("span",{staticClass:"btn",on:{click:function(t){var a;return e.addRow(null===(a=e.rowSelected)||void 0===a?void 0:a.control_point.fields)}}},[t("i",{staticClass:"las la-plus"})])])],2)]):e.forms.generic.process_mode&&null!==(o=e.rowSelected)&&void 0!==o&&o.metadata?t("div",{staticClass:"col-12 list-item"},[t("div",{staticClass:"list-item-content no-bg grid"},[t("div",{staticClass:"col-12",class:{"col-lg-4":!(null!==(n=e.rowSelected)&&void 0!==n&&n.metadata)}},[t("b",[e._v("Informations supplémentaires:")])]),e._v(" "),t("div",{staticClass:"col-12",class:{"col-lg-8":!(null!==(l=e.rowSelected)&&void 0!==l&&l.metadata)}},[null!==(c=e.rowSelected)&&void 0!==c&&c.metadata?t("table",[t("thead",[t("tr",e._l(e.currentMetadata.keys,(function(a){return t("th",{staticClass:"text-left"},[e._v("\n                        "+e._s(a)+"\n                      ")])})),0)]),e._v(" "),t("tbody",e._l(null===(d=e.rowSelected)||void 0===d?void 0:d.metadata,(function(a,i){return t("tr",{key:"metadata-row-"+i},e._l(a,(function(a,i){return t("td",{key:"metadata-item-"+i,staticClass:"text-left"},e._l(a,(function(a,s){return"label"!==s&&"rules"!==s?t("span",{key:"metadata-item-"+i+"-content"},[e._v("\n                          "+e._s(a||"-")+"\n                        ")]):e._e()})),0)})),0)})),0)]):t("span",[e._v("-")])])])]):e._e(),e._v(" "),t("div",{staticClass:"col-12"},[e.forms.generic.process_mode?t("NLTextarea",{attrs:{label:"Constat",form:e.forms.generic,placeholder:"Constat",name:"report",readonly:""},model:{value:e.forms.generic.report,callback:function(t){e.$set(e.forms.generic,"report",t)},expression:"forms.generic.report"}}):t("NLTextarea",{attrs:{name:"report",label:"Constat",form:e.forms.generic,placeholder:[2,3,4].includes(e.forms.generic.score)||e.forms.generic.major_fact?"Ajouter votre constat":"",labelRequired:e.forms.generic.score>1||e.forms.generic.major_fact,disabled:![2,3,4].includes(e.forms.generic.score)&&!e.forms.generic.major_fact},model:{value:e.forms.generic.report,callback:function(t){e.$set(e.forms.generic,"report",t)},expression:"forms.generic.report"}})],1),e._v(" "),e.forms.generic.media.length?t("div",{staticClass:"col-12"},[t("NLFile",{attrs:{name:"media",label:"Pièces jointes",attachableType:"App\\Models\\MissionDetail",attachableId:e.forms.generic.detail,form:e.forms.generic,multiple:"",canDelete:!(null!==(u=e.rowSelected)&&void 0!==u&&u.controller_opinion_is_validated),readonly:e.forms.generic.process_mode},model:{value:e.forms.generic.media,callback:function(t){e.$set(e.forms.generic,"media",t)},expression:"forms.generic.media"}})],1):e._e(),e._v(" "),t("div",{staticClass:"col-12"},[t("NLTextarea",{attrs:{name:"recovery_plan",label:"Plan de redressement",form:e.forms.generic,placeholder:[2,3,4].includes(e.forms.generic.score)||e.forms.generic.major_fact?"Ajouter votre plan de redressement":"",labelRequired:e.forms.generic.score>1||e.forms.generic.major_fact,disabled:![2,3,4].includes(e.forms.generic.score)&&!e.forms.generic.major_fact},model:{value:e.forms.generic.recovery_plan,callback:function(t){e.$set(e.forms.generic,"recovery_plan",t)},expression:"forms.generic.recovery_plan"}})],1),e._v(" "),t("div",{staticClass:"col-12 d-flex justify-end align-center"},[e.forms.generic.process_mode?t("NLButton",{staticClass:"is-radius",attrs:{loading:e.forms.generic.busy,label:"Validate"}}):t("NLButton",{staticClass:"is-radius",attrs:{loading:e.forms.generic.busy,label:"Save"}})],1)])]},proxy:!0}],null,!1,1457687987)}):e._e()],1)],1):e._e()}),[],!1,null,null,null).exports}}]);
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[4057],{5714:(e,t,s)=>{s.d(t,{ZP:()=>C,l0:()=>_});var r=s(9669),n=s.n(r),a=Object.defineProperty,i=Object.prototype.hasOwnProperty,o=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?a(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,u=(e,t)=>{for(var s in t||(t={}))i.call(t,s)&&c(e,s,t[s]);if(o)for(var s of o(t))l.call(t,s)&&c(e,s,t[s]);return e};const d=e=>void 0===e,f=e=>Array.isArray(e),m=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,p=(e,t,s,r)=>((t=t||{}).indices=!d(t.indices)&&t.indices,t.nullsAsUndefineds=!d(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!d(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!d(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,d(e)||(null===e?t.nullsAsUndefineds||s.append(r,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(r,e?1:0):s.append(r,e):f(e)?e.length?e.forEach(((e,n)=>{const a=r+"["+(t.indices?n:"")+"]";p(e,t,s,a)})):t.allowEmptyArrays&&s.append(r+"[]",""):(e=>e instanceof Date)(e)?s.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>m(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||m(e)?s.append(r,e):Object.keys(e).forEach((n=>{const a=e[n];if(f(a))for(;n.length>2&&n.lastIndexOf("[]")===n.length-2;)n=n.substring(0,n.length-2);p(a,t,s,r?r+"["+n+"]":n)}))),s);var h={serialize:p};function g(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=g(e[s])})),t}function b(e){return Array.isArray(e)?e:[e]}function y(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>y(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:b(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return b(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class _{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,g(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!_.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),_.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!_.ignore.includes(e))).forEach((e=>{this[e]=g(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),y(s.data)&&!s.transformRequest&&(s.transformRequest=[e=>h.serialize(e)])),new Promise(((e,t)=>{(_.axios||n()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:_.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(_.routes,e)&&(s=decodeURI(_.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}_.routes={},_.errorMessage="Something went wrong. Please try again.",_.recentlySuccessfulTimeout=2e3,_.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const C=_},4057:(e,t,s)=>{s.r(t),s.d(t,{default:()=>l});var r=s(6828),n=s(98),a=s(629),i=s(5714);const o={components:{ContentHeader:r.Z,NLSelect:n.Z},layout:"backend",middleware:["auth"],metaInfo:function(){return{title:"Répartition des missions de contrôle"}},data:function(){return{campaignId:null,form:new i.ZP({note:null,start:null,end:null,agencies:null,controllers:null,control_campaign_id:null}),currentCampaign:null,campaignsList:[],controllersList:[],agenciesList:[],cdcModalIsOpen:!1,currentCampaignReference:null}},watch:{"form.control_campaign_id":function(e,t){e!==t&&null!=e&&this.initData()},currentCampaignReference:function(e,t){e!==t&&(this.currentCampaignReference=e)}},breadcrumb:function(){if(this.$route.params.campaignId)return{parent:"campaign",label:"Répartition des missions de contrôle de la campagne "+this.currentCampaignReference}},computed:(0,a.Se)({config:"missions/config"}),created:function(){this.initData()},methods:{initData:function(){var e=this;this.$route.params.campaignId&&(this.form.control_campaign_id=this.$route.params.campaignId,this.campaignId=this.$route.params.campaignId),this.$store.dispatch("missions/fetchConfig",this.form.control_campaign_id).then((function(){e.agenciesList=e.config.config.agencies,e.controllersList=e.config.config.controllers,e.campaignsList=e.config.config.campaigns,e.currentCampaign=e.config.config.currentCampaign,e.currentCampaignReference=e.config.config.currentCampaign.reference}))},resetForm:function(){this.form.note=null,this.form.start=null,this.form.end=null,this.form.agencies=null,this.form.controllers=null},create:function(){var e=this;this.form.post("/api/missions").then((function(t){t.data.status?(swal.toast_success(t.data.message),e.initData(),e.resetForm()):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const l=(0,s(1900).Z)(o,(function(){var e,t,s,r,n,a=this,i=a._self._c;return a.can("create_mission")?i("ContentBody",[i("ContentHeader",{scopedSlots:a._u([{key:"actions",fn:function(){return[i("button",{staticClass:"btn btn-info has-icon",on:{click:function(e){e.preventDefault(),a.cdcModalIsOpen=!0}}},[i("i",{staticClass:"las la-exclamation-circle icon"}),a._v("\n        Campagne de contrôle\n      ")])]},proxy:!0}],null,!1,4040134830)}),a._v(" "),i("form",{on:{submit:function(e){return e.preventDefault(),a.create.apply(null,arguments)},keydown:function(e){return a.form.onKeydown(e)}}},[i("div",{staticClass:"grid my-2"},[this.campaignId?i("div",{staticClass:"col-12 col-lg-6"},[i("NLInput",{attrs:{name:"campaign",label:"Campagne de contrôle",readonly:""},model:{value:a.currentCampaignReference,callback:function(e){a.currentCampaignReference=e},expression:"currentCampaignReference"}})],1):i("div",{staticClass:"col-12 col-lg-6"},[i("NLSelect",{attrs:{name:"control_campaign_id",label:"Campagne de contrôle",placeholder:"Veuillez choisir une campagne de contrôle",options:a.campaignsList,form:a.form,labelRequired:""},model:{value:a.form.control_campaign_id,callback:function(e){a.$set(a.form,"control_campaign_id",e)},expression:"form.control_campaign_id"}})],1),a._v(" "),i("div",{staticClass:"col-12 col-lg-6"},[i("NLSelect",{attrs:{name:"agencies",label:"Agences",placeholder:"Veuillez choisir une ou plusieurs agences",options:a.agenciesList,form:a.form,labelRequired:"",multiple:!0},model:{value:a.form.agencies,callback:function(e){a.$set(a.form,"agencies",e)},expression:"form.agencies"}})],1),a._v(" "),i("div",{staticClass:"col-12"},[i("NLSelect",{attrs:{name:"controllers",label:"Contrôleurs",placeholder:"Veuillez choisir un ou plusieurs contrôleurs",options:a.controllersList,form:a.form,labelRequired:"",multiple:!0,loadingText:"Chargement de la liste des contrôleurs en cours",noOptionsText:"Vous n'avez aucun contrôleur de disponible pour le moment"},model:{value:a.form.controllers,callback:function(e){a.$set(a.form,"controllers",e)},expression:"form.controllers"}})],1),a._v(" "),i("div",{staticClass:"col-12 col-lg-6 col-tablet-6"},[i("NLInput",{attrs:{form:a.form,name:"start",label:"Date début",type:"date",labelRequired:""},model:{value:a.form.start,callback:function(e){a.$set(a.form,"start",e)},expression:"form.start"}})],1),a._v(" "),i("div",{staticClass:"col-12 col-lg-6 col-tablet-6"},[i("NLInput",{attrs:{form:a.form,name:"end",label:"Date fin",type:"date",labelRequired:""},model:{value:a.form.end,callback:function(e){a.$set(a.form,"end",e)},expression:"form.end"}})],1),a._v(" "),i("div",{staticClass:"col-12"},[i("NLTextarea",{attrs:{form:a.form,name:"note",label:"Note",placeholder:"Ajouter une note"},model:{value:a.form.note,callback:function(e){a.$set(a.form,"note",e)},expression:"form.note"}})],1)]),a._v(" "),i("div",{staticClass:"d-flex justify-end align-center"},[i("NLButton",{staticClass:"is-radius",attrs:{loading:a.form.busy,label:"Add"}})],1)]),a._v(" "),i("NLModal",{attrs:{show:a.cdcModalIsOpen},on:{close:function(e){a.cdcModalIsOpen=!1}},scopedSlots:a._u([{key:"title",fn:function(){var e;return[a._v("\n      "+a._s(null===(e=a.currentCampaign)||void 0===e?void 0:e.reference)+"\n    ")]},proxy:!0}],null,!1,1014712477)},[a._v(" "),[i("div",{staticClass:"list grid gap-12"},[i("div",{staticClass:"col-12 col-lg-6 list-item"},[i("span",{staticClass:"list-item-label"},[a._v("\n            Début\n          ")]),a._v(" "),i("span",{staticClass:"list-item-content"},[a._v("\n            "+a._s((null===(e=a.currentCampaign)||void 0===e?void 0:e.start)+" / "+(null===(t=a.currentCampaign)||void 0===t?void 0:t.remaining_days_before_start_str))+"\n          ")])]),a._v(" "),i("div",{staticClass:"col-12 col-lg-6 list-item"},[i("span",{staticClass:"list-item-label"},[a._v("\n            Fin\n          ")]),a._v(" "),i("span",{staticClass:"list-item-content"},[a._v("\n            "+a._s((null===(s=a.currentCampaign)||void 0===s?void 0:s.end)+" / "+(null===(r=a.currentCampaign)||void 0===r?void 0:r.remaining_days_before_end_str))+"\n          ")])]),a._v(" "),i("div",{staticClass:"col-12 list-item"},[i("span",{staticClass:"list-item-label"},[a._v("\n            Description:\n          ")]),a._v(" "),i("span",{staticClass:"list-item-content"},[a._v("\n            "+a._s(null===(n=a.currentCampaign)||void 0===n?void 0:n.description)+"\n          ")])])])]],2)],1):a._e()}),[],!1,null,null,null).exports}}]);
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1110],{5714:(e,t,s)=>{s.d(t,{ZP:()=>j,l0:()=>O});var r=s(9669),i=s.n(r),o=Object.defineProperty,n=Object.prototype.hasOwnProperty,a=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?o(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,u=(e,t)=>{for(var s in t||(t={}))n.call(t,s)&&c(e,s,t[s]);if(a)for(var s of a(t))l.call(t,s)&&c(e,s,t[s]);return e};const f=e=>void 0===e,d=e=>Array.isArray(e),m=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,h=(e,t,s,r)=>((t=t||{}).indices=!f(t.indices)&&t.indices,t.nullsAsUndefineds=!f(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!f(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!f(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,f(e)||(null===e?t.nullsAsUndefineds||s.append(r,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(r,e?1:0):s.append(r,e):d(e)?e.length?e.forEach(((e,i)=>{const o=r+"["+(t.indices?i:"")+"]";h(e,t,s,o)})):t.allowEmptyArrays&&s.append(r+"[]",""):(e=>e instanceof Date)(e)?s.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>m(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||m(e)?s.append(r,e):Object.keys(e).forEach((i=>{const o=e[i];if(d(o))for(;i.length>2&&i.lastIndexOf("[]")===i.length-2;)i=i.substring(0,i.length-2);h(o,t,s,r?r+"["+i+"]":i)}))),s);var p={serialize:h};function y(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=y(e[s])})),t}function b(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:b(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return b(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class O{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,y(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!O.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),O.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!O.ignore.includes(e))).forEach((e=>{this[e]=y(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),g(s.data)&&!s.transformRequest&&(s.transformRequest=[e=>p.serialize(e)])),new Promise(((e,t)=>{(O.axios||i()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:O.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(O.routes,e)&&(s=decodeURI(O.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}O.routes={},O.errorMessage="Something went wrong. Please try again.",O.recentlySuccessfulTimeout=2e3,O.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const j=O},1110:(e,t,s)=>{s.r(t),s.d(t,{default:()=>l});var r=s(5714);function i(e){return i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},i(e)}function o(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function n(e,t,s){return(t=function(e){var t=function(e,t){if("object"!==i(e)||null===e)return e;var s=e[Symbol.toPrimitive];if(void 0!==s){var r=s.call(e,t||"default");if("object"!==i(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(e,"string");return"symbol"===i(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}const a={middleware:["auth","admin"],layout:"backend",computed:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?o(Object(s),!0).forEach((function(t){n(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},(0,s(629).Se)({famillies:"famillies/all",familly:"famillies/domains"})),watch:{"form.familly_id":function(e,t){e!==t&&this.loadDomains(e)}},data:function(){return{familliesList:[],domainsList:[],form:new r.l0({name:null,familly_id:null,domain_id:null})}},created:function(){this.initData()},methods:{initData:function(){var e=this;this.$store.dispatch("famillies/fetchAll").then((function(){e.familliesList=e.famillies.all}))},loadDomains:function(e){var t=this;e?this.$store.dispatch("famillies/fetch",{id:e,onlyDomains:!0}).then((function(){t.domainsList=t.familly.domains})):this.domainsList=[]},create:function(){var e=this;this.form.post("/api/processes").then((function(t){t.data.status?(swal.toast_success(t.data.message),e.form.reset()):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const l=(0,s(1900).Z)(a,(function(){var e=this,t=e._self._c;return t("div",{directives:[{name:"can",rawName:"v-can",value:"create_process",expression:"'create_process'"}]},[t("ContentHeader",{attrs:{title:"Ajouter un nouveau processus"}}),e._v(" "),t("ContentBody",[t("form",{on:{submit:function(t){return t.preventDefault(),e.create.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[t("div",{staticClass:"grid gap-10 my-4"},[t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"familly_id",label:"Famille",options:e.familliesList,labelRequired:"",multiple:!1},model:{value:e.form.familly_id,callback:function(t){e.$set(e.form,"familly_id",t)},expression:"form.familly_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"domain_id",label:"Domaine",options:e.domainsList,labelRequired:"",multiple:!1},model:{value:e.form.domain_id,callback:function(t){e.$set(e.form,"domain_id",t)},expression:"form.domain_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{form:e.form,name:"name",label:"Name",labelRequired:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1)]),e._v(" "),t("div",{staticClass:"d-flex justify-end align-center"},[t("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Add"}})],1)])])],1)}),[],!1,null,null,null).exports}}]);
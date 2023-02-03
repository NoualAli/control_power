"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[539],{5714:(e,t,r)=>{r.d(t,{ZP:()=>j,l0:()=>v});var s=r(9669),o=r.n(s),n=Object.defineProperty,a=Object.prototype.hasOwnProperty,i=Object.getOwnPropertySymbols,c=Object.prototype.propertyIsEnumerable,l=(e,t,r)=>t in e?n(e,t,{enumerable:!0,configurable:!0,writable:!0,value:r}):e[t]=r,u=(e,t)=>{for(var r in t||(t={}))a.call(t,r)&&l(e,r,t[r]);if(i)for(var r of i(t))c.call(t,r)&&l(e,r,t[r]);return e};const d=e=>void 0===e,h=e=>Array.isArray(e),f=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,p=(e,t,r,s)=>((t=t||{}).indices=!d(t.indices)&&t.indices,t.nullsAsUndefineds=!d(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!d(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!d(t.allowEmptyArrays)&&t.allowEmptyArrays,r=r||new FormData,d(e)||(null===e?t.nullsAsUndefineds||r.append(s,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?r.append(s,e?1:0):r.append(s,e):h(e)?e.length?e.forEach(((e,o)=>{const n=s+"["+(t.indices?o:"")+"]";p(e,t,r,n)})):t.allowEmptyArrays&&r.append(s+"[]",""):(e=>e instanceof Date)(e)?r.append(s,e.toISOString()):!(e=>e===Object(e))(e)||(e=>f(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||f(e)?r.append(s,e):Object.keys(e).forEach((o=>{const n=e[o];if(h(n))for(;o.length>2&&o.lastIndexOf("[]")===o.length-2;)o=o.substring(0,o.length-2);p(n,t,r,s?s+"["+o+"]":o)}))),r);var y={serialize:p};function m(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((r=>{t[r]=m(e[r])})),t}function b(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class O{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:b(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return b(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const r=this.get(e);r&&t.push(r)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((r=>{r!==e&&(t[r]=this.errors[r])})),this.set(t)}}class v{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new O,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,m(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!v.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),v.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!v.ignore.includes(e))).forEach((e=>{this[e]=m(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,r={}){return this.startProcessing(),r=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},r),"get"===e.toLowerCase()?r.params=u(u({},this.data()),r.params):(r.data=u(u({},this.data()),r.data),g(r.data)&&!r.transformRequest&&(r.transformRequest=[e=>y.serialize(e)])),new Promise(((e,t)=>{(v.axios||o()).request(r).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:v.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let r=e;return Object.prototype.hasOwnProperty.call(v.routes,e)&&(r=decodeURI(v.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{r=r.replace(`{${e}}`,t[e])})),r}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}v.routes={},v.errorMessage="Something went wrong. Please try again.",v.recentlySuccessfulTimeout=2e3,v.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const j=v},1539:(e,t,r)=>{r.r(t),r.d(t,{default:()=>i});var s=r(5714);function o(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,s)}return r}function n(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}const a={middleware:["auth","admin"],layout:"backend",computed:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?o(Object(r),!0).forEach((function(t){n(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},(0,r(629).Se)({dre:"dre/current"})),created:function(){var e=this;this.$store.dispatch("dre/fetch",this.$route.params.dre).then((function(){var t=e.dre.current;e.form.fill(t)}))},data:function(){return{form:new s.l0({name:"",code:""})}},methods:{update:function(){var e=this;this.form.put("/api/dre/"+this.$route.params.dre).then((function(t){t.data.status?(swal.toast_success(t.data.message),e.$router.push({name:"dre-index"})):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const i=(0,r(1900).Z)(a,(function(){var e=this,t=e._self._c;return t("div",{directives:[{name:"can",rawName:"v-can",value:"edit_dre",expression:"'edit_dre'"}]},[t("ContentBody",[t("form",{on:{submit:function(t){return t.preventDefault(),e.update.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[t("div",{staticClass:"grid gap-10 my-4"},[t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{type:"number",form:e.form,name:"code",label:"Code",labelRequired:""},model:{value:e.form.code,callback:function(t){e.$set(e.form,"code",t)},expression:"form.code"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{form:e.form,name:"name",label:"Name",labelRequired:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1)]),e._v(" "),t("div",{staticClass:"d-flex justify-end align-center"},[t("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Update"}})],1)])])],1)}),[],!1,null,null,null).exports}}]);
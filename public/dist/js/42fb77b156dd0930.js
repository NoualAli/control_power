"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[8727],{5714:(e,t,s)=>{s.d(t,{ZP:()=>w,l0:()=>j});var r=s(9669),a=s.n(r),o=Object.defineProperty,n=Object.prototype.hasOwnProperty,i=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?o(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,u=(e,t)=>{for(var s in t||(t={}))n.call(t,s)&&c(e,s,t[s]);if(i)for(var s of i(t))l.call(t,s)&&c(e,s,t[s]);return e};const d=e=>void 0===e,h=e=>Array.isArray(e),f=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,p=(e,t,s,r)=>((t=t||{}).indices=!d(t.indices)&&t.indices,t.nullsAsUndefineds=!d(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!d(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!d(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,d(e)||(null===e?t.nullsAsUndefineds||s.append(r,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(r,e?1:0):s.append(r,e):h(e)?e.length?e.forEach(((e,a)=>{const o=r+"["+(t.indices?a:"")+"]";p(e,t,s,o)})):t.allowEmptyArrays&&s.append(r+"[]",""):(e=>e instanceof Date)(e)?s.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>f(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||f(e)?s.append(r,e):Object.keys(e).forEach((a=>{const o=e[a];if(h(o))for(;a.length>2&&a.lastIndexOf("[]")===a.length-2;)a=a.substring(0,a.length-2);p(o,t,s,r?r+"["+a+"]":a)}))),s);var y={serialize:p};function m(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=m(e[s])})),t}function b(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:b(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return b(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class j{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,m(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!j.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),j.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!j.ignore.includes(e))).forEach((e=>{this[e]=m(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),g(s.data)&&!s.transformRequest&&(s.transformRequest=[e=>y.serialize(e)])),new Promise(((e,t)=>{(j.axios||a()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:j.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(j.routes,e)&&(s=decodeURI(j.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}j.routes={},j.errorMessage="Something went wrong. Please try again.",j.recentlySuccessfulTimeout=2e3,j.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const w=j},8727:(e,t,s)=>{s.r(t),s.d(t,{default:()=>o});var r=s(5714);const a={middleware:["auth","admin"],layout:"backend",data:function(){return{form:new r.l0({name:"",code:""})}},methods:{create:function(){var e=this;this.form.post("/api/dre").then((function(t){t.data.status?(swal.toast_success(t.data.message),e.form.reset()):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const o=(0,s(1900).Z)(a,(function(){var e=this,t=e._self._c;return t("div",{directives:[{name:"can",rawName:"v-can",value:"create_dre",expression:"'create_dre'"}]},[t("ContentHeader",{attrs:{title:"Ajouter une nouvelle DRE"}}),e._v(" "),t("ContentBody",[t("form",{on:{submit:function(t){return t.preventDefault(),e.create.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[t("div",{staticClass:"grid gap-10 my-4"},[t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{type:"number",form:e.form,name:"code",label:"Code",labelRequired:""},model:{value:e.form.code,callback:function(t){e.$set(e.form,"code",t)},expression:"form.code"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{form:e.form,name:"name",label:"Name",labelRequired:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1)]),e._v(" "),t("div",{staticClass:"d-flex justify-end align-center"},[t("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Add"}})],1)])])],1)}),[],!1,null,null,null).exports}}]);
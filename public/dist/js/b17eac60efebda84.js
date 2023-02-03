"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[210],{5714:(e,s,t)=>{t.d(s,{ZP:()=>_,l0:()=>w});var r=t(9669),o=t.n(r),a=Object.defineProperty,l=Object.prototype.hasOwnProperty,n=Object.getOwnPropertySymbols,i=Object.prototype.propertyIsEnumerable,c=(e,s,t)=>s in e?a(e,s,{enumerable:!0,configurable:!0,writable:!0,value:t}):e[s]=t,u=(e,s)=>{for(var t in s||(s={}))l.call(s,t)&&c(e,t,s[t]);if(n)for(var t of n(s))i.call(s,t)&&c(e,t,s[t]);return e};const d=e=>void 0===e,f=e=>Array.isArray(e),m=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,h=(e,s,t,r)=>((s=s||{}).indices=!d(s.indices)&&s.indices,s.nullsAsUndefineds=!d(s.nullsAsUndefineds)&&s.nullsAsUndefineds,s.booleansAsIntegers=!d(s.booleansAsIntegers)&&s.booleansAsIntegers,s.allowEmptyArrays=!d(s.allowEmptyArrays)&&s.allowEmptyArrays,t=t||new FormData,d(e)||(null===e?s.nullsAsUndefineds||t.append(r,""):(e=>"boolean"==typeof e)(e)?s.booleansAsIntegers?t.append(r,e?1:0):t.append(r,e):f(e)?e.length?e.forEach(((e,o)=>{const a=r+"["+(s.indices?o:"")+"]";h(e,s,t,a)})):s.allowEmptyArrays&&t.append(r+"[]",""):(e=>e instanceof Date)(e)?t.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>m(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||m(e)?t.append(r,e):Object.keys(e).forEach((o=>{const a=e[o];if(f(a))for(;o.length>2&&o.lastIndexOf("[]")===o.length-2;)o=o.substring(0,o.length-2);h(a,s,t,r?r+"["+o+"]":o)}))),t);var p={serialize:h};function y(e){if(null===e||"object"!=typeof e)return e;const s=Array.isArray(e)?[]:{};return Object.keys(e).forEach((t=>{s[t]=y(e[t])})),s}function b(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,s){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:b(s)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return b(this.errors[e]||[])}only(...e){const s=[];return e.forEach((e=>{const t=this.get(e);t&&s.push(t)})),s}flatten(){return Object.values(this.errors).reduce(((e,s)=>e.concat(s)),[])}clear(e){const s={};e&&Object.keys(this.errors).forEach((t=>{t!==e&&(s[t]=this.errors[t])})),this.set(s)}}class w{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,y(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((s=>{this[s]=e[s]}))}data(){return this.keys().reduce(((e,s)=>u(u({},e),{[s]:this[s]})),{})}keys(){return Object.keys(this).filter((e=>!w.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),w.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!w.ignore.includes(e))).forEach((e=>{this[e]=y(this.originalData[e])}))}get(e,s={}){return this.submit("get",e,s)}post(e,s={}){return this.submit("post",e,s)}patch(e,s={}){return this.submit("patch",e,s)}put(e,s={}){return this.submit("put",e,s)}delete(e,s={}){return this.submit("delete",e,s)}submit(e,s,t={}){return this.startProcessing(),t=u({data:{},params:{},url:this.route(s),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},t),"get"===e.toLowerCase()?t.params=u(u({},this.data()),t.params):(t.data=u(u({},this.data()),t.data),g(t.data)&&!t.transformRequest&&(t.transformRequest=[e=>p.serialize(e)])),new Promise(((e,s)=>{(w.axios||o()).request(t).then((s=>{this.finishProcessing(),e(s)})).catch((e=>{this.handleErrors(e),s(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:w.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,s={}){let t=e;return Object.prototype.hasOwnProperty.call(w.routes,e)&&(t=decodeURI(w.routes[e])),"object"!=typeof s&&(s={id:s}),Object.keys(s).forEach((e=>{t=t.replace(`{${e}}`,s[e])})),t}onKeydown(e){const s=e.target;s.name&&this.errors.clear(s.name)}}w.routes={},w.errorMessage="Something went wrong. Please try again.",w.recentlySuccessfulTimeout=2e3,w.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const _=w},210:(e,s,t)=>{t.r(s),t.d(s,{default:()=>a});var r=t(5714);const o={middleware:["auth","admin"],layout:"backend",data:function(){return{form:new r.l0({username:null,email:null,first_name:null,last_name:null,gender:null,password:null,password_confirmation:null,roles:[],dres:[]}),dresList:[],rolesList:[]}},computed:(0,t(629).Se)({roles:"roles/all",dres:"dre/all"}),created:function(){var e=this;this.$store.dispatch("roles/fetchAll").then((function(){e.roles.all.forEach((function(s){s={id:s.id,label:s.name},e.rolesList.push(s)}))})),this.$store.dispatch("dre/fetchAll").then((function(){e.dres.all.forEach((function(s){s={id:s.id,label:s.name},e.dresList.push(s)}))}))},methods:{create:function(){var e=this;this.form.post("/api/users").then((function(s){s.data.status?(swal.toast_success(s.data.message),e.form.reset()):swal.alert_error(s.data.message)})).catch((function(e){console.log(e)}))},getPlaceholder:function(e){if(e){var s,t,r;return void 0!==(r=null===(s=this.dres)||void 0===s?void 0:s.all.filter((function(s){return s.id==e})))[0]?null===(t=r[0])||void 0===t?void 0:t.name:null}}}};const a=(0,t(1900).Z)(o,(function(){var e=this,s=e._self._c;return s("div",{directives:[{name:"can",rawName:"v-can",value:"create_user",expression:"'create_user'"}]},[s("ContentHeader",{attrs:{title:"Ajouter un utilisateur"}}),e._v(" "),s("ContentBody",[s("form",{on:{submit:function(s){return s.preventDefault(),e.create.apply(null,arguments)},keydown:function(s){return e.form.onKeydown(s)}}},[s("div",{staticClass:"grid gap-10 my-4"},[s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLInput",{attrs:{form:e.form,name:"firstname",label:"firstname"},model:{value:e.form.first_name,callback:function(s){e.$set(e.form,"first_name",s)},expression:"form.first_name"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLInput",{attrs:{form:e.form,name:"last_name",label:"lastname"},model:{value:e.form.last_name,callback:function(s){e.$set(e.form,"last_name",s)},expression:"form.last_name"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLInput",{attrs:{form:e.form,name:"username",label:"username",labelRequired:""},model:{value:e.form.username,callback:function(s){e.$set(e.form,"username",s)},expression:"form.username"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLInput",{attrs:{form:e.form,name:"email",label:"email",labelRequired:"",type:"email"},model:{value:e.form.email,callback:function(s){e.$set(e.form,"email",s)},expression:"form.email"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLInput",{attrs:{form:e.form,name:"phone",label:"phone",type:"phone"},model:{value:e.form.phone,callback:function(s){e.$set(e.form,"phone",s)},expression:"form.phone"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-6 col-md-6"},[s("NLSelect",{attrs:{form:e.form,name:"dres",label:"Dre",options:e.dresList,multiple:!0},model:{value:e.form.dres,callback:function(s){e.$set(e.form,"dres",s)},expression:"form.dres"}})],1),e._v(" "),s("div",{staticClass:"col-12"},[s("NLSelect",{attrs:{form:e.form,name:"roles",label:"Rôles",options:e.rolesList,multiple:!0},model:{value:e.form.roles,callback:function(s){e.$set(e.form,"roles",s)},expression:"form.roles"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-4"},[s("NLInput",{attrs:{form:e.form,label:"Password",name:"password",type:"password",labelRequired:""},model:{value:e.form.password,callback:function(s){e.$set(e.form,"password",s)},expression:"form.password"}})],1),e._v(" "),s("div",{staticClass:"col-12 col-lg-4"},[s("NLInput",{attrs:{form:e.form,label:"confirm_password",name:"password_confirmation",type:"password",labelRequired:""},model:{value:e.form.password_confirmation,callback:function(s){e.$set(e.form,"password_confirmation",s)},expression:"form.password_confirmation"}})],1)]),e._v(" "),s("div",{staticClass:"d-flex justify-end align-center"},[s("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Add"}})],1)])])],1)}),[],!1,null,"d5d2b4d8",null).exports}}]);
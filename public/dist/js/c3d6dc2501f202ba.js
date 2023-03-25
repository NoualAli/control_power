"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[9630],{5714:(s,e,t)=>{t.d(e,{ZP:()=>F,l0:()=>v});var r=t(9669),o=t.n(r),a=Object.defineProperty,n=Object.prototype.hasOwnProperty,i=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(s,e,t)=>e in s?a(s,e,{enumerable:!0,configurable:!0,writable:!0,value:t}):s[e]=t,u=(s,e)=>{for(var t in e||(e={}))n.call(e,t)&&c(s,t,e[t]);if(i)for(var t of i(e))l.call(e,t)&&c(s,t,e[t]);return s};const d=s=>void 0===s,f=s=>Array.isArray(s),m=s=>s&&"number"==typeof s.size&&"string"==typeof s.type&&"function"==typeof s.slice,p=(s,e,t,r)=>((e=e||{}).indices=!d(e.indices)&&e.indices,e.nullsAsUndefineds=!d(e.nullsAsUndefineds)&&e.nullsAsUndefineds,e.booleansAsIntegers=!d(e.booleansAsIntegers)&&e.booleansAsIntegers,e.allowEmptyArrays=!d(e.allowEmptyArrays)&&e.allowEmptyArrays,t=t||new FormData,d(s)||(null===s?e.nullsAsUndefineds||t.append(r,""):(s=>"boolean"==typeof s)(s)?e.booleansAsIntegers?t.append(r,s?1:0):t.append(r,s):f(s)?s.length?s.forEach(((s,o)=>{const a=r+"["+(e.indices?o:"")+"]";p(s,e,t,a)})):e.allowEmptyArrays&&t.append(r+"[]",""):(s=>s instanceof Date)(s)?t.append(r,s.toISOString()):!(s=>s===Object(s))(s)||(s=>m(s)&&"string"==typeof s.name&&("object"==typeof s.lastModifiedDate||"number"==typeof s.lastModified))(s)||m(s)?t.append(r,s):Object.keys(s).forEach((o=>{const a=s[o];if(f(a))for(;o.length>2&&o.lastIndexOf("[]")===o.length-2;)o=o.substring(0,o.length-2);p(a,e,t,r?r+"["+o+"]":o)}))),t);var h={serialize:p};function y(s){if(null===s||"object"!=typeof s)return s;const e=Array.isArray(s)?[]:{};return Object.keys(s).forEach((t=>{e[t]=y(s[t])})),e}function g(s){return Array.isArray(s)?s:[s]}function b(s){return s instanceof File||s instanceof Blob||s instanceof FileList||"object"==typeof s&&null!==s&&void 0!==Object.values(s).find((s=>b(s)))}class w{constructor(){this.errors={},this.errors={}}set(s,e){"object"==typeof s?this.errors=s:this.set(u(u({},this.errors),{[s]:g(e)}))}all(){return this.errors}has(s){return Object.prototype.hasOwnProperty.call(this.errors,s)}hasAny(...s){return s.some((s=>this.has(s)))}any(){return Object.keys(this.errors).length>0}get(s){if(this.has(s))return this.getAll(s)[0]}getAll(s){return g(this.errors[s]||[])}only(...s){const e=[];return s.forEach((s=>{const t=this.get(s);t&&e.push(t)})),e}flatten(){return Object.values(this.errors).reduce(((s,e)=>s.concat(e)),[])}clear(s){const e={};s&&Object.keys(this.errors).forEach((t=>{t!==s&&(e[t]=this.errors[t])})),this.set(e)}}class v{constructor(s={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new w,this.progress=void 0,this.update(s)}static make(s){return new this(s)}update(s){this.originalData=Object.assign({},this.originalData,y(s)),Object.assign(this,s)}fill(s={}){this.keys().forEach((e=>{this[e]=s[e]}))}data(){return this.keys().reduce(((s,e)=>u(u({},s),{[e]:this[e]})),{})}keys(){return Object.keys(this).filter((s=>!v.ignore.includes(s)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),v.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((s=>!v.ignore.includes(s))).forEach((s=>{this[s]=y(this.originalData[s])}))}get(s,e={}){return this.submit("get",s,e)}post(s,e={}){return this.submit("post",s,e)}patch(s,e={}){return this.submit("patch",s,e)}put(s,e={}){return this.submit("put",s,e)}delete(s,e={}){return this.submit("delete",s,e)}submit(s,e,t={}){return this.startProcessing(),t=u({data:{},params:{},url:this.route(e),method:s,onUploadProgress:this.handleUploadProgress.bind(this)},t),"get"===s.toLowerCase()?t.params=u(u({},this.data()),t.params):(t.data=u(u({},this.data()),t.data),b(t.data)&&!t.transformRequest&&(t.transformRequest=[s=>h.serialize(s)])),new Promise(((s,e)=>{(v.axios||o()).request(t).then((e=>{this.finishProcessing(),s(e)})).catch((s=>{this.handleErrors(s),e(s)}))}))}handleErrors(s){this.busy=!1,this.progress=void 0,s.response&&this.errors.set(this.extractErrors(s.response))}extractErrors(s){return s.data&&"object"==typeof s.data?s.data.errors?u({},s.data.errors):s.data.message?{error:s.data.message}:u({},s.data):{error:v.errorMessage}}handleUploadProgress(s){this.progress={total:s.total,loaded:s.loaded,percentage:Math.round(100*s.loaded/s.total)}}route(s,e={}){let t=s;return Object.prototype.hasOwnProperty.call(v.routes,s)&&(t=decodeURI(v.routes[s])),"object"!=typeof e&&(e={id:e}),Object.keys(e).forEach((s=>{t=t.replace(`{${s}}`,e[s])})),t}onKeydown(s){const e=s.target;e.name&&this.errors.clear(e.name)}}v.routes={},v.errorMessage="Something went wrong. Please try again.",v.recentlySuccessfulTimeout=2e3,v.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const F=v},9630:(s,e,t)=>{t.r(e),t.d(e,{default:()=>i});var r=t(5714),o=t(629),a=t(7565);const n={layout:"backend",metaInfo:function(){return{title:"Profil"}},data:function(){return{infoForm:new r.ZP({username:"",email:"",first_name:"",last_name:""}),passwordForm:new r.ZP({password:"",current_password:"",password_confirmation:""})}},computed:(0,o.Se)({user:"auth/user"}),created:function(){var s=this;this.infoForm.keys().forEach((function(e){s.infoForm[e]=s.user[e]}))},methods:{updateProfile:function(){this.infoForm.patch("/api/settings/profile/"+(0,a.EA)().id).then((function(s){s.data.status?swal.toast_success(s.data.message):swal.alert_error(s.data.message)})).catch((function(s){console.log(s)}))},updatePassword:function(){var s=this;this.passwordForm.patch("/api/settings/password/"+(0,a.EA)().id).then((function(e){e.data.status?(swal.toast_success(e.data.message),s.passwordForm.reset()):swal.alert_error(e.data.message)})).catch((function(s){console.log(s)}))}}};const i=(0,t(1900).Z)(n,(function(){var s=this,e=s._self._c;return e("div",{staticClass:"grid"},[e("div",{staticClass:"col-12"},[e("form",{on:{submit:function(e){return e.preventDefault(),s.updateProfile.apply(null,arguments)},keydown:function(e){return s.infoForm.onKeydown(e)}}},[e("h2",[s._v("Mettez à jour vos informations")]),s._v(" "),e("div",{staticClass:"grid gap-3 my-4"},[e("div",{staticClass:"col-12 col-lg-4 col-md-6"},[e("NLInput",{attrs:{form:s.infoForm,name:"firstname",label:"firstname"},model:{value:s.infoForm.first_name,callback:function(e){s.$set(s.infoForm,"first_name",e)},expression:"infoForm.first_name"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-4 col-md-6"},[e("NLInput",{attrs:{form:s.infoForm,name:"last_name",label:"lastname"},model:{value:s.infoForm.last_name,callback:function(e){s.$set(s.infoForm,"last_name",e)},expression:"infoForm.last_name"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-4 col-md-6"},[e("NLInput",{attrs:{form:s.infoForm,name:"username",label:"username",labelRequired:""},model:{value:s.infoForm.username,callback:function(e){s.$set(s.infoForm,"username",e)},expression:"infoForm.username"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-6 col-md-6"},[e("NLInput",{attrs:{form:s.infoForm,name:"phone",label:"phone",type:"phone"},model:{value:s.infoForm.phone,callback:function(e){s.$set(s.infoForm,"phone",e)},expression:"infoForm.phone"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-6 col-md-6"},[e("NLInput",{attrs:{form:s.infoForm,name:"email",label:"email",labelRequired:"",type:"email"},model:{value:s.infoForm.email,callback:function(e){s.$set(s.infoForm,"email",e)},expression:"infoForm.email"}})],1)]),s._v(" "),e("div",{staticClass:"d-flex justify-end align-center"},[e("NLButton",{staticClass:"is-radius",attrs:{loading:s.infoForm.busy,label:"Update"}})],1)])]),s._v(" "),e("div",{staticClass:"col-12"},[e("form",{on:{submit:function(e){return e.preventDefault(),s.updatePassword.apply(null,arguments)},keydown:function(e){return s.passwordForm.onKeydown(e)}}},[e("h2",[s._v("Changez votre mot de passe")]),s._v(" "),e("div",{staticClass:"grid gap-3 my-4"},[e("div",{staticClass:"col-12 col-lg-4"},[e("NLInput",{attrs:{form:s.passwordForm,label:"current_password",name:"current_password",type:"password",labelRequired:""},model:{value:s.passwordForm.current_password,callback:function(e){s.$set(s.passwordForm,"current_password",e)},expression:"passwordForm.current_password"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-4"},[e("NLInput",{attrs:{form:s.passwordForm,label:"Password",name:"password",type:"password",labelRequired:""},model:{value:s.passwordForm.password,callback:function(e){s.$set(s.passwordForm,"password",e)},expression:"passwordForm.password"}})],1),s._v(" "),e("div",{staticClass:"col-12 col-lg-4"},[e("NLInput",{attrs:{form:s.passwordForm,label:"confirm_password",name:"password_confirmation",type:"password",labelRequired:""},model:{value:s.passwordForm.password_confirmation,callback:function(e){s.$set(s.passwordForm,"password_confirmation",e)},expression:"passwordForm.password_confirmation"}})],1)]),s._v(" "),e("div",{staticClass:"d-flex justify-end align-center"},[e("NLButton",{staticClass:"is-radius",attrs:{loading:s.infoForm.busy,label:"Update"}})],1)])])])}),[],!1,null,null,null).exports}}]);
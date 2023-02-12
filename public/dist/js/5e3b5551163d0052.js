/*! For license information please see 5e3b5551163d0052.js.LICENSE.txt */
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[704],{5714:(t,e,r)=>{r.d(e,{ZP:()=>x,l0:()=>w});var n=r(9669),o=r.n(n),s=Object.defineProperty,i=Object.prototype.hasOwnProperty,a=Object.getOwnPropertySymbols,c=Object.prototype.propertyIsEnumerable,u=(t,e,r)=>e in t?s(t,e,{enumerable:!0,configurable:!0,writable:!0,value:r}):t[e]=r,l=(t,e)=>{for(var r in e||(e={}))i.call(e,r)&&u(t,r,e[r]);if(a)for(var r of a(e))c.call(e,r)&&u(t,r,e[r]);return t};const h=t=>void 0===t,f=t=>Array.isArray(t),d=t=>t&&"number"==typeof t.size&&"string"==typeof t.type&&"function"==typeof t.slice,p=(t,e,r,n)=>((e=e||{}).indices=!h(e.indices)&&e.indices,e.nullsAsUndefineds=!h(e.nullsAsUndefineds)&&e.nullsAsUndefineds,e.booleansAsIntegers=!h(e.booleansAsIntegers)&&e.booleansAsIntegers,e.allowEmptyArrays=!h(e.allowEmptyArrays)&&e.allowEmptyArrays,r=r||new FormData,h(t)||(null===t?e.nullsAsUndefineds||r.append(n,""):(t=>"boolean"==typeof t)(t)?e.booleansAsIntegers?r.append(n,t?1:0):r.append(n,t):f(t)?t.length?t.forEach(((t,o)=>{const s=n+"["+(e.indices?o:"")+"]";p(t,e,r,s)})):e.allowEmptyArrays&&r.append(n+"[]",""):(t=>t instanceof Date)(t)?r.append(n,t.toISOString()):!(t=>t===Object(t))(t)||(t=>d(t)&&"string"==typeof t.name&&("object"==typeof t.lastModifiedDate||"number"==typeof t.lastModified))(t)||d(t)?r.append(n,t):Object.keys(t).forEach((o=>{const s=t[o];if(f(s))for(;o.length>2&&o.lastIndexOf("[]")===o.length-2;)o=o.substring(0,o.length-2);p(s,e,r,n?n+"["+o+"]":o)}))),r);var y={serialize:p};function m(t){if(null===t||"object"!=typeof t)return t;const e=Array.isArray(t)?[]:{};return Object.keys(t).forEach((r=>{e[r]=m(t[r])})),e}function g(t){return Array.isArray(t)?t:[t]}function v(t){return t instanceof File||t instanceof Blob||t instanceof FileList||"object"==typeof t&&null!==t&&void 0!==Object.values(t).find((t=>v(t)))}class b{constructor(){this.errors={},this.errors={}}set(t,e){"object"==typeof t?this.errors=t:this.set(l(l({},this.errors),{[t]:g(e)}))}all(){return this.errors}has(t){return Object.prototype.hasOwnProperty.call(this.errors,t)}hasAny(...t){return t.some((t=>this.has(t)))}any(){return Object.keys(this.errors).length>0}get(t){if(this.has(t))return this.getAll(t)[0]}getAll(t){return g(this.errors[t]||[])}only(...t){const e=[];return t.forEach((t=>{const r=this.get(t);r&&e.push(r)})),e}flatten(){return Object.values(this.errors).reduce(((t,e)=>t.concat(e)),[])}clear(t){const e={};t&&Object.keys(this.errors).forEach((r=>{r!==t&&(e[r]=this.errors[r])})),this.set(e)}}class w{constructor(t={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new b,this.progress=void 0,this.update(t)}static make(t){return new this(t)}update(t){this.originalData=Object.assign({},this.originalData,m(t)),Object.assign(this,t)}fill(t={}){this.keys().forEach((e=>{this[e]=t[e]}))}data(){return this.keys().reduce(((t,e)=>l(l({},t),{[e]:this[e]})),{})}keys(){return Object.keys(this).filter((t=>!w.ignore.includes(t)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),w.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((t=>!w.ignore.includes(t))).forEach((t=>{this[t]=m(this.originalData[t])}))}get(t,e={}){return this.submit("get",t,e)}post(t,e={}){return this.submit("post",t,e)}patch(t,e={}){return this.submit("patch",t,e)}put(t,e={}){return this.submit("put",t,e)}delete(t,e={}){return this.submit("delete",t,e)}submit(t,e,r={}){return this.startProcessing(),r=l({data:{},params:{},url:this.route(e),method:t,onUploadProgress:this.handleUploadProgress.bind(this)},r),"get"===t.toLowerCase()?r.params=l(l({},this.data()),r.params):(r.data=l(l({},this.data()),r.data),v(r.data)&&!r.transformRequest&&(r.transformRequest=[t=>y.serialize(t)])),new Promise(((t,e)=>{(w.axios||o()).request(r).then((e=>{this.finishProcessing(),t(e)})).catch((t=>{this.handleErrors(t),e(t)}))}))}handleErrors(t){this.busy=!1,this.progress=void 0,t.response&&this.errors.set(this.extractErrors(t.response))}extractErrors(t){return t.data&&"object"==typeof t.data?t.data.errors?l({},t.data.errors):t.data.message?{error:t.data.message}:l({},t.data):{error:w.errorMessage}}handleUploadProgress(t){this.progress={total:t.total,loaded:t.loaded,percentage:Math.round(100*t.loaded/t.total)}}route(t,e={}){let r=t;return Object.prototype.hasOwnProperty.call(w.routes,t)&&(r=decodeURI(w.routes[t])),"object"!=typeof e&&(e={id:e}),Object.keys(e).forEach((t=>{r=r.replace(`{${t}}`,e[t])})),r}onKeydown(t){const e=t.target;e.name&&this.errors.clear(e.name)}}w.routes={},w.errorMessage="Something went wrong. Please try again.",w.recentlySuccessfulTimeout=2e3,w.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const x=w},8933:(t,e,r)=>{r.r(e),r.d(e,{default:()=>f});var n=r(8181),o=r(9427),s=r(5714),i=r(821);function a(t){return a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},a(t)}function c(){c=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},o="function"==typeof Symbol?Symbol:{},s=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",u=o.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function h(t,e,r,o){var s=e&&e.prototype instanceof p?e:p,i=Object.create(s.prototype),a=new k(o||[]);return n(i,"_invoke",{value:E(t,r,a)}),i}function f(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=h;var d={};function p(){}function y(){}function m(){}var g={};l(g,s,(function(){return this}));var v=Object.getPrototypeOf,b=v&&v(v(S([])));b&&b!==e&&r.call(b,s)&&(g=b);var w=m.prototype=p.prototype=Object.create(g);function x(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function L(t,e){function o(n,s,i,c){var u=f(t[n],t,s);if("throw"!==u.type){var l=u.arg,h=l.value;return h&&"object"==a(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){o("next",t,i,c)}),(function(t){o("throw",t,i,c)})):e.resolve(h).then((function(t){l.value=t,i(l)}),(function(t){return o("throw",t,i,c)}))}c(u.arg)}var s;n(this,"_invoke",{value:function(t,r){function n(){return new e((function(e,n){o(t,r,e,n)}))}return s=s?s.then(n,n):n()}})}function E(t,e,r){var n="suspendedStart";return function(o,s){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw s;return P()}for(r.method=o,r.arg=s;;){var i=r.delegate;if(i){var a=O(i,r);if(a){if(a===d)continue;return a}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=f(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===d)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}function O(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,O(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var n=f(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,d;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,d):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function j(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function _(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(j,this),this.reset(!0)}function S(t){if(t){var e=t[s];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:P}}function P(){return{value:void 0,done:!0}}return y.prototype=m,n(w,"constructor",{value:m,configurable:!0}),n(m,"constructor",{value:y,configurable:!0}),y.displayName=l(m,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===y||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,l(t,u,"GeneratorFunction")),t.prototype=Object.create(w),t},t.awrap=function(t){return{__await:t}},x(L.prototype),l(L.prototype,i,(function(){return this})),t.AsyncIterator=L,t.async=function(e,r,n,o,s){void 0===s&&(s=Promise);var i=new L(h(e,r,n,o),s);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},x(w),l(w,u,"Generator"),l(w,s,(function(){return this})),l(w,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=S,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(_),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var s=this.tryEntries[o],i=s.completion;if("root"===s.tryLoc)return n("end");if(s.tryLoc<=this.prev){var a=r.call(s,"catchLoc"),c=r.call(s,"finallyLoc");if(a&&c){if(this.prev<s.catchLoc)return n(s.catchLoc,!0);if(this.prev<s.finallyLoc)return n(s.finallyLoc)}else if(a){if(this.prev<s.catchLoc)return n(s.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return n(s.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var s=o;break}}s&&("break"===t||"continue"===t)&&s.tryLoc<=e&&e<=s.finallyLoc&&(s=null);var i=s?s.completion:{};return i.type=t,i.arg=e,s?(this.method="next",this.next=s.finallyLoc,d):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),_(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;_(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:S(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),d}},t}function u(t,e,r,n,o,s,i){try{var a=t[s](i),c=a.value}catch(t){return void r(t)}a.done?e(c):Promise.resolve(c).then(n,o)}const l={components:{Notification:n.Z,NLInput:o.Z,NLButton:i.Z},layout:"auth",middleware:"guest",metaInfo:function(){return{title:this.$t("login")}},data:function(){return{form:new s.ZP({authLogin:null,password:null}),remember:!1}},methods:{getLoginName:function(t){return t.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)?"email":"username"},login:function(){var t,e=this;return(t=c().mark((function t(){var r,n;return c().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.form.post("/api/login");case 2:return r=t.sent,n=r.data,e.$store.dispatch("auth/saveToken",{token:n.token,remember:e.remember}),t.next=7,e.$store.dispatch("auth/fetchUser");case 7:e.redirect();case 8:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(n,o){var s=t.apply(e,r);function i(t){u(s,n,o,i,a,"next",t)}function a(t){u(s,n,o,i,a,"throw",t)}i(void 0)}))})()},redirect:function(){this.$router.push({name:"home"})}}},h=l;const f=(0,r(1900).Z)(h,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"box auth-box grid gap-6"},[t._m(0),t._v(" "),e("div",{staticClass:"col-12 form-container container"},[e("form",{attrs:{method:"POST"},on:{submit:function(e){return e.preventDefault(),t.login.apply(null,arguments)},keydown:function(e){return t.form.onKeydown(e)}}},[e("div",{staticClass:"grid gap-2 my-2"},[e("div",{staticClass:"col-12"},[e("NLInput",{staticClass:"is-for-auth",attrs:{name:"authLogin",placeholder:"Email / Username",form:t.form},model:{value:t.form.authLogin,callback:function(e){t.$set(t.form,"authLogin",e)},expression:"form.authLogin"}})],1),t._v(" "),e("div",{staticClass:"col-12"},[e("NLInput",{staticClass:"is-for-auth",attrs:{name:"password",placeholder:"Password",form:t.form,type:"password"},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}})],1)]),t._v(" "),e("div",{staticClass:"d-flex justify-center align-center"},[e("NLButton",{staticClass:"is-radius d-block w-100",attrs:{loading:t.form.busy,label:"login"}})],1)])]),t._v(" "),t._m(1)])}),[function(){var t=this,e=t._self._c;return e("div",{staticClass:"col-12 auth-box__header"},[e("img",{staticClass:"auth-brand",attrs:{src:"/images/brand.svg"}}),t._v(" "),e("span",{staticClass:"auth-box__title"},[t._v("\n      S'identifier\n      "),e("br"),t._v("\n      à votre compte\n    ")])])},function(){var t=this._self._c;return t("div",{staticClass:"col-12 text-center d-block d-lg-none"},[t("p",{},[this._v("\n      © 2022 - Tous droits réservés - DCP 104\n    ")])])}],!1,null,null,null).exports}}]);
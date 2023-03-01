"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2367],{5714:(e,t,s)=>{s.d(t,{ZP:()=>w,l0:()=>j});var r=s(9669),n=s.n(r),o=Object.defineProperty,i=Object.prototype.hasOwnProperty,a=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?o(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,u=(e,t)=>{for(var s in t||(t={}))i.call(t,s)&&c(e,s,t[s]);if(a)for(var s of a(t))l.call(t,s)&&c(e,s,t[s]);return e};const d=e=>void 0===e,f=e=>Array.isArray(e),m=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,h=(e,t,s,r)=>((t=t||{}).indices=!d(t.indices)&&t.indices,t.nullsAsUndefineds=!d(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!d(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!d(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,d(e)||(null===e?t.nullsAsUndefineds||s.append(r,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(r,e?1:0):s.append(r,e):f(e)?e.length?e.forEach(((e,n)=>{const o=r+"["+(t.indices?n:"")+"]";h(e,t,s,o)})):t.allowEmptyArrays&&s.append(r+"[]",""):(e=>e instanceof Date)(e)?s.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>m(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||m(e)?s.append(r,e):Object.keys(e).forEach((n=>{const o=e[n];if(f(o))for(;n.length>2&&n.lastIndexOf("[]")===n.length-2;)n=n.substring(0,n.length-2);h(o,t,s,r?r+"["+n+"]":n)}))),s);var p={serialize:h};function y(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=y(e[s])})),t}function g(e){return Array.isArray(e)?e:[e]}function b(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>b(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:g(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return g(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class j{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,y(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!j.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),j.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!j.ignore.includes(e))).forEach((e=>{this[e]=y(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),b(s.data)&&!s.transformRequest&&(s.transformRequest=[e=>p.serialize(e)])),new Promise(((e,t)=>{(j.axios||n()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:j.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(j.routes,e)&&(s=decodeURI(j.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}j.routes={},j.errorMessage="Something went wrong. Please try again.",j.recentlySuccessfulTimeout=2e3,j.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const w=j},2367:(e,t,s)=>{s.r(t),s.d(t,{default:()=>a});var r=s(98),n=s(629),o=s(5714);const i={components:{NLSelect:r.Z},layout:"backend",middleware:["auth"],metaInfo:function(){return{title:"Edition mission de contrôle"}},breadcrumb:function(){var e,t;return{label:"Edition mission "+(null===(e=this.mission)||void 0===e||null===(t=e.current)||void 0===t?void 0:t.reference)}},data:function(){return{form:new o.ZP({note:null,start:null,end:null,agency:null,campaign:null,controllers:null}),controllersList:[]}},computed:(0,n.Se)({config:"missions/config",mission:"missions/current"}),created:function(){this.initData()},methods:{initData:function(){var e=this;this.$store.dispatch("missions/fetch",{missionId:this.$route.params.missionId,edit:!0}).then((function(){e.mission.current.remaining_days_before_start>5&&(e.$store.dispatch("missions/fetchConfig",e.mission.current.campaign.id).then((function(){e.controllersList=e.config.config.controllers})),e.form.agency=e.mission.current.agency.name,e.form.campaign=e.mission.current.campaign.reference,e.form.controllers=e.mission.current.controllers.map((function(e){return e.id})),e.form.start=e.mission.current.start.split("-").reverse().join("-"),e.form.end=e.mission.current.end.split("-").reverse().join("-"),e.form.note=e.mission.current.note)})).catch((function(t){e.$router.push({name:"missions"})}))},update:function(){this.form.put("/api/missions/"+this.mission.current.id).then((function(e){e.data.status?swal.toast_success(e.data.message):swal.alert_error(e.data.message)})).catch((function(e){swal.alert_status(e)}))}}};const a=(0,s(1900).Z)(i,(function(){var e,t,s=this,r=s._self._c;return(null===(e=s.mission)||void 0===e||null===(t=e.current)||void 0===t?void 0:t.remaining_days_before_start)>5?r("ContentBody",{directives:[{name:"can",rawName:"v-can",value:"edit_mission",expression:"'edit_mission'"}]},[r("form",{on:{submit:function(e){return e.preventDefault(),s.update.apply(null,arguments)},keydown:function(e){return s.form.onKeydown(e)}}},[r("div",{staticClass:"grid my-2"},[r("div",{staticClass:"col-12 col-lg-6"},[r("NLInput",{attrs:{name:"campaign",label:"Campagne de contrôle",readonly:""},model:{value:s.form.campaign,callback:function(e){s.$set(s.form,"campaign",e)},expression:"form.campaign"}})],1),s._v(" "),r("div",{staticClass:"col-12 col-lg-6"},[r("NLInput",{attrs:{name:"agency",label:"Agences",readonly:""},model:{value:s.form.agency,callback:function(e){s.$set(s.form,"agency",e)},expression:"form.agency"}})],1),s._v(" "),r("div",{staticClass:"col-12"},[r("NLSelect",{attrs:{name:"controllers",label:"Contrôleurs",placeholder:"Veuillez choisir un ou plusieurs contrôleurs",options:s.controllersList,form:s.form,labelRequired:"",multiple:!0,loadingText:"Chargement de la liste des contrôleurs en cours",noOptionsText:"Vous n'avez aucun contrôleur de disponible pour le moment"},model:{value:s.form.controllers,callback:function(e){s.$set(s.form,"controllers",e)},expression:"form.controllers"}})],1),s._v(" "),r("div",{staticClass:"col-12 col-lg-6 col-tablet-6"},[r("NLInput",{attrs:{form:s.form,name:"start",label:"Date début",type:"date",labelRequired:""},model:{value:s.form.start,callback:function(e){s.$set(s.form,"start",e)},expression:"form.start"}})],1),s._v(" "),r("div",{staticClass:"col-12 col-lg-6 col-tablet-6"},[r("NLInput",{attrs:{form:s.form,name:"end",label:"Date fin",type:"date",labelRequired:""},model:{value:s.form.end,callback:function(e){s.$set(s.form,"end",e)},expression:"form.end"}})],1),s._v(" "),r("div",{staticClass:"col-12"},[r("NLTextarea",{attrs:{form:s.form,name:"note",label:"Note",placeholder:"Ajouter une note"},model:{value:s.form.note,callback:function(e){s.$set(s.form,"note",e)},expression:"form.note"}})],1)]),s._v(" "),r("div",{staticClass:"d-flex justify-end align-center"},[r("NLButton",{staticClass:"is-radius",attrs:{loading:s.form.busy,label:"Update"}})],1)])]):s._e()}),[],!1,null,null,null).exports}}]);
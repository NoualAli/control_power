"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[8435],{5714:(e,t,l)=>{l.d(t,{ZP:()=>j,l0:()=>_});var s=l(9669),r=l.n(s),o=Object.defineProperty,a=Object.prototype.hasOwnProperty,i=Object.getOwnPropertySymbols,n=Object.prototype.propertyIsEnumerable,c=(e,t,l)=>t in e?o(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l,d=(e,t)=>{for(var l in t||(t={}))a.call(t,l)&&c(e,l,t[l]);if(i)for(var l of i(t))n.call(t,l)&&c(e,l,t[l]);return e};const u=e=>void 0===e,m=e=>Array.isArray(e),f=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,p=(e,t,l,s)=>((t=t||{}).indices=!u(t.indices)&&t.indices,t.nullsAsUndefineds=!u(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!u(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!u(t.allowEmptyArrays)&&t.allowEmptyArrays,l=l||new FormData,u(e)||(null===e?t.nullsAsUndefineds||l.append(s,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?l.append(s,e?1:0):l.append(s,e):m(e)?e.length?e.forEach(((e,r)=>{const o=s+"["+(t.indices?r:"")+"]";p(e,t,l,o)})):t.allowEmptyArrays&&l.append(s+"[]",""):(e=>e instanceof Date)(e)?l.append(s,e.toISOString()):!(e=>e===Object(e))(e)||(e=>f(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||f(e)?l.append(s,e):Object.keys(e).forEach((r=>{const o=e[r];if(m(o))for(;r.length>2&&r.lastIndexOf("[]")===r.length-2;)r=r.substring(0,r.length-2);p(o,t,l,s?s+"["+r+"]":r)}))),l);var h={serialize:p};function b(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((l=>{t[l]=b(e[l])})),t}function y(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(d(d({},this.errors),{[e]:y(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return y(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const l=this.get(e);l&&t.push(l)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((l=>{l!==e&&(t[l]=this.errors[l])})),this.set(t)}}class _{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,b(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>d(d({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!_.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),_.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!_.ignore.includes(e))).forEach((e=>{this[e]=b(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,l={}){return this.startProcessing(),l=d({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},l),"get"===e.toLowerCase()?l.params=d(d({},this.data()),l.params):(l.data=d(d({},this.data()),l.data),g(l.data)&&!l.transformRequest&&(l.transformRequest=[e=>h.serialize(e)])),new Promise(((e,t)=>{(_.axios||r()).request(l).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?d({},e.data.errors):e.data.message?{error:e.data.message}:d({},e.data):{error:_.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let l=e;return Object.prototype.hasOwnProperty.call(_.routes,e)&&(l=decodeURI(_.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{l=l.replace(`{${e}}`,t[e])})),l}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}_.routes={},_.errorMessage="Something went wrong. Please try again.",_.recentlySuccessfulTimeout=2e3,_.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const j=_},8435:(e,t,l)=>{l.r(t),l.d(t,{default:()=>n});var s=l(5714);function r(e){return r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r(e)}function o(e,t){var l=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),l.push.apply(l,s)}return l}function a(e,t,l){return(t=function(e){var t=function(e,t){if("object"!==r(e)||null===e)return e;var l=e[Symbol.toPrimitive];if(void 0!==l){var s=l.call(e,t||"default");if("object"!==r(s))return s;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(e,"string");return"symbol"===r(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:l,enumerable:!0,configurable:!0,writable:!0}):e[t]=l,e}const i={middleware:["auth","admin"],layout:"backend",computed:function(e){for(var t=1;t<arguments.length;t++){var l=null!=arguments[t]?arguments[t]:{};t%2?o(Object(l),!0).forEach((function(t){a(e,t,l[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(l)):o(Object(l)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(l,t))}))}return e}({},(0,l(629).Se)({familly:"famillies/domains",domain:"domains/processes",famillies:"famillies/all",controlPoint:"controlPoints/current",validationRules:"settings/validationRules"})),watch:{"form.familly_id":function(e,t){e!==t&&this.loadDomains(e)},"form.domain_id":function(e,t){e!==t&&this.loadProcesses(e)}},created:function(){this.initData()},data:function(){return{familliesList:[],domainsList:[],processesList:[],validationRulesList:[],majorFactTypesSchema:[{type:"text",label:"Type",name:"type",placeholder:"Veuillez saisir le type",required:!0,style:"col-12"}],scoresSchema:[{type:"number",label:"Note",name:"score",placeholder:"Veuillez saisir la note",required:!0,style:"col-12 col-lg-6"},{type:"text",label:"Label",name:"label",placeholder:"Veuillez saisir le label à afficher",required:!0,style:"col-12 col-lg-6"}],fieldsSchema:[{type:"select",label:"Type",name:"type",required:!0,style:"col-12 col-lg-3",options:[{id:"text",label:"Text"},{id:"textarea",label:"Textarea"},{id:"number",label:"Number"},{id:"select",label:"Select"},{id:"date",label:"Date"},{id:"datetime",label:"DateTime"},{id:"month",label:"Month"},{id:"week",label:"Week"},{id:"time",label:"Time"},{id:"email",label:"Email"},{id:"tel",label:"Tel"}]},{type:"text",label:"Label",name:"label",placeholder:"Veuillez saisir le label du champs",required:!0,style:"col-12 col-lg-3"},{type:"text",label:"Nom",name:"name",placeholder:"Veuillez saisir le nom du champs dans la base de données",required:!0,style:"col-12 col-lg-3"},{type:"number",label:"Taille",name:"length",placeholder:"Veuillez saisir la taille du champs dans la base de données",required:!0,default:255,style:"col-12 col-lg-3"},{type:"select",label:"Nombre de colonnes",name:"style",required:!0,style:"col-12 col-lg-3",options:[{id:"col-12 col-lg-1",label:"1"},{id:"col-12 col-lg-2",label:"2"},{id:"col-12 col-lg-3",label:"3"},{id:"col-12 col-lg-4",label:"4"},{id:"col-12 col-lg-5",label:"5"},{id:"col-12 col-lg-6",label:"6"},{id:"col-12 col-lg-7",label:"7"},{id:"col-12 col-lg-8",label:"8"},{id:"col-12 col-lg-9",label:"9"},{id:"col-12 col-lg-10",label:"10"},{id:"col-12 col-lg-11",label:"11"},{id:"col-12 col-lg-12",label:"12"}]},{type:"text",label:"Identifiant",name:"id",placeholder:"Veuillez saisir l'identifiant du champs",style:"col-12 col-lg-3"},{type:"text",label:"Placeholder",name:"placeholder",placeholder:"Veuillez saisir le placeholder du champs",style:"col-12 col-lg-3"},{type:"text",label:"Texte d'aide",name:"help_text",placeholder:"Veuillez saisir le texte d'aide du champs",style:"col-12 col-lg-3"},{type:"select",label:"Règles de validation",name:"rules",required:!0,style:"col-12",multiple:!0,placeholder:"Veuillez choisir une ou plusieurs règles de validation",options:[{id:"nullable",label:"Facultatif"},{id:"required",label:"Obligatoire"},{id:"distinct",label:"Distinct"},{id:"email",label:"Adresse e-mail"},{id:"integer",label:"Nombre entier"},{id:"float",label:"Nombre flottant"},{id:"boolean",label:"Booléen"}]}],form:new s.l0({name:null,familly_id:null,domain_id:null,process_id:null,major_fact_types:[],has_major_fact:!1,scores:[],fields:[]})}},methods:{initData:function(){var e=this;this.$store.dispatch("controlPoints/fetch",this.$route.params.controlPoint).then((function(){e.loadFamillies(),e.loadValidationRules(),e.form.name=e.controlPoint.current.name,e.form.familly_id=e.controlPoint.current.familly.id,e.form.domain_id=e.controlPoint.current.domain.id,e.form.process_id=e.controlPoint.current.process.id,e.form.has_major_fact=e.controlPoint.current.has_major_fact,e.form.scores=e.controlPoint.current.scores?e.controlPoint.current.scores:[],e.form.fields=e.controlPoint.current.fields?e.controlPoint.current.fields:[],e.form.major_fact_types=e.controlPoint.current.major_fact_types?e.controlPoint.current.major_fact_types:[]}))},loadFamillies:function(){var e=this;this.$store.dispatch("famillies/fetchAll",!1).then((function(){e.familliesList=e.famillies.all,e.loadDomains(e.form.familly_id),e.loadProcesses(e.form.domain_id)}))},loadDomains:function(e){var t=this;e?this.$store.dispatch("famillies/fetch",{id:e,onlyDomains:!0}).then((function(){t.domainsList=t.familly.domains})):this.domainsList=[]},loadProcesses:function(e){var t=this;e?this.$store.dispatch("domains/fetch",{id:e,onlyProcesses:!0}).then((function(){t.processesList=t.domain.processes})):this.processesList=[]},loadValidationRules:function(){this.validationRulesList=[{id:"nullable",label:"Facultatif"},{id:"required",label:"Obligatoire"},{id:"distinct",label:"Distinct"},{id:"email",label:"Adresse e-mail"},{id:"integer",label:"Nombre entier"},{id:"float",label:"Nombre flottant"},{id:"boolean",label:"Booléen"}]},update:function(){var e=this;this.form.put("/api/control-points/"+this.$route.params.controlPoint).then((function(t){t.data.status?(swal.toast_success(t.data.message),e.$router.push({name:"control-points-index"})):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const n=(0,l(1900).Z)(i,(function(){var e=this,t=e._self._c;return e.can("edit_control_point")?t("div",[t("ContentBody",[t("form",{on:{submit:function(t){return t.preventDefault(),e.update.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[t("div",{staticClass:"grid gap-10 my-4"},[t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"familly_id",label:"Famille",options:e.familliesList,labelRequired:"",multiple:!1},model:{value:e.form.familly_id,callback:function(t){e.$set(e.form,"familly_id",t)},expression:"form.familly_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"domain_id",label:"Domaine",options:e.domainsList,labelRequired:"",multiple:!1},model:{value:e.form.domain_id,callback:function(t){e.$set(e.form,"domain_id",t)},expression:"form.domain_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"process_id",label:"Processus",options:e.processesList,labelRequired:"",multiple:!1},model:{value:e.form.process_id,callback:function(t){e.$set(e.form,"process_id",t)},expression:"form.process_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{form:e.form,name:"name",label:"Name",labelRequired:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1),e._v(" "),t("div",{staticClass:"col-12"},[t("NLSwitch",{attrs:{name:"has_major_fact",form:e.form,label:"Fait majeur"},model:{value:e.form.has_major_fact,callback:function(t){e.$set(e.form,"has_major_fact",t)},expression:"form.has_major_fact"}})],1),e._v(" "),e.form.has_major_fact?t("div",{staticClass:"col-12"},[t("NLRepeater",{attrs:{name:"major_fact_types",rowSchema:e.majorFactTypesSchema,form:e.form,title:"Types des faits majeur",addButtonLabel:"Ajouter un type"}})],1):e._e(),e._v(" "),t("div",{staticClass:"col-12"},[t("NLRepeater",{attrs:{name:"scores",rowSchema:e.scoresSchema,form:e.form,title:"Notation",addButtonLabel:"Ajouter une notation"}})],1),e._v(" "),t("div",{staticClass:"col-12"},[t("NLRepeater",{attrs:{name:"fields",rowSchema:e.fieldsSchema,form:e.form,title:"Metadata",addButtonLabel:"Ajouter un champs"}})],1)]),e._v(" "),t("div",{staticClass:"d-flex justify-end align-center"},[t("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Update"}})],1)])])],1):e._e()}),[],!1,null,null,null).exports}}]);
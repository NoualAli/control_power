"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[455],{5714:(e,t,s)=>{s.d(t,{ZP:()=>j,l0:()=>O});var l=s(9669),i=s.n(l),a=Object.defineProperty,r=Object.prototype.hasOwnProperty,o=Object.getOwnPropertySymbols,n=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?a(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,d=(e,t)=>{for(var s in t||(t={}))r.call(t,s)&&c(e,s,t[s]);if(o)for(var s of o(t))n.call(t,s)&&c(e,s,t[s]);return e};const u=e=>void 0===e,m=e=>Array.isArray(e),h=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,f=(e,t,s,l)=>((t=t||{}).indices=!u(t.indices)&&t.indices,t.nullsAsUndefineds=!u(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!u(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!u(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,u(e)||(null===e?t.nullsAsUndefineds||s.append(l,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(l,e?1:0):s.append(l,e):m(e)?e.length?e.forEach(((e,i)=>{const a=l+"["+(t.indices?i:"")+"]";f(e,t,s,a)})):t.allowEmptyArrays&&s.append(l+"[]",""):(e=>e instanceof Date)(e)?s.append(l,e.toISOString()):!(e=>e===Object(e))(e)||(e=>h(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||h(e)?s.append(l,e):Object.keys(e).forEach((i=>{const a=e[i];if(m(a))for(;i.length>2&&i.lastIndexOf("[]")===i.length-2;)i=i.substring(0,i.length-2);f(a,t,s,l?l+"["+i+"]":i)}))),s);var p={serialize:f};function b(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=b(e[s])})),t}function y(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class v{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(d(d({},this.errors),{[e]:y(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return y(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class O{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new v,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,b(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>d(d({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!O.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),O.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!O.ignore.includes(e))).forEach((e=>{this[e]=b(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=d({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=d(d({},this.data()),s.params):(s.data=d(d({},this.data()),s.data),g(s.data)&&!s.transformRequest&&(s.transformRequest=[e=>p.serialize(e)])),new Promise(((e,t)=>{(O.axios||i()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?d({},e.data.errors):e.data.message?{error:e.data.message}:d({},e.data):{error:O.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(O.routes,e)&&(s=decodeURI(O.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}O.routes={},O.errorMessage="Something went wrong. Please try again.",O.recentlySuccessfulTimeout=2e3,O.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const j=O},9455:(e,t,s)=>{s.r(t),s.d(t,{default:()=>c});var l=s(9892),i=s(5714),a=s(629);function r(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);t&&(l=l.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,l)}return s}function o(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}const n={middleware:["auth","admin"],layout:"backend",components:{NLRepeater:l.Z},computed:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?r(Object(s),!0).forEach((function(t){o(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):r(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},(0,a.Se)({famillies:"famillies/all",familly:"famillies/domains",domain:"domains/processes",validationRules:"settings/validationRules"})),watch:{"form.familly_id":function(e,t){e!==t&&this.loadDomains(e)},"form.domain_id":function(e,t){e!==t&&this.loadProcesses(e)}},data:function(){return{familliesList:[],domainsList:[],processesList:[],validationRulesList:[],scoresSchema:[{type:"number",label:"Note",name:"score",placeholder:"Veuillez saisir la note",required:!0,style:"col-12 col-lg-6"},{type:"text",label:"Label",name:"label",placeholder:"Veuillez saisir le label à afficher",required:!0,style:"col-12 col-lg-6"}],fieldsSchema:[{type:"select",label:"Type",name:"type",required:!0,style:"col-12 col-lg-3",placeholder:"Veuillez choisir un type",options:[{id:"text",label:"Text"},{id:"textarea",label:"Textarea"},{id:"number",label:"Number"},{id:"select",label:"Select"},{id:"date",label:"Date"},{id:"datetime",label:"DateTime"},{id:"month",label:"Month"},{id:"week",label:"Week"},{id:"time",label:"Time"},{id:"email",label:"Email"},{id:"tel",label:"Tel"}]},{type:"text",label:"Label",name:"label",placeholder:"Veuillez saisir le label du champs",required:!0,style:"col-12 col-lg-3"},{type:"text",label:"Nom",name:"name",placeholder:"Veuillez saisir le nom du champs dans la base de données",required:!0,style:"col-12 col-lg-3"},{type:"number",label:"Taille",name:"length",placeholder:"Veuillez saisir la taille du champs dans la base de données",required:!0,default:255,style:"col-12 col-lg-3"},{type:"select",label:"Nombre de colonnes",name:"style",required:!0,style:"col-12 col-lg-3",placeholder:"Veuillez choisir le nombre de colonne",options:[{id:"col-12 col-lg-1",label:"1"},{id:"col-12 col-lg-2",label:"2"},{id:"col-12 col-lg-3",label:"3"},{id:"col-12 col-lg-4",label:"4"},{id:"col-12 col-lg-5",label:"5"},{id:"col-12 col-lg-6",label:"6"},{id:"col-12 col-lg-7",label:"7"},{id:"col-12 col-lg-8",label:"8"},{id:"col-12 col-lg-9",label:"9"},{id:"col-12 col-lg-10",label:"10"},{id:"col-12 col-lg-11",label:"11"},{id:"col-12 col-lg-12",label:"12"}]},{type:"text",label:"Identifiant",name:"id",placeholder:"Veuillez saisir l'identifiant du champs",style:"col-12 col-lg-3"},{type:"text",label:"Placeholder",name:"placeholder",placeholder:"Veuillez saisir le placeholder du champs",style:"col-12 col-lg-3"},{type:"text",label:"Texte d'aide",name:"help_text",placeholder:"Veuillez saisir le texte d'aide du champs",style:"col-12 col-lg-3"},{type:"select",label:"Règles de validation",name:"rules",required:!0,style:"col-12",multiple:!0,placeholder:"Veuillez choisir une ou plusieurs règles de validation"}],form:new i.l0({name:null,familly_id:null,domain_id:null,process_id:null,scores:[],fields:[]})}},created:function(){this.initData()},methods:{initData:function(){this.loadFamillies(),this.loadValidationRules()},loadFamillies:function(){var e=this;this.$store.dispatch("famillies/fetchAll").then((function(){e.familliesList=e.famillies.all}))},loadDomains:function(e){var t=this;e?this.$store.dispatch("famillies/fetch",{id:e,onlyDomains:!0}).then((function(){t.domainsList=t.familly.domains})):this.domainsList=[]},loadProcesses:function(e){var t=this;e?this.$store.dispatch("domains/fetch",{id:e,onlyProcesses:!0}).then((function(){t.processesList=t.domain.processes})):this.processesList=[]},loadValidationRules:function(){var e=this;this.$store.dispatch("settings/fetchValidationRules").then((function(){e.validationRulesList=e.validationRules.validationRules,e.fieldsSchema[e.fieldsSchema.length-1].options=e.validationRulesList}))},create:function(){var e=this;this.form.post("/api/control-points").then((function(t){t.data.status?(swal.toast_success(t.data.message),e.form.reset()):swal.alert_error(t.data.message)})).catch((function(e){console.log(e)}))}}};const c=(0,s(1900).Z)(n,(function(){var e=this,t=e._self._c;return t("div",{directives:[{name:"can",rawName:"v-can",value:"create_control_point",expression:"'create_control_point'"}]},[t("ContentHeader",{attrs:{title:"Ajouter une nouveau point de contrôle"}}),e._v(" "),t("ContentBody",[t("form",{on:{submit:function(t){return t.preventDefault(),e.create.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[t("div",{staticClass:"grid gap-10 my-4"},[t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"familly_id",label:"Famille",options:e.familliesList,labelRequired:"",multiple:!1},model:{value:e.form.familly_id,callback:function(t){e.$set(e.form,"familly_id",t)},expression:"form.familly_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"domain_id",label:"Domaine",options:e.domainsList,labelRequired:"",multiple:!1},model:{value:e.form.domain_id,callback:function(t){e.$set(e.form,"domain_id",t)},expression:"form.domain_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLSelect",{attrs:{form:e.form,name:"process_id",label:"Processus",options:e.processesList,labelRequired:"",multiple:!1},model:{value:e.form.process_id,callback:function(t){e.$set(e.form,"process_id",t)},expression:"form.process_id"}})],1),e._v(" "),t("div",{staticClass:"col-12 col-md-6"},[t("NLInput",{attrs:{form:e.form,name:"name",label:"Name",labelRequired:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1),e._v(" "),t("div",{staticClass:"col-12"},[t("NLRepeater",{attrs:{name:"scores",rowSchema:e.scoresSchema,form:e.form,title:"Notation",addButtonLabel:"Ajouter une notation"}})],1),e._v(" "),t("div",{staticClass:"col-12"},[t("NLRepeater",{attrs:{name:"fields",rowSchema:e.fieldsSchema,form:e.form,title:"Metadata",addButtonLabel:"Ajouter un champs"}})],1)]),e._v(" "),t("div",{staticClass:"d-flex justify-end align-center"},[t("NLButton",{staticClass:"is-radius",attrs:{loading:e.form.busy,label:"Add"}})],1)])])],1)}),[],!1,null,null,null).exports}}]);
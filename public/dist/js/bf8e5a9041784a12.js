"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2576],{2576:(t,e,n)=>{n.r(e),n.d(e,{default:()=>u});var i=n(6828),a=n(2904),s=n(629),l=n(7565);function o(t){return o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},o(t)}function r(t,e,n){return(e=function(t){var e=function(t,e){if("object"!==o(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var i=n.call(t,e||"default");if("object"!==o(i))return i;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"===o(e)?e:String(e)}(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const c={components:{ContentHeader:i.Z,ContentBody:a.Z},layout:"backend",middleware:["auth"],metaInfo:function(){return{title:"Suivi des réalisations des missions"}},data:function(){var t,e=this;return{rowSelected:null,campaignId:null,config:{data:null,columns:[{label:"CDC-ID",field:"campaign"},{label:"Référence",field:"reference"},{label:"Dre",field:"dre"},{label:"Agence",field:"agency"},{label:"Contrôle sur place par",field:"agency_controllers_str"},{label:"Date début",field:"start"},{label:"Date fin",field:"end"},{label:"Moyenne",field:"avg_score",hide:!(0,l.nu)(["dcp","cdcr","cc"]),methods:{style:function(t){var e=t.avg_score;return 1==e?"bg-success text-white text-bold":2==e?"bg-info text-white text-bold":3==e?"bg-warning text-bold":"bg-danger text-white text-bold"}}},{label:"État",field:"state",isHtml:!0,methods:{showField:function(t){var e="inProgress";return"EN COURS"==t.state?e="inProgress":"À RÉALISER"==t.state?e="todo":"RÉALISÉ"==t.state?e="done":"EN RETARD"==t.state?e="late":"Validé et envoyé"==t.state?e="validated":"En attente de validation"==t.state&&(e="wating-validation"),'<div class="container" title="'.concat(t.state,'">\n                  <div class="mission-state ').concat(e,'"></div>\n                </div>')}}},{label:"Taux de progression",field:"progress_status",methods:{showField:function(t){return t.progress_status+"%"}}}],actions:{show:function(t){return e.can("view_mission")},edit:function(t){return e.can("edit_mission")&&t.remaining_days_before_start>5},delete:function(t){return e.can("delete_mission")&&t.remaining_days_before_start>5}}},filters:{campaign:{label:"Campagne de contrôle",cols:"col-lg-3",multiple:!0,data:null,value:null},dre:{label:"DRE",cols:"col-lg-3",multiple:!0,data:null,value:null},agency:{label:"Agence",cols:"col-lg-3",multiple:!0,data:null,value:null},dre_controllers:{label:"Contrôleurs",cols:"col-lg-3",multiple:!0,data:null,value:null},between:(t={cols:"col-lg-3",value:[],type:"date-range"},r(t,"cols","col-lg-6"),r(t,"attributes",{start:{cols:"col-lg-6",label:"De",value:null},end:{cols:"col-lg-6",label:"À",value:null}}),t)}}},computed:(0,s.Se)({missions:"missions/paginated",filtersData:"missions/filters"}),created:function(){this.initFilters(),this.initData()},methods:{resetData:function(){this.initData()},initData:function(){var t=this;(this.$route.params.campaignId?this.$store.dispatch("missions/fetchPaginated",this.$route.params.campaignId):this.$store.dispatch("missions/fetchPaginated")).then((function(){return t.config.data=t.missions.paginated}))},initFilters:function(){var t=this;this.$store.dispatch("missions/fetchFilters").then((function(){t.filters.campaign.data=t.filtersData.filters.campaigns,t.filters.dre.data=t.filtersData.filters.dres,t.filters.agency.data=t.filtersData.filters.agencies,t.filters.dre_controllers.data=t.filtersData.filters.dre_controllers}))},show:function(t){this.$router.push({name:"mission",params:{missionId:t.id}})},edit:function(t){this.$router.push({name:"missions-edit",params:{missionId:t.id}})},destroy:function(t){var e=this;swal.confirm_destroy().then((function(n){n.isConfirmed&&api.delete("missions/"+t.id).then((function(t){t.data.status?(e.initData(),swal.toast_success(t.data.message)):swal.alert_error(t.data.message)})).catch((function(t){console.log(t)}))}))}}};const u=(0,n(1900).Z)(c,(function(){var t=this,e=t._self._c;return t.can("view_mission")?e("div",[t.campaignId?e("ContentHeader",{scopedSlots:t._u([{key:"actions",fn:function(){return[t.can("create_mission")?e("router-link",{staticClass:"btn btn-info",attrs:{to:{name:"missions-create",params:{campaignId:t.campaignId}}}},[t._v("\n        Ajouter\n      ")]):t._e()]},proxy:!0}],null,!1,188342256)}):t._e(),t._v(" "),e("ContentBody",[e("NLDatatable",{attrs:{filters:t.filters,namespace:"missions",config:t.config},on:{show:t.show,delete:t.destroy,edit:t.edit,filterReset:t.resetData}})],1)],1):t._e()}),[],!1,null,null,null).exports}}]);
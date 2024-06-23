<template>
    <NLSidebarItem label="Suivi des missions" route="missions" iconName="visibility" />
    <NLSidebarItem label="Etat des missions" route="missions-states" iconName="news" />
    <NLSidebarItem label="Plans de redressement" route="anomalies" iconPrefix="lab" iconName="breaking_news" />
</template>

<script>
import NLSidebarItem from '../../components/Sidebar/NLSidebarItem.vue'
export default {
    name: "DASidebar",
    components: { NLSidebarItem }
}
</script>

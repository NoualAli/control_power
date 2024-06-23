<template>
    <NLSidebarItem label="Planning annuel" route="campaigns" iconName="calendar_month" />
    <NLSidebarItem label="Suivi des missions" route="missions" iconName="visibility" />
    <NLSidebarItem label="Etat des missions" route="missions-states" iconName="news" />
    <NLSidebarItem label="Plans de redressement" route="anomalies" iconPrefix="lab" iconName="breaking_news" />
    <NLSidebarItem label="Faits majeurs" route="major-facts" iconName="brightness_alert" />
</template>

<script>
import NLSidebarItem from '../../components/Sidebar/NLSidebarItem.vue'
export default {
    name: "CISidebar",
    components: { NLSidebarItem }
}
</script>

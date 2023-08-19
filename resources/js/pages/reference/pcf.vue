<template>
    <ContentBody>
        <NLDatatable :columns="columns" :details="details" :filters="filters" title="Références PCF"
            urlPrefix="references/pcf" @action="handleActions" @show="handleActions"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />
    </ContentBody>
</template>
<script>
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            columns: [
                {
                    label: 'Famille',
                    field: 'family_name',
                    filterable: 'family_id',
                },
                {
                    label: 'Domaine',
                    field: 'domain_name',
                    filterable: 'domain_id',
                },
                {
                    label: 'Processus',
                    field: 'process_name',
                    filterable: 'process_id',
                },
                {
                    label: 'Point de contrôle',
                    field: 'control_point_name',
                    sortBy: 'name',
                    length: 75,
                    sortable: true
                }
            ],
            filters: {
                family: {
                    label: 'Famille',
                    name: 'family',
                    multiple: true,
                    data: null,
                    value: null
                },
                domain: {
                    label: 'Domaine',
                    name: 'domain',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'family'
                },
                process: {
                    label: 'Processus',
                    name: 'process',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'domain'
                }
            },
            details: [
                {
                    label: 'Famille',
                    field: 'family.name',
                },
                {
                    label: 'Domaine',
                    field: 'domain.name',
                },
                {
                    label: 'Processus',
                    field: 'process.name',
                },
                {
                    label: 'Point de contrôle',
                    field: 'name',
                },
                {
                    label: 'Notations',
                    field: 'scores_str',
                    isHtml: true,
                },
            ],
        }
    },
    methods: {
        handleActions(e) {
            console.log(e);
        }
    }
}
</script>

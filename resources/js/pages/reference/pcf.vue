<template>
    <ContentBody>
        <NLDatatable :columns="columns" :details="details" :filters="filters" title="Références PCF"
            urlPrefix="references/pcf" @action="handleActions" @show="handleActions" />
    </ContentBody>
</template>
<script>
import NLDatatable from '../../components/Datatable/NLDatatable'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            columns: [
                {
                    label: 'Famille',
                    field: 'familly_name',
                    filterable: 'familly_id',
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
                    dependsOn: 'familly'
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
                    field: 'familly.name',
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

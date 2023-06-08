<template>
    <div>
        <ContentHeader>
            <template #actions>
                <router-link :to="{ name: 'bugs-create' }" class="btn btn-info">
                    Signaler un bug
                </router-link>
            </template>
        </ContentHeader>

        <ContentBody>
            <NLDatatable :columns="columns" :details="details" :filters="filters" urlPrefix="bugs">
                <template #actions-before="{ item }">
                    <button class="btn btn-info" v-if="!item?.item?.fixed_at && is('root')">
                        <i class="las la-check-circle icon"></i>
                    </button>
                </template>
            </NLDatatable>
        </ContentBody>
    </div>
</template>

<script>
export default {
    middleware: [ 'auth' ],
    layout: 'MainLayout',
    data() {
        return {
            columns: [
                {
                    field: 'reference',
                    label: 'Référence',
                },
                {
                    field: 'type',
                    label: 'Type',
                },
                {
                    field: 'creator.full_name',
                    label: 'Initiateur',
                },
                {
                    field: 'priority_html',
                    label: 'Priorité',
                    isHtml: true,
                    align: 'center',
                },
                {
                    field: 'created_at',
                    label: 'Signaler le',
                },
                {
                    field: 'state',
                    label: 'Etat',
                },
            ],
            details: [
                {
                    field: 'description',
                    label: 'Description',
                    isHtml: true,
                },
                // {
                //     field: 'type',
                //     label: 'Type',
                // },
                // {
                //     field: 'creator.full_name',
                //     label: 'Initiateur',
                // },
                // {
                //     field: 'priority_html',
                //     label: 'Priorité',
                //     isHtml: true,
                //     align: 'center',
                // },
                // {
                //     field: 'created_at',
                //     label: 'Signaler le',
                // },
                // {
                //     field: 'state',
                //     label: 'Etat',
                // },
            ],
            filters: {

            }
        }
    }

}
</script>

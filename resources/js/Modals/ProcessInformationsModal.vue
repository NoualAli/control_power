<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <NLTooltip type="bottom">
                    <template #content>
                        <b>Famille</b>
                        <p class="mt-2">{{ currentProcess?.family?.name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="tenancy" /> {{ str_slice(currentProcess?.family?.name, 40) }}
                    </span>
                </NLTooltip>
                <NLTooltip type="bottom">
                    <template #content>
                        <b>Domaine</b>
                        <p class="mt-2">{{ currentProcess?.domain?.name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="network_node" /> {{ str_slice(currentProcess?.domain?.name, 40) }}
                    </span>
                </NLTooltip>
                <NLTooltip title="Processus" type="bottom">
                    <template #content>
                        <b>Processus</b>
                        <p class="mt-2">{{ currentProcess?.name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="account_tree" /> {{ str_slice(currentProcess?.name, 40) }}
                    </span>
                </NLTooltip>
            </div>
        </template>
        <template #default>
            <div class="content">
                <h2>
                    Points de contrôle
                </h2>
                <ul class="text-normal">
                    <li class="my-2" v-for="control_point in currentProcess?.control_points">
                        {{ control_point.name }}
                    </li>
                </ul>
                <NLGrid class="text-normal">
                    <NLColumn v-if="Object.values(currentProcess.formatted_media).length">
                        <h2>
                            Documentation
                        </h2>
                    </NLColumn>
                    <NLColumn v-for="(files, category) in currentProcess?.formatted_media">
                        <NLGrid gap="1">
                            <NLColumn>
                                <h3 class="my-2">{{ category }}</h3>
                            </NLColumn>
                            <NLColumn v-for="file in files">
                                <NLColumn class="text-bold">
                                    {{ file?.payload?.object }}
                                </NLColumn>
                                <NLColumn>
                                    <a :href="file.storage_link" target="_blank" class="text-dark"
                                        :download="file.original_name">
                                        <i class="icon" :class="file.icon"></i>
                                        {{ file.original_name }}
                                    </a>
                                </NLColumn>
                                <NLColumn class="divider"></NLColumn>
                            </NLColumn>
                        </NLGrid>
                    </NLColumn>
                </NLGrid>
            </div>
        </template>
    </NLModal>
</template>

<script>
import NLColumn from '../components/Grid/NLColumn'
import NLFlex from '../components/Grid/NLFlex'
export default {
    components: {
        NLColumn, NLFlex
    },
    name: 'ProcessInformationsModal',
    props: {
        process: { type: [ Object, null ], required: true },
        show: { type: Boolean, required: true, default: false }
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.currentProcess = null
                this.isLoading = false
            }
        }
    },
    data() {
        return {
            currentProcess: null,
            isLoading: true,
        }
    },
    methods: {
        close(forceReload = false) {
            this.currentProcess = null
            this.isLoading = false
            this.$emit('close', forceReload)
        },
        initData() {
            this.isLoading = true
            this.$api.get('processes/' + this.process.id).then(response => {
                this.currentProcess = response.data
                this.isLoading = false
            }).catch(error => {
                this.isLoading = false
                this.$swal.catchError(error)
            })
        }
    }
}
</script>

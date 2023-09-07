<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <span class="tag text-normal"><i class="las la-tag icon mr-1"></i> {{ currentProcess?.family?.name }}</span>
                <span class="tag text-normal"><i class="las la-tags icon mr-1"></i> {{ currentProcess?.domain?.name
                }}</span>
                <span class="tag text-normal"><i class="las la-project-diagram icon mr-1"></i> {{ currentProcess?.name
                }}</span>
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
                <h2>
                    Documentation
                </h2>
                <NLGrid class="text-normal">
                    <NLColumn v-for="file in currentProcess?.media">
                        <NLGrid gap="1">
                            <NLColumn class="text-bold">
                                {{ JSON.parse(file.payload).object }}
                            </NLColumn>
                            <NLColumn>
                                <a :href="file.link" target="_blank" class="text-dark">
                                    <i class="icon" :class="file.icon"></i>
                                    {{ file.original_name }}
                                </a>
                            </NLColumn>
                            <NLColumn class="divider"></NLColumn>
                        </NLGrid>
                    </NLColumn>
                </NLGrid>
            </div>
        </template>
    </NLModal>
</template>

<script>
export default {
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
                console.log(error);
                this.isLoading = false
            })
        }
    }
}
</script>

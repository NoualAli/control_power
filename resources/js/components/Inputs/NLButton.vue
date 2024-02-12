<template>
    <button class="btn" :class="[{ 'is-loading': loading }, finalType]" :disabled="loading">
        <NLFlex lgJustifyContent="start" gap="2" lgAlignItems="center" mdAlignItems="center" alignItems="center"
            v-if="!loading">
            <slot></slot>
            <span class="btn-text" v-if="!loading && label">
                {{ label }}
            </span>
        </NLFlex>
        <NLFlex lgJustifyContent="start" gap="2" lgAlignItems="center" mdAlignItems="center" alignItems="center"
            v-if="loading">
            <i class="las la-spinner la-spin icon"></i>
            <span class="btn-loader" v-if="loadingLabel?.length">{{ loadingLabel }}</span>
        </NLFlex>
    </button>
</template>

<script>
import NLFlex from '../Grid/NLFlex'
export default {
    components: { NLFlex },
    name: 'NLButton',
    props: {
        loading: { type: Boolean, default: false },
        label: { type: String, default: null },
        type: { type: String, default: null },
        loadingLabel: { type: String, default: 'Envoie en cours' }
    },
    computed: {
        finalType() {
            return this.type ? 'btn-' + this.type : null
        }
    }
}
</script>

<template>
    <button class="btn my-2" :class="[{ 'is-loading': loading }, finalType]" :disabled="loading">
        <span class="btn-loader">Envoie en cours</span>
        <span class="btn-text">
            {{ label }}
        </span>
    </button>
</template>

<script>
export default {
    name: 'NLButton',
    props: {
        loading: { type: Boolean, default: false },
        label: { type: String, default: 'Valider' },
        type: { type: String, default: '' }
    },
    computed: {
        finalType() {
            return this.type ? 'btn-' + this.type : null
        }
    }
}
</script>

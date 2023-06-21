<template>
    <Alert v-if="form.errors.any()" type="is-danger" :errorsCount="formErrorsCount" extraClass="mb-6">
        <ul v-for="error in form?.errors?.all()" v-if="formErrorsCount">
            <li v-for="item in error">{{ item }}</li>
        </ul>
        <p v-else>{{ form?.errors?.get('error') }}</p>
    </Alert>
    <form enctype="multipart/form-data" class="grid gap-6" @submit.prevent="action" @keydown="form.onKeydown($event)">
        <slot></slot>
    </form>
</template>

<script>
export default {
    name: 'NLForm',
    props: {
        action: { type: Function, required: true },
        form: { type: Object, required: true }
    },
    computed: {
        formErrorsCount() {
            return Object.entries(this.form.errors.all()).length
        },
    },
    methods: {
    }
}
</script>

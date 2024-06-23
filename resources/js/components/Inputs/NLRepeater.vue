<template>
    <div class="repeater">
        <h2 v-if="title" class="mb-6">
            {{ title }}
        </h2>
        <!-- Repeater row -->
        <div v-for="(item, index) in form[name]" :key="name + '-row-' + index" class="grid my-6 form-row">
            <div class="col-11">
                <div class="grid">
                    <div v-for="(input, id) in rowSchema" :key="name + '-input-' + input.name + '-' + index + '-id'"
                        class="col-12" :class="input.style">
                        <!-- Defining different inputs -->
                        <NLInput v-if="isInput(input.type)" :id="name + '-row-' + index + '-' + input.name"
                            v-model="form[name][index][id][input.name]" :form="form" :label="input.label"
                            :placeholder="input.placeholder" :type="input.type" :label-required="input.required"
                            :name="name + '.' + index + '.' + id + '.' + input.name" :readonly="readonly" />

                        <NLTextarea v-if="input.type == 'textarea'" :id="name + '-row-' + index + '-' + input.name"
                            v-model="form[name][index][id][input.name]" :form="form" :label="input.label"
                            :placeholder="input.placeholder" :label-required="input.required"
                            :name="name + '.' + index + '.' + id + '.' + input.name" :readonly="readonly" />

                        <NLWyswyg v-if="input.type == 'wyswyg'" :id="name + '-row-' + index + '-' + input.name"
                            v-model="form[name][index][id][input.name]" :form="form" :label="input.label"
                            :placeholder="input.placeholder" :label-required="input.required"
                            :name="name + '.' + index + '.' + id + '.' + input.name" :readonly="readonly" />

                        <NLSelect v-if="input.type == 'select'" :id="name + '.' + index + '.' + id + '.' + input.name"
                            v-model="form[name][index][id][input.name]" :label-required="input.required" :form="form"
                            :label="input.label" :name="name + '.' + index + '.' + id + '.' + input.name"
                            :options="input.options" :placeholder="input.placeholder || 'Choisissez une option...'"
                            :multiple="input.multiple" :readonly="readonly" />
                    </div>
                </div>
            </div>
            <!-- Remove current row -->
            <div v-if="index >= 0 && !readonly" class="col-1 p-0 d-flex justify-start align-center">
                <NLIcon name="delete" extraClass="text-danger is-clickable" @click="removeRow(index)" />
            </div>
        </div>

        <!-- Add new row -->
        <div class="d-flex justify-start align-center">
            <span class="btn" :class="{ addButtonStyle }" @click="addRow" v-if="!readonly">
                {{ addButtonLabel }}
            </span>
        </div>
        <has-error v-if="form" :form="form" :field="name" class="text-danger mt-5" />
    </div>
</template>

<script>
import NLIcon from '../NLIcon'
// import Treeselect from 'vue3-treeselect'
import NLSelect from './NLSelect'
import InputContainer from './InputContainer'
import NLInput from './NLInput'
import { readonly } from 'vue'
// import Treeselect from '@riophae/vue-treeselect'
export default {
    name: 'NLRepeater',
    components: {
        NLIcon,
        NLSelect,
        InputContainer,
        NLInput
        // , Treeselect
    },
    props: {
        addButtonLabel: { type: String, default: 'Ajouter une ligne' },
        addButtonStyle: { type: String, default: null },
        removeButtonLabel: { type: String, default: 'Supprimer' },
        removeButtonStyle: { type: String, default: null },
        name: { type: String },
        title: { type: String, default: null },
        form: { type: Object, required: false },
        rowSchema: { type: Array, required: true },
        readonly: { type: Boolean, default: false }
    },
    methods: {
        addRow() {
            const schema = []
            for (let index = 0; index < this.rowSchema.length; index++) {
                const element = this.rowSchema[ index ]
                const name = element.name
                let defaultValue = element.default !== undefined ? element.default : null
                defaultValue = element.multiple ? [] : null
                schema.push({ [ name ]: defaultValue, value: element.label })
            }
            if (this.form[ this.name ]) this.form[ this.name ].push(schema)
        },
        isInput(value) {
            return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
        },
        removeRow(index) {
            this.$swal.confirm_destroy('Êtes-vous sûr de vouloir supprimer cette ligne ?').then(action => {
                if (action.isConfirmed) {
                    this.form[ this.name ].splice(index, 1)
                }
            })
        }
    }
}
</script>

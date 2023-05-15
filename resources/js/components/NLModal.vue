<template>
    <div class="modal" @keyup.esc="close" :class="{ 'active': isOpen, 'reduced': isReduced, 'expanded': isExpanded }"
        tabindex="0">
        <div class="modal-overlay" @click.stop="(e) => close(e, true)"></div>
        <div class="modal-card">
            <header class="modal-header">
                <div class="grid w-100">
                    <div class="col-11">
                        <h3>
                            <slot name="title"></slot>
                        </h3>
                    </div>
                    <div class="col-1">
                        <div class="d-flex align-center justify-end gap-3">
                            <i class="las la-expand icon modal-action-icon" @click="handleExpansion" v-if="!isExpanded"
                                title="Agrandir"></i>
                            <i class="las la-compress icon modal-action-icon" @click="handleExpansion" v-else
                                title="Minimiser"></i>
                            <i class="las la-times icon modal-action-icon" @click="(e) => close(e, true)"
                                title="Fermer"></i>
                        </div>

                    </div>
                </div>
            </header>
            <main class="modal-body">
                <slot></slot>
            </main>
            <footer class="modal-footer">
                <slot name="footer"></slot>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NLModal',
    props: {
        show: { type: [ Boolean, Array, Object, null ], required: true },
        defaultMode: { type: Boolean, default: false }
    },
    data() {
        return {
            isExpanded: false,
            isReduced: false,
            showFooter: false
        }
    },
    computed: {
        isOpen() {
            return this.show
        }
    },
    watch: {
        show() {
            if (!this.show) {
                window.removeEventListener('keyup', this.close)
            } else {
                window.addEventListener('keyup', this.close)
            }
        }
    },
    created() {
        this.setShowSlots()
        this.isExpanded = this.defaultMode
    },
    beforeUpdate() {
        this.setShowSlots()
    },
    methods: {
        close(e, close = false) {
            if (e?.key === 'Escape' || close) {
                this.$emit('close')
            }
        },
        setShowSlots() {
            this.showFooter = this.$slots.footer
        },
        handleExpansion() {
            this.isExpanded = !this.isExpanded
        },
        handleReduce() {
            this.isReduced = !this.isReduced
        }
    }
}
</script>

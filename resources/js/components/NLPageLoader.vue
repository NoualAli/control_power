<template>
    <div class="page-loader-container" :class="{ 'is-active': isLoading }">
        <div class="page-loader">
            <!-- <i class="las la-landmark"></i> -->
            <NLIcon name="account_balance" />
        </div>
        <!-- <div class="page-loader-text">
            Chargement en cours
        </div> -->
    </div>
</template>

<script>
import NLIcon from './NLIcon'
export default {
    components: { NLIcon },
    name: 'NLComponentLoader',
    props: {
        isLoading: { type: Boolean, default: false }
    }
}
</script>

<template>
    <div class="container text-center d-flex full-center is-column">
        <img src="/storage/assets/404.svg" class="vh-lg-70 vh-50" alt="">
        <div class="links">
            <router-link :to="{ name: 'home' }" class="btn has-icon text-bold">
                <NLIcon name="arrow_back" />
                Retour à l'accueil
                <NLIcon name="home" />
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NotFound',
    layout: 'MainLayout',
    created() {
        this.$store.dispatch('settings/updatePageLoading', false)
    }
}
</script>

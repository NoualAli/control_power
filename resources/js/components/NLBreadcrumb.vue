<template>
    <nav v-if="routes && routes.length" class="nl-breadcrumb">
        <ol>
            <li v-for="(route, routeIndex) in routes" :key="routeIndex">
                <a v-if="routeIndex !== routes.length - 1" :href="route.path" :title="route.meta?.breadcrumb?.label"
                    class="bc-link">
                    {{ route.meta?.breadcrumb?.label }}
                </a>
                <span v-else class="bc-name">{{ route.meta?.breadcrumb?.label }}</span>
                <span v-if="routes[routeIndex + 1]" class="bc-separator">{{ separator }}</span>
            </li>
        </ol>
    </nav>
</template>

<script>
import { useRoute } from 'vue-router'
export default {
    props: {
        routes: { type: Array, required: true },
        separator: { type: String, default: '/' }
    },
    watch: {
        route(newVal, oldVal) {
            console.log(newVal, oldVal);
        }
    },
    data() {
        return {
            route: useRoute()
        }
    },
    // methods: {
    //     fetchCrumbs() {

    //     },
    //     fetchCrumb() {
    //         return this.routes.filter((route) => route.name == this.$router.currentRoute.value.name)[ 0 ]
    //     },
    //     fetchParentCrumbs(crumb) {
    //         return this.routes.filter((route) => route.name == crumb.name)[ 0 ]
    //     }
    // }
}
</script>

<style lang="scss" scoped>
.nl-breadcrumb {
    // background-color: #f7f7f7;
    // border-radius: 4px;

    ol,
    ul {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        padding: 7px 15px;
        color: #fcfcfc;

        li {
            color: #fcfcfc;

            .bc-link {
                font-weight: 600;
                text-decoration: none;
                transition: all 0.5s ease;
                color: #fcfcfc;

                &:hover {
                    color: blue;
                    text-decoration: underline;
                }
            }

            // .bc-name {

            // }
            .bc-separator {
                color: hsla(0, 0%, 13%, 0.563);
                margin: 0.3rem;
            }
        }
    }
}
</style>

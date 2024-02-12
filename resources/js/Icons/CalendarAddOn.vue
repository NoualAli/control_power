<template>
    <span v-bind="$attrs" :aria-hidden="!title" :aria-label="title" class="material-design-icon bus-school-icon" role="img"
        @click="$emit('click', $event)">
        <svg :fill="fillColor" class="material-design-icon__svg" :width="size" :height="size" viewBox="0 0 24 24">
            <path
                d="M3,6C1.89,6 1,6.89 1,8V15H3A3,3 0 0,0 6,18A3,3 0 0,0 9,15H15A3,3 0 0,0 18,18A3,3 0 0,0 21,15H23V12C23,10.89 22.11,10 21,10H19V8C19,6.89 18.11,6 17,6H3M13.5,7.5H17.5V10H13.5V7.5M2.5,7.5H6.5V10H2.5V7.5M8,7.5H12V10H8V7.5M6,13.5A1.5,1.5 0 0,1 7.5,15A1.5,1.5 0 0,1 6,16.5A1.5,1.5 0 0,1 4.5,15A1.5,1.5 0 0,1 6,13.5M18,13.5A1.5,1.5 0 0,1 19.5,15A1.5,1.5 0 0,1 18,16.5A1.5,1.5 0 0,1 16.5,15A1.5,1.5 0 0,1 18,13.5Z">
                <title v-if="title">{{ title }}</title>
            </path>
        </svg>
    </span>
    <IconContainer>
        <svg xmlns="http://www.w3.org/2000/svg" class="material-design-icon__svg" :fill="fillColor" :height="size"
            viewBox="0 -960 960 960" :width="size">
            <path
                d="M680-80v-120H560v-80h120v-120h80v120h120v80H760v120h-80Zm-480-80q-33 0-56.5-23.5T120-240v-480q0-33 23.5-56.5T200-800h40v-80h80v80h240v-80h80v80h40q33 0 56.5 23.5T760-720v244q-20-3-40-3t-40 3v-84H200v320h280q0 20 3 40t11 40H200Zm0-480h480v-80H200v80Zm0 0v-80 80Z" />
        </svg>
    </IconContainer>
</template>

<script>
import IconContainer from './IconContainer'
import IconContainer from './IconContainer.vue';
export default {
    components: { IconContainer },
    name: "BusSchoolIcon",
    emits: [ 'click' ],
    props: {
        fillColor: {
            type: String,
            default: "currentColor"
        },
        size: {
            type: Number,
            default: 24
        }
    }
}
</script>

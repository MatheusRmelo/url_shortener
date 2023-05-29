<template>
    <div class="link-card">
        <Dots />
        <div class="content">
            <h3 class="title">{{ link.title }}</h3>
            <small class="link">{{ `${baseRedirect}${link.slug}`}}</small>
        </div>
        <div class="actions"></div>
    </div>
</template>
<script lang="ts">
import { PropType, defineComponent } from 'vue';
import Dots from './Dots.vue';
import Link from '../types/link';
import { baseRedirectLink } from '../constants';

export default defineComponent({
    name: "LinkCard",
    computed: {
        baseRedirect(){
            return baseRedirectLink;
        }
    },
    props: {
        link: {
            type: Object as PropType<Link>,
            required: true,
        }
    },
    components: { Dots }
})
</script>
<style scoped>
    .link-card {
        display: flex;
        align-items: center;

        width: 100%;
        height: 80px;

        background-color: var(--color-secondary);
        border-radius: 8px;
        margin-top: 16px;
        padding: 16px 32px;
    }
    .link-card .content {
        flex: 1;
        margin-left: 24px;
    }
</style>

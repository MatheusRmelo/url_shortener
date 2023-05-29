<template>
    <div class="stats-bar">
        <h3 class="title">DADOS</h3>
        <div class="items">
            <StatItem
                icon="isax-link"
                label="Links"
                :value="links.toString()"
            />
            <StatItem
                icon="isax-eye"
                label="Views"
                :value="views.toString()"
            />
            <StatItem
                icon="isax-mouse-circle"
                label="Cliques"
                :value="clicks.toString()"
            />
            <StatItem
                icon="isax-percentage-circle"
                label="Avg.CTR"
                :value="`${(clicks * 100) / views}%`"
            />
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import StatItem from './StatItem.vue';

export default defineComponent({
    name: "StatsBar",
    props: {
        links: {
            type: Number,
            default: 0
        },
        views: {
            type: Number,
            default: 0,
        },
        clicks: {
            type: Number,
            default: 0,
        }
    },
    components: { StatItem }
})
</script>
<style scoped>
    .stats-bar {
        display: flex;
        flex-direction: column;

        width: 100%;
        height: 50%;
    }
    .stats-bar > .title {
        font-size: 16px;
        font-weight: bold;
        color: var(--color-text-normal);
    }
    .stats-bar > .items {
        flex: 1;
        display: flex;

        margin-top: 16px;
    }
</style>

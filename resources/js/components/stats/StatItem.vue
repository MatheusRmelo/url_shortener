<template>
    <div class="stat-item">
        <i class="isax" :class="icon"></i>
        <div class="content">
            <h5 class="value">{{ value }}</h5>
            <p class="label">{{label}}</p>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'StatItem',
    props: {
        icon: {
            type: String,
            required: true,
        },
        value : {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        }
    }
})
</script>
<style scoped>
    .stat-item {
        display: flex;

        width: 20%;
        min-width: 200px;
    }
    .stat-item > i {
        margin-right: 16px;
        font-size: 32px;
        color: var(--color-text-sub);
        margin-top: 8px;
    }
    .stat-item > .content {
        display: flex;
        flex-direction: column;
    }
    .stat-item > .content > .value {
        font-size: 32px;
        font-weight: bold;
        color: var(--color-text-normal);
    }
    .stat-item > .content > .label {
        font-size: 24px;
        font-weight: normal;
        color: var(--color-text-sub);
    }
</style>

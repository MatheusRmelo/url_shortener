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
            type: Number,
            default: 0
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

        width: 80px;
    }
    .stat-item > i {
        margin-right: 16px;
        font-size: 20px;
        color: var(--color-text-normal);
    }
    .stat-item > .content {
        display: flex;
        flex-direction: column;
    }
    .stat-item > .content > .value {
        font-size: 16px;
        font-weight: bold;
        color: var(--color-text-normal);
    }
    .stat-item > .content > .label {
        font-size: 12px;
        font-weight: normal;
        color: var(--color-text-sub);
    }
</style>

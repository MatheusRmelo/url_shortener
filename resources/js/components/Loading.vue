<template>
    <div class="loading-area">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Loading'
});
</script>
<style scoped>
    .loading-area {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
    }
    .loading-area > i {
        font-size: 48px;
        color: var(--color-highlight);
    }
</style>

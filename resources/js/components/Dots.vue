<template>
    <div class="dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Dots'
});
</script>
<style scoped>
    .dots {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    .dots > .dot {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background-color: var(--color-text-sub);
    }
</style>

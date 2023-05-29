<template>
    <div class="overlay" :class="show ? 'show' : ''" @click="$emit('close')">
        <slot></slot>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: "Overlay",
    emits: ["close"],
    props: {
        show: {
            type: Boolean,
            required: true,
        },
    }
});
</script>
<style scoped>
    .overlay {
        display: flex;
        align-items: center;
        justify-content: center;

        background-color: rgba(0, 0, 0, 0.3);
        pointer-events: none;
        opacity: 0;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 999;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

</style>

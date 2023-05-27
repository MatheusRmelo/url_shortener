<template>
    <button @click="$emit('click')" :style="{width: `${size}px`, height: `${size}px`}">
        <i class="fa" :class="icon" :style="{fontSize: `${size-16}px`}"></i>
    </button>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'IconButton',
    emits: ['click'],
    props: {
        icon: {
            type: String,
            required: true,
        },
        size: {
            type: Number,
            default: 32,
        }
    }
})
</script>
<style scoped>
    button {
        border: none;
        outline: none;
        border-radius: 8px;

        cursor: pointer;
        background: transparent;
    }
    button:hover {
        background-color: var(--color-secondary);
    }
</style>

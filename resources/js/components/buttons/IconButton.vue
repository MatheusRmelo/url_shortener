<template>
    <button @click="$emit('click')" :style="{width: `${size}px`, height: `${size}px`}" :class="`${inSecondary && 'in-secondary'}`">
        <i class="isax" :class="icon" :style="{fontSize: `${size-16}px`}"></i>
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
        },
        inSecondary: {
            type: Boolean,
            default: false,
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
        color: var(--color-icon-normal);
    }
    button:hover {
        background-color: var(--color-secondary);
    }
    button:focus {
        border: 1px solid var(--color-highlight);
    }
    button.in-secondary:hover{
        background-color: var(--color-dominant);
    }
</style>

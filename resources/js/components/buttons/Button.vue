<template>
    <button @click="$emit('click')" :disabled="loading || disabled">
        <div v-if="loading">
            <i class="fa fa-spinner fa-spin" style="margin-left: 8px;"></i>
            Carregando...
        </div>
        <slot v-else></slot>
    </button>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    emits: ['click'],
    name: 'Button',
    props: {
        loading: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        }
    }
})
</script>
<style scoped>
    button {
        width: auto;
        height: 48px;

        outline: none;
        border: none;
        border-radius: 8px;
        background-color: var(--color-highlight);
        cursor: pointer;

        color: var(--color-text-light);
        font-size: 16px;
        font-weight: bold;
        transition: all 1s ease-in-out;
    }

    button:hover{
        opacity: 0.8;
    }
    button:disabled {
        background-color: var(--color-disabled);
        color: var(--color-text-disabled);
        cursor: not-allowed;
        opacity: 1;
    }
</style>

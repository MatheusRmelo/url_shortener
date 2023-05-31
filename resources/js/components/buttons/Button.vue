<template>
    <button @click="$emit('click')" :disabled="loading || disabled" :class="`${variant} ${isDeleteMode && 'delete'}`">
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
        },
        variant: {
            type: String,
            default: 'solid'
        },
        isDeleteMode: {
            type: Boolean,
            default: false
        }
    }
})
</script>
<style scoped>
    button {
        width: auto;
        height: 48px;
        min-height: 48px;

        outline: none;
        border: none;
        border-radius: 8px;
        background-color: var(--color-highlight);
        cursor: pointer;
        padding: 8px 16px;

        color: var(--color-text-light);
        font-size: 16px;
        font-weight: bold;
        transition: all 0.5s ease-in-out;
    }
    button.delete {
        background-color: var(--color-danger);
        color: var(--color-text-light);
    }
    button.text{
        background-color: transparent;
        color: var(--color-highlight);
    }
    button.text.delete {
        color: var(--color-text-normal);
    }

    button:hover, button.delete:hover{
        opacity: 0.8;
    }
    button.text:hover {
        background-color: var(--color-highlight-hover);
    }
    button:disabled {
        background-color: var(--color-disabled);
        color: var(--color-text-disabled);
        cursor: not-allowed;
        opacity: 1;
    }
    button.text:focus{
        border: 1px solid var(--color-highlight);
    }
    button:focus{
        border: 1px solid var(--color-text-normal);
    }
</style>

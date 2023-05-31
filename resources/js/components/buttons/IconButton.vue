<template>
    <button @click="$emit('click')" :class="`${inSecondary && 'in-secondary'} ${withText && 'with-text'}`">
        <i class="isax" :class="icon" :style="{fontSize: `${size-16}px`}"></i>
        <small class="label" v-if="active || withText">{{ text }}</small>
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
        },
        active: {
            type: Boolean,
            default: false,
        },
        withText: {
            type: Boolean,
            default: false,
        },
        text: {
            type: String,
            default: ""
        }
    }
})
</script>
<style scoped>
    button {
        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        outline: none;
        width: 32px;
        height: 32px;
        padding: 8px;
        border-radius: 8px;

        cursor: pointer;
        background: transparent;
        color: var(--color-icon-normal);
    }
    button:hover {
        background-color: var(--color-secondary);
    }
    button:focus {
        background-color: var(--color-dominant-hover);
    }
    button.in-secondary:hover{
        background-color: var(--color-dominant);
    }

    button i {
        font-size: 16px;
    }
    button.active {
        width: 100px;
        background-color: var(--color-dominant-hover);
        color: var(--color-highlight);
    }
    button.with-text {
        width: auto;
        color: var(--color-icon-normal);
    }
    button.with-text.active {
        background-color: var(--color-dominant-hover);
    }
    button .label {
        font-size: 16px;
        font-weight: normal;
        margin-left: 8px;
    }
</style>

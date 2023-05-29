<template>
    <button @click="$emit('click')" :class="`${inSecondary && 'in-secondary'} ${active && 'active'}`">
        <i class="isax" :class="icon"></i>
        <small class="label" v-if="active">{{ label }}</small>
    </button>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'MenuButton',
    emits: ['click'],
    props: {
        icon: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        height: {
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
        }
    }
})
</script>
<style scoped>
    button {
        display: flex;
        align-items: center;

        width: 32px;
        height: 32px;
        padding: 8px;

        border: none;
        outline: none;
        border-radius: 8px;

        cursor: pointer;
        background: transparent;
        transition: all 1s ease-in-out;
    }
    button:hover {
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
    button .label {
        font-size: 16px;
        font-weight: normal;
        margin-left: 8px;
    }

</style>

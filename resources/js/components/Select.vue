<template>
    <fieldset :class="error ? 'invalid' : ''">
        <label v-if="label">{{ label }}</label>
        <select :value="value" @input="(event: any) => $emit('update:value', event.target!.value)">
            <slot></slot>
        </select>
        <span class="error-text" v-if="error">{{ error }}</span>
    </fieldset>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Select',
    emits: ['update:value'],
    props: {
        label: {
            type: String,
            default: ""
        },
        value: {
            type: String,
            default: ""
        },
        error: {
            type: String,
            default: ""
        },
    }
});
</script>
<style scoped>
    fieldset {
        display: flex;
        flex-direction: column;

        outline: none;
        border: none;
    }
    fieldset > label {
        font-size: 16px;
        font-weight: 600;
        color: var(--color-text-normal);

        margin-bottom: 8px;
    }
    fieldset > select {
        display: flex;
        align-items: center;

        width: 100%;
        height: 40px;


        border-radius: 8px;
        background-color: var(--color-input-background);
        padding: 8px;

        outline: none;
        border: none;
        border-right: 8px solid transparent;
    }


    /* ERRORS */
    .error-text{
        font-size: 12px;
        font-weight: 400;

        text-align: right;
        color: var(--color-input-invalid);
    }
    fieldset.invalid label {
        color: var(--color-input-invalid);
    }
    fieldset.invalid > select{
        border: 1px solid var(--color-input-invalid-border);
    }
</style>

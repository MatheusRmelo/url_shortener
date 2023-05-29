<template>
    <fieldset :class="error ? 'invalid' : ''">
        <label v-if="label">{{ label }}</label>
        <div class="input-area" :class="isFocused ? 'focus' : ''">
            <input
                :class="`${centered && 'centered'} ${bold && 'bold'}`"
                :placeholder="placeholder"
                :value="value"
                :type="type"
                @input="(event: any) => $emit('update:value', event.target!.value)"
                @focus="isFocused = true" @blur="isFocused = false"
            />
            <slot name="suffix">

            </slot>
        </div>
        <span class="error-text" v-if="error">{{ error }}</span>
    </fieldset>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Input',
    emits: ['update:value'],
    data(){
        return {
            isFocused: false
        }
    },
    props: {
        label: {
            type: String,
            default: ""
        },
        placeholder: {
            type: String,
            default: "",
        },
        type: {
            type: String,
            default: "text"
        },
        value: {
            type: String,
            default: ""
        },
        error: {
            type: String,
            default: ""
        },
        centered: {
            type: Boolean,
            default: false,
        },
        bold: {
            type: Boolean,
            default: false,
        }
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
    fieldset > .input-area {
        display: flex;
        align-items: center;

        width: 100%;
        height: 40px;


        border-radius: 8px;
        background-color: var(--color-input-background);
        padding: 8px;
    }
    fieldset > .input-area.focus{
        border: 1px solid var(--color-highlight);
    }
    fieldset > .input-area > input {
        flex: 1;
        outline: none;
        border: none;
        background: transparent;

        margin-left: 8px;
    }
    fieldset > .input-area > input.centered {
        text-align: center;
    }
    fieldset > .input-area > input.bold {
        font-weight: bold;
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
    fieldset.invalid > .input-area{
        border: 1px solid var(--color-input-invalid-border);
    }
</style>

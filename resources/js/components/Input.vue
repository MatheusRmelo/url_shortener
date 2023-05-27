<template>
    <fieldset>
        <label>{{ label }}</label>
        <div class="input-area" :class="isFocused ? 'focus' : ''">
            <input
                :placeholder="placeholder"
                :value="value"
                :type="type"
                @input="(event: any) => $emit('update:value', event.target!.value)"
                @focus="isFocused = true" @blur="isFocused = false"
            />
            <slot name="suffix">

            </slot>
        </div>

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
            required: true
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
    }
});
</script>
<style scoped>
    fieldset {
        display: flex;
        flex-direction: column;

        outline: none;
        border: none;

        margin-top: 16px;
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

</style>

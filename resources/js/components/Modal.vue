<template>
    <Overlay :show="show" @close="$emit('close')">
        <div class="modal" v-on:click.stop>
            <div class="modal-header">
                <h3 class="title">
                    {{ title }}
                </h3>
                <i class="close-button isax isax-close-square5"  @click="$emit('close')"></i>
            </div>
            <slot></slot>
        </div>
    </Overlay>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Overlay from './Overlay.vue';

export default defineComponent({
    emits: ["close"],
    props: {
        show: {
            type: Boolean,
            required: true,
        },
        title: {
            type: String,
            default: ""
        }
    },
    name: "Modal",
    components: { Overlay }
});
</script>
<style scoped>
    .modal {
        background:  white;
        border-radius: 12px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        width: 20%;
        height: auto;
        min-height: 600px;
        max-height: 95vh;
        overflow: auto;
        max-width: 1000px;
        padding: 24px;

        display: flex;
        flex-direction: column;
    }

    .modal .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal .modal-header .title {
        font-size: 16px;
        font-weight: bold;
        color: var(--color-text-normal);
    }
    .modal .close-button {
        cursor: pointer;
        font-size: 32px;
        color: var(--color-text-normal);
        transition: all 0.1s ease-in-out;
    }
    .modal .close-button:hover{
        color: var(--color-text-sub);
    }
</style>

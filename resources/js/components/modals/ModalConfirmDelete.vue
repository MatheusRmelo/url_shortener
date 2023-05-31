<template>
    <Modal :show="show" @close="$emit('close')" :title="title">
        <small class="message">{{ message }}</small>
        <div class="actions">
            <Button variant="text" @click="$emit('close')" :is-delete-mode="true">
                Cancelar
            </Button>
            <Button :is-delete-mode="true" :loading="loading" @click="$emit('delete')">
                {{actionBtnText}}
            </Button>
        </div>
    </Modal>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Modal from './Modal.vue';
import Button from '../buttons/Button.vue';

export default defineComponent({
    name: "ModalConfirmDelete",
    emits: ['close', 'delete'],
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        loading: {
            type: Boolean,
            default: false,
        },
        title: {
            type: String,
            default: "Excluir",
        },
        message: {
            type: String,
            required: true,
        },
        actionBtnText: {
            type: String,
            default: "Excluir",
        }
    },
    components: { Modal, Button }
})
</script>
<style scoped>
    :deep(.modal) {
        width: 30%;
        height: auto;
        min-height: initial;
    }
    .message {
        font-size: 16px;
        font-weight: normal;

        margin: 16px 0px;
    }
    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 16px;

        margin-top: 16px;
    }

    @media screen and (max-width:1200px) {
        :deep(.modal) {
            width: 60%;
        }
    }
    @media screen and (max-width:767px) {
        :deep(.modal) {
            width: 80%;
        }
    }
</style>

<template>
    <Modal :show="show" @close="$emit('close')" title="Ordenar links">
        <div class="form">
            <Select v-model:value="column" label="Campo">
                <slot></slot>
            </Select>
            <Select v-model:value="orderBy" label="Ordenação">
                <option value="asc">Crescente</option>
                <option value="desc">Decrescente</option>
            </Select>
            <Button @click="handleClickOrder">
                Ordenar
            </Button>
        </div>
    </Modal>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from '../buttons/IconButton.vue';
import Overlay from '../Overlay.vue';
import Modal from './Modal.vue';
import Button from '../buttons/Button.vue';
import Select from '../Select.vue';
import Sort from '../../types/sort';

export default defineComponent({
    name: "ModalSort",
    emits: ["close", "order"],
    data(){
        return {
            column: "title",
            orderBy: "asc"
        }
    },
    methods: {
        handleClickOrder(){
            this.$emit("order", <Sort>{column: this.column, orderBy: this.orderBy});
        },
    },
    props: {
        show: {
            type: Boolean,
            required: true,
        },
    },
    components: { IconButton, Overlay, Modal, Button, Select }
});
</script>
<style scoped>
    :deep .modal {
        width: 20%;
        height: auto;
        min-height: initial;
    }
    .form > fieldset {
        margin-top: 16px;
    }
    .form > button {
        width: 100%;
        margin-top: 24px;
    }

    @media screen and (max-width:1200px) {
        :deep .modal {
            width: 40%;
        }
    }
    @media screen and (max-width:767px) {
        :deep .modal {
            width: 80%;
        }
    }
</style>

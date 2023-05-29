<template>
    <Modal :show="show" @close="$emit('close')" title="Criar um novo link">
        <form action="">
            <Input
                label="Título"
                placeholder="Digite o título do link"
                v-model:value="title"
                :error="errors && errors['title'] ? errors['title'][0] : ''"
            />
            <Input
                label="Slug (OPCIONAL)"
                placeholder="Digite um slug para o link"
                v-model:value="slug"
                :error="errors && errors['slug'] ? errors['slug'][0] : ''"
            />
            <Input
                label="URL"
                placeholder="Digite a url para encurtar"
                v-model:value="url"
                :error="errors && errors['url'] ? errors['url'][0] : ''"
            />
            <Button @click="handleClickCreate" :loading="loading" :disabled="!url || !title">
                Criar novo link
            </Button>
        </form>
    </Modal>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from './buttons/IconButton.vue';
import Overlay from './Overlay.vue';
import Modal from './Modal.vue';
import Input from './Input.vue';
import Button from './buttons/Button.vue';
import apiClient from '../api/apiClient';
import { toast } from 'vue3-toastify';
import Link from '../types/link';

export default defineComponent({
    name: "ModalFormLink",
    emits: ["close", "save"],
    data(){
        return {
            loading: false,
            title: '',
            slug: '',
            url: '',
            errors: null,
        }
    },
    methods: {
        async handleClickCreate(){
            this.loading = true;
            this.errors = null;
            var response = await apiClient.post<Link>("/links", {
                title: this.title,
                slug: this.slug,
                url: this.url,
            });
            if(response.ok){
                this.title = "";
                this.slug = "";
                this.url = "";
                this.$emit('save', response.result)
            }else if(response.status == 422){
                this.errors = response.errors;
            }else{
                toast.error(response.message ?? "Falha ao criar link", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    props: {
        show: {
            type: Boolean,
            required: true,
        },
    },
    components: { IconButton, Overlay, Modal, Input, Button }
});
</script>
<style scoped>
    form > fieldset {
        margin-top: 16px;
    }
    form > button {
        width: 100%;
        margin-top: 24px;
    }
</style>

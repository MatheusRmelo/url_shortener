<template>
    <div class="link-card">
        <Dots />
        <div class="content">
            <h3 class="title">{{ link.title }}</h3>
            <small class="link">{{`${baseRedirect}${link.slug}`}}</small>
        </div>
        <div class="actions">
            <div class="views">
                <small class="quantity">{{ link.hits ?? 0 }}</small>
                <i class="isax isax-chart-1"></i>
            </div>
            <div class="buttons">
                <IconButton icon="isax-copy" :in-secondary="true" @click="copyLinkToKeyboard"/>
                <IconButton icon="isax-edit" :in-secondary="true" @click="$emit('edit')"/>
                <IconButton icon="isax-trash" :in-secondary="true" />
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { PropType, defineComponent } from 'vue';
import Dots from './Dots.vue';
import Link from '../types/link';
import { baseRedirectLink } from '../constants';
import IconButton from './buttons/IconButton.vue';
import { toast } from 'vue3-toastify';

export default defineComponent({
    name: "LinkCard",
    emits: ['edit'],
    computed: {
        baseRedirect(){
            return baseRedirectLink;
        }
    },
    methods: {
        copyLinkToKeyboard(){
            navigator.clipboard.writeText(`${this.baseRedirect}${this.link.slug}`).then(()=>{
                toast.success('Sucesso ao copiar link', {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }).catch((err) => {
                toast.error('Falha ao copiar o link', {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            });
        }
    },
    props: {
        link: {
            type: Object as PropType<Link>,
            required: true,
        }
    },
    components: { Dots, IconButton }
})
</script>
<style scoped>
    .link-card {
        display: flex;
        align-items: center;

        width: 100%;
        height: 80px;

        background-color: var(--color-secondary);
        border-radius: 8px;
        margin-top: 16px;
        padding: 16px 32px;
    }
    .link-card .content {
        flex: 1;
        margin-left: 24px;
    }

    .link-card .content > .title {
        color: var(--color-text-normal);
    }
    .link-card .content > .link {
        color: var(--color-highlight);
    }

    .link-card .actions {
        display: flex;
        gap: 24px;
    }
    .link-card .actions .views {
        display: flex;
        align-items: center;
        color: var(--color-text-sub);
    }
    .link-card .actions .views > .quantity {
        font-size: 12px;
        margin-right: 8px;
    }
    .link-card .actions .views > i {
        font-size: 16px;
    }
</style>

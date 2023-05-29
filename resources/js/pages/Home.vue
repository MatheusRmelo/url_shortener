<template>
    <ModalFormLink
        :show="showFormLink"
        :link="activeLink"
        @close="showFormLink = false"
        @save="handleSaveLink"
    />
    <main>
        <Header @add="showFormLink=true;activeLink=null" />
        <section>
            <SectionHeader>
                <template #upper>
                    <StatsBar
                        :links="links.length"
                        :views="links.reduce((acc, obj)=>acc + obj.hits, 0)"
                    />
                </template>
                <template #menu>
                    <div class="menu">
                        <MenuButton
                            icon="isax-home"
                            label="Home"
                            :active="activeMenu == 0"
                            @click="activeMenu = 0"
                        />
                        <MenuButton
                            icon="isax-chart-1"
                            label="Análise"
                            :active="activeMenu == 1"
                            @click="activeMenu = 1"
                        />
                        <MenuButton
                            icon="isax-trash"
                            label="Excluir"
                            :active="activeMenu == 2"
                            @click="activeMenu = 2"
                        />
                    </div>
                </template>
            </SectionHeader>
            <div class="links">
                <Loading v-if="loading" />
                <LinkCard v-else v-for="link in links" :link="link" @edit="activeLink = link;showFormLink=true;" />
            </div>
        </section>
    </main>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Header from '../components/Header.vue';
import SectionHeader from '../components/SectionHeader.vue';
import StatsBar from '../components/stats/StatsBar.vue';
import MenuButton from '../components/buttons/MenuButton.vue';
import type Link from '../types/link';
import apiClient from '../api/apiClient';
import { toast } from 'vue3-toastify';
import Loading from '../components/Loading.vue';
import LinkCard from '../components/LinkCard.vue';
import Modal from '../components/Modal.vue';
import ModalFormLink from '../components/ModalFormLink.vue';
import Input from '../components/Input.vue';
import Button from '../components/buttons/Button.vue';

export default defineComponent({
    name: "Home",
    data(){
        return {
            activeMenu: 0,
            links: [] as Link[],
            loading: false,
            showFormLink: false,
            activeLink: null as Link | null,
        }
    },
    mounted(){
        this.getLinks();
    },
    methods: {
        handleSaveLink(link: Link){
            this.showFormLink = false;
            if(this.activeLink){
                let index: number = this.links.findIndex((element)=>element.id == this.activeLink.id);
                if(index > -1){
                    this.links[index] = link;
                }
                this.activeLink = null;
            }else{
                this.links.push(link);
            }
        },
        async getLinks(){
            this.loading = true;
            var response = await apiClient.get<Link[]>("/links");
            if(response.ok){
                this.links = response.result;
            }else{
                toast.error(response.message ?? "Falha ao fazer buscar os links", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    components: { Header, SectionHeader, StatsBar, MenuButton, Loading, LinkCard, Modal, ModalFormLink, Input, Button }
});
</script>
<style scoped>
    section {
        display: flex;
        flex-direction: column;

        width: 100%;
        height: 100%;

        padding: 64px 15%;
    }
    section .menu {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    section .links {
        display: flex;
        flex-direction: column;
        width: 100%;
        min-height: 400px;
    }
</style>


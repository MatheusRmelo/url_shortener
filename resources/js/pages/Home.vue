<template>
    <ModalFormLink
        :show="showFormLink"
        :link="activeLink"
        @close="showFormLink = false"
        @save="handleSaveLink"
    />
    <ModalConfirmDelete
        :show="showConfirmDelete"
        title="Excluir meu link"
        :message="`Excluir o link (${activeLink?.title}) é uma ação irreversível, após essa ação os dados seram perdidos`"
        :action-btn-text="`Excluir o link`"
        :loading="loadingDelete"
        @close="showConfirmDelete = false"
        @delete="handleClickDeleteLink"
    />
    <ModalSort
        :show="showSort"
        @close="showSort=false"
        @order="handleClickSort"
    >
        <option value="title">Título</option>
        <option value="slug">Slug</option>
        <option value="url">URL</option>
        <option value="hits">Visualizações</option>
    </ModalSort>
    <main>
        <Header @add="showFormLink=true;activeLink=null" @search="handleSearch" />
        <section>
            <SectionHeader @order="showSort=true">
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
                <LinkCard v-else v-for="link in availableLinks" :link="link"
                    @edit="activeLink = link;showFormLink=true;"
                    @delete="activeLink = link;showConfirmDelete = true;"
                />
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
import ModalFormLink from '../components/modals/ModalFormLink.vue';
import Input from '../components/Input.vue';
import Button from '../components/buttons/Button.vue';
import ModalConfirmDelete from '../components/modals/ModalConfirmDelete.vue';
import ModalSort from '../components/modals/ModalSort.vue';
import Sort from '../types/sort';
import { baseRedirectLink } from '../constants';

export default defineComponent({
    name: "Home",
    computed:{
        availableLinks(){
            return this.links.filter((element)=>!element.hidden);
        }
    },
    data(){
        return {
            activeMenu: 0,
            links: [] as Link[],
            loading: false,
            showFormLink: false,
            showConfirmDelete: false,
            showSort: false,
            activeLink: null as Link | null,
            loadingDelete: false,
        }
    },
    mounted(){
        this.getLinks();
    },
    methods: {
        handleSearch(search: string){
            search = search.toLowerCase();
            this.links = (this.links as Link[]).map((element)=><Link>{
                ...element,
                hidden: !(
                    element.title.toLowerCase().includes(search) ||
                    element.url.toLowerCase().includes(search) ||
                    `${baseRedirectLink}${element.slug}`.toLowerCase().includes(search)
                )
            });
        },
        handleClickSort(sort: Sort){
            this.showSort = false;
            (this.links as Link[])
            .sort((a, b)=>{
                let result = false;
                switch (sort.column) {
                    case 'title':
                        result = sort.orderBy == 'asc' ? a.title > b.title : a.title < b.title;
                        break;
                    case 'slug':
                        result = sort.orderBy == 'asc' ? a.slug > b.slug : a.slug < b.slug;
                        break;
                    case 'url':
                        result = sort.orderBy == 'asc' ? a.url > b.url : a.url < b.url;
                        break;
                    case 'hits':
                        result = sort.orderBy == 'asc' ? a.hits > b.hits : a.hits < b.hits;
                        break;
                    default:
                        result = sort.orderBy == 'asc' ? a.title > b.title : a.title < b.title;
                        break;
                }
                return result ? 1 : -1;
            });
        },
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
        async handleClickDeleteLink(){
            if(this.activeLink == null) return;

            this.loadingDelete = true;
            var response = await apiClient.delete(`/links/${this.activeLink.id}`);
            if(response.status == 204){
                this.links = this.links.filter((element)=>element.id != this.activeLink.id);
                this.activeLink = null;
                this.showConfirmDelete = false;
            }else{
                toast.error(response.message ?? "Falha ao excluir o link", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loadingDelete = false;
        },
        async getLinks(){
            this.loading = true;
            var response = await apiClient.get<Link[]>("/links");
            if(response.ok){
                this.links = response.result;
            }else{
                toast.error(response.message ?? "Falha ao buscar os links", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    components: { Header, SectionHeader, StatsBar, MenuButton, Loading, LinkCard, ModalFormLink, Input, Button, ModalConfirmDelete, ModalSort }
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

    @media screen and (max-width: 1080px) {
        section {
            padding: 16px;
        }
    }
</style>


<template>
    <header v-if="!searchModeMobile || !isMobile">
        <Logo />
        <HeaderActions @add="$emit('add')" @search="(search: string) => $emit('search', search)" @search-mode="handleChangeSearchMode"/>
        <ProfileArea />
    </header>
    <header v-else>
        <div class="search-area">
            <Input placeholder="Pesquise ou cole a URL" v-model:value="search" @update:value="$emit('search', search)" :centered="true" :bold="true"/>
            <IconButton icon="isax-close-square5" :size="48" @click="handleChangeSearchMode"/>
        </div>
    </header>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Logo from './Logo.vue';
import HeaderActions from './HeaderActions.vue';
import ProfileArea from './ProfileArea.vue';
import Input from './Input.vue';
import IconButton from './buttons/IconButton.vue';
export default defineComponent({
    emits: ['add', 'search'],
    computed: {
        isMobile(): boolean {
            return window.innerWidth <= 767;
        }
    },
    data(){
        return {
            searchModeMobile: false,
            search: "",
        }
    },
    methods: {
        handleChangeSearchMode(){
            if(window.innerWidth > 767){
                this.searchModeMobile = false;
                return;
            }
            this.searchModeMobile = !this.searchModeMobile;
            this.search = "";
            this.$emit('search', this.search);
        }
    },
    name: "Header",
    components: { Logo, HeaderActions, ProfileArea, Input, IconButton }
});
</script>
<style scoped>
    header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        width: 100%;
        height: 80px;
        padding: 16px 24px;
        background-color: var(--color-secondary);
        border-radius: 8px;
    }

    .search-area {
        display: flex;
        align-items: center;
        width: 100%;
    }
    .search-area > fieldset {
        flex: 1;
        margin-right: 8px;
    }

    @media screen and (max-width: 767px) {
        header {
            justify-content: flex-start;
        }
    }
</style>

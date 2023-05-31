<template>
    <div class="header-actions">
        <IconButton icon="isax-search-normal" :in-secondary="true"/>
        <div class="search-area">
            <Input placeholder="Pesquise ou cole a URL" v-model:value="search" @update:value="$emit('search', search)" :centered="true" :bold="true"/>
        </div>
        <IconButton icon="isax-add" :in-secondary="true" @click="$emit('add')"/>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from './buttons/IconButton.vue';
import Input from './Input.vue';

export default defineComponent({
    name: "HeaderActions",
    emits: ['add', 'search'],
    data(){
        return {
            search: ""
        }
    },
    components: { IconButton, Input }
});
</script>
<style scoped>
    .header-actions {
        display: flex;
        align-items: center;

        gap: 16px;
        width: 40%;
        height: 100%;
    }

    .header-actions .search-area {
        flex: 1;
    }

    @media screen and (max-width: 767px) {
        .header-actions {
            width: 100%;
            justify-content: flex-end;
            gap: 0px;
        }
        .header-actions .search-area {
            display: none;
        }
    }
</style>

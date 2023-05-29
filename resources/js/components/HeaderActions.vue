<template>
    <div class="header-actions">
        <IconButton icon="isax-search-normal" :in-secondary="true"/>
        <div class="search-area">
            <Input placeholder="Pesquise ou cole a URL" :centered="true" :bold="true"/>
        </div>
        <IconButton icon="isax-add" :in-secondary="true"/>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from './buttons/IconButton.vue';
import Input from './Input.vue';

export default defineComponent({
    name: "HeaderActions",
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
</style>

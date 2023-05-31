<template>
    <div class="section-header">
        <slot name="upper"></slot>
        <Divider />
        <div class="actions">
            <div class="menu">
                <slot name="menu"></slot>
            </div>
            <div class="filters">
                <IconButton
                    icon="isax-arrow-3"
                    @click="$emit('order')"
                />
                <IconButton
                    icon="isax-filter-search"
                    :with-text="true"
                    text="Filtros"
                />
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Divider from './Divider.vue';
import IconButton from './buttons/IconButton.vue';
export default defineComponent({
    name: "SectionHeader",
    emits: ['order'],
    components: { Divider, IconButton }
});
</script>
<style scoped>
    .section-header {
        display: flex;
        flex-direction: column;

        padding: 24px;
        width: 100%;
    }
    .section-header > .actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-header > .actions > .filters {
        display: flex;
        align-items: center;
    }
</style>

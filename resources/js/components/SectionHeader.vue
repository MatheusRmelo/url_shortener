<template>
    <div class="section-header">
        <slot name="upper"></slot>
        <Divider />
        <div class="actions">
            <div class="menu">
                <slot name="menu"></slot>
            </div>
            <div class="filters">
                FILTER
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Divider from './Divider.vue';
export default defineComponent({
    name: "SectionHeader",
    components: { Divider }
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
</style>

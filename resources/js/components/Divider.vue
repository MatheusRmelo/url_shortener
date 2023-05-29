<template>
    <div class="divider"></div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Divider',
});
</script>
<style scoped>
    .divider {
        width: 100%;
        height: 1px;
        background-color: #e4dfdf;
        margin: 16px 0px;
    }
</style>

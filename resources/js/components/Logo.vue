<template>
    <h1 class="logo">Url Shortener</h1>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Logo'
})
</script>
<style scoped>
    .logo {
        font-size: 24px;
        color: var(--color-highlight);
        font-weight: bold;
    }
</style>

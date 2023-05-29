<template>
    <header>
        <Logo />
        <HeaderActions />
        <ProfileArea />
    </header>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Logo from './Logo.vue';
import HeaderActions from './HeaderActions.vue';
import ProfileArea from './ProfileArea.vue';
export default defineComponent({
    name: "Header",
    components: { Logo, HeaderActions, ProfileArea }
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
</style>

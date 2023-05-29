<template>
    <div class="profile-area">
        <IconButton icon="isax-notification"/>
        <div class="profile">
            <img src="/assets/user_no_image.png" alt="Foto do usuário" />
            <IconButton icon="isax-arrow-down-1" />
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from './buttons/IconButton.vue';
export default defineComponent({
    name: "ProfileArea",
    components: { IconButton }
});
</script>
<style scoped>
    .profile-area {
        display: flex;
        align-items: center;

        width: auto;
        height: 100%;
    }
    .profile-area > .profile {
        display: flex;
        align-items: center;

        margin-left: 16px;
    }
    .profile-area > .profile > img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 4px;
    }
</style>

<template>
    <div class="profile-area" >
        <IconButton icon="isax-notification"/>
        <div class="profile" @click="showDropdown = !showDropdown" v-on:click.stop>
            <img src="/assets/user_no_image.png" alt="Foto do usuário" />
            <IconButton icon="isax-arrow-down-1" class="icon-dropdown" :class="showDropdown ? 'open' : 'close'" />
        </div>
        <ProfileDropdownMenu :active="showDropdown" @close="showDropdown = false"/>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import IconButton from './buttons/IconButton.vue';
import ProfileDropdownMenu from './ProfileDropdownMenu.vue';
export default defineComponent({
    name: "ProfileArea",
    data(){
        return {
            showDropdown: true,
        }
    },
    components: { IconButton, ProfileDropdownMenu }
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
        cursor: pointer;
    }
    .profile-area .icon-dropdown {
        transition: all 0.5s ease-in-out;
    }
    .profile-area .icon-dropdown.open {
        transform: rotate(180deg);
    }
    .profile-area > .profile > img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 4px;
    }
    @media screen and (max-width: 767px) {
        .profile-area {
            justify-content: flex-end;
        }
    }
</style>

<template>
    <div class="profile-dropdown-menu" :class="active ? 'active' : ''" v-on:click.stop>
        <div class="chat-point"></div>
        <Button variant="text" @click="logout" :loading="loading">
            Sair
        </Button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Button from './buttons/Button.vue';
import apiClient from '../api/apiClient';
import { toast } from 'vue3-toastify';

export default defineComponent({
    name: "ProfileDropdownMenu",
    emits: ["close"],
    data(){
        return {
            loading: false,
        }
    },
    methods: {
        clickedOutsideDropdown() {
            window.addEventListener("click", this.close);
        },
        close() {
            this.$emit("close");
        },
        async logout(){
            this.loading = true;
            var response = await apiClient.get('auth/logout');
            if(response.status == 204){
                localStorage.setItem("token", "");
                this.$router.push({name: 'login'});
            }else{
                toast.error(response.message ?? "Falha ao fazer o logout", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    mounted() {
        this.clickedOutsideDropdown();
    },
    props: {
        active: {
            type: Boolean,
            default: false
        },
    },
    components: { Button }
});
</script>
<style scoped>
    :deep button {
        min-height: initial;
        height: auto;
    }
    .profile-dropdown-menu {
        position: absolute;
        right: 16px;
        top: 64px;

        display: none;
        flex-direction: column;

        gap: 16px;
        width: 200px;
        padding: 8px;

        background-color: var(--color-text-normal);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
        color: white;

        border-radius: 16px;

        z-index: 99;

        animation: dropLado 300ms forwards;
        transform-origin: right center;
    }

    .profile-dropdown-menu.active {
        display: flex;
    }

    .profile-dropdown-menu.active>.chat-point {
        position: absolute;
        top: -5px;
        right: 16px;

        transform: rotate(45deg);
        border-radius: 3px;
        background-color: var(--color-text-normal);

        width: 16px;
        height: 16px;
    }
</style>

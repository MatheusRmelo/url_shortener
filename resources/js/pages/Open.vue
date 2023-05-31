<template>
    <div class="open-area" v-if="!notFoundLink">
        Carregando link...
    </div>
    <NotFound v-else :message="`Seu link não foi encontrado`" step="Verifique novamente o seu link, e tente novamente"/>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import apiClient from '../api/apiClient';
import NotFound from './NotFound.vue';

export default defineComponent({
    name: 'Open',
    data(){
        return {
            notFoundLink: false,
        }
    },
    mounted(){
        this.redirectToLink();
    },
    methods: {
        async redirectToLink(){
            let slug = this.$route.params.slug as string|undefined;
            if(!slug){
                this.notFoundLink = true;
                return;
            }
            var response = await apiClient.get<string>(`open/${slug}`);
            if(response.ok){
                window.location.href = response.result!;
            }else{
                this.notFoundLink = true;
            }
        }
    },
    components: { NotFound }
});
</script>
<style scoped>
    .open-area {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        height: 80vh;
    }
</style>

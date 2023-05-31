<template>
    <div class="notfound-area">
        <img src="/assets/not_found.svg" alt="Not found image">
        <h1 class="message">{{ message }}</h1>
        <h4 class="step">Tente o seguinte: {{ step }}</h4>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
export default defineComponent({
    name: 'NotFound',
    props: {
        message: {
            type: String,
            default: "URL não encontrada"
        },
        step: {
            type: String,
            default: "Verifique sua URL e tente novamente"
        },
    }
});
</script>
<style scoped>
    .notfound-area {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        width: 100%;
        height: 80vh;
        padding: 24px;
    }
    .notfound-area img {
        width: auto;
        height: 40%;
    }
    .notfound-area .message {
        font-size: 32px;
        color: var(--color-text-normal);

        margin-top: 24px;
        text-align: center;
    }
    .notfound-area .step {
        font-size: 24px;
        font-weight: normal;
        color: var(--color-text-normal);
        text-align: center;
    }

    @media screen and (max-width: 767px) {
        .notfound-area img {
            height: 30%;
        }

        .notfound-area .message {
            font-size: 24px;
        }
        .notfound-area .step {
            font-size: 16px;
        }
    }
</style>

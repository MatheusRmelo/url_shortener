<template>
    <main class="auth-area">
        <div class="form-area">
            <h2 class="title">{{title}}</h2>
            <p class="description">{{description}}</p>
            <slot></slot>
        </div>
    </main>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'AuthArea',
    props: {
        title: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        }
    }
})
</script>
<style scoped>
    .auth-area {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        height: 100vh;
    }
    .auth-area > .form-area {
        display: flex;
        flex-direction: column;
        width: 450px;
        height: 70%;
        padding: 32px;
        gap: 16px;

        background-color: var(--color-secondary);
        border-radius: 16px;
    }
    .auth-area > .form-area > .description {
        margin-bottom: 16px;
    }

    @media screen and (max-width: 767px) {
        .auth-area {
            width: 100%;
            height: 100vh;
            background-color: var(--color-secondary);

            align-items: start;
            padding-top: 15%;
        }

        .auth-area > .form-area {
            height: 100%;
        }
    }
</style>

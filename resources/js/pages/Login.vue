<template>
    <main class="auth-area">
        <section class="form-area">
            <h2>Faça seu login</h2>
            <p>Entre agora e faça a gestão dos seus links</p>
            <Input
                label="E-mail"
                placeholder="Digite o seu e-mail"
                v-model:value="email"
            />
            <Input
                label="Senha"
                placeholder="Digite a sua senha"
                :type="showPassword ? 'text' : 'password'"
                v-model:value="password"
            >
                <template #suffix>
                    <IconButton
                        @click="showPassword = !showPassword"
                        :icon="showPassword ? 'fa-eye' : 'fa-eye-slash'"
                    />
                </template>
            </Input>
            <Button @click="handleClickLogin" :loading="loading" :disabled="!email || !password">
                Entrar
            </Button>
        </section>
    </main>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Input from '../components/Input.vue';
import IconButton from '../components/IconButton.vue';
import Button from '../components/Button.vue';
import apiClient from '../api/apiClient';
import { toast } from 'vue3-toastify';

export default defineComponent({
    name: "Login",
    data(){
        return {
            email: '',
            password: '',
            showPassword: false,
            loading: false,
        }
    },
    methods: {
        async handleClickLogin(){
            this.loading = true;
            var response = await apiClient.post<string>("/auth/login", {
                email: this.email,
                password: this.password,
            });
            if(response.ok){
                localStorage.setItem('token', response.result!);
                this.$router.push("/");
            }else{
                toast.error("Falha ao fazer o login", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    components: { Input, IconButton, Button }
});
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
    height: 60%;
    padding: 32px;

    background-color: var(--color-secondary);
    border-radius: 16px;
}
.auth-area > .form-area > p {
    margin-bottom: 32px;
}
.auth-area > .form-area > button {
    margin-top: 32px;
}
</style>

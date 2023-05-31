<template>
    <AuthArea
        title="Faça seu login"
        description="Entre agora e faça a gestão dos seus links"
    >
        <Input
            label="E-mail"
            type="email"
            placeholder="Digite o seu e-mail"
            v-model:value="email"
            :error="errors && errors['email'] ? errors['email'][0] : ''"
        />
        <Input
            label="Senha"
            placeholder="Digite a sua senha"
            :type="showPassword ? 'text' : 'password'"
            v-model:value="password"
            :error="errors && errors['password'] ? errors['password'][0] : ''"
        >
            <template #suffix>
                <IconButton
                    @click="showPassword = !showPassword"
                    :icon="showPassword ? 'isax-eye' : 'isax-eye-slash'"
                />
            </template>
        </Input>
        <Button @click="handleClickLogin" :loading="loading" :disabled="!email || !password" >
            Entrar
        </Button>
        <Button @click="this.$router.push({name: 'register'})" variant="text">
            Ainda não tem conta? Crie uma agora!
        </Button>
    </AuthArea>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import Input from '../components/Input.vue';
import IconButton from '../components/buttons/IconButton.vue';
import Button from '../components/buttons/Button.vue';
import apiClient from '../api/apiClient';
import { toast } from 'vue3-toastify';
import AuthArea from '../components/layout/AuthArea.vue';

export default defineComponent({
    name: "Login",
    computed: {
        getError(code: string){
            if(!this.errors) return "";
            if(this.errors[code]){
                return this.errors[code][0];
            }
            return "";
        }
    },
    data(){
        return {
            email: '',
            password: '',
            errors: null,
            showPassword: false,
            loading: false,
        }
    },
    methods: {
        async handleClickLogin(){
            this.loading = true;
            this.errors = null;

            var response = await apiClient.post<string>("/auth/login", {
                email: this.email,
                password: this.password,
            });
            if(response.ok){
                localStorage.setItem('token', response.result!);
                this.$router.push("/");
            }else if(response.status == 422){
                this.errors = response.errors;
            }else{
                toast.error(response.message ?? "Falha ao fazer o login", {
                    autoClose: 3000,
                    position: 'bottom-center'
                });
            }
            this.loading = false;
        }
    },
    components: { Input, IconButton, Button, AuthArea }
});
</script>
<style scoped>
    button.solid {
        margin-top: 24px;
    }
</style>

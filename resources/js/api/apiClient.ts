import axios, { AxiosError } from "axios"

const client = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
    headers: {
        Accept: 'application/json',
        "Content-Type": "application/json"
    }
})
export default {
    async get<T>(path = "") : Promise<Response<T>>{
        let token = localStorage.getItem('token');
        try {
            var response = await client.get(path, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            return {
                ...response.data,
                status: response.status
            };
        }catch(e){
            if(e instanceof AxiosError && e.response){
                return {
                    ...e.response.data,
                    status: e.response.status,
                    errors: e.response.status == 422 ? e.response.data.errors : null,
                    ok: false,
                };
            }
            return {
                message: "Falha ao se comunicar com o servidor",
                ok: false,
                result: null,
                status: 500,
            }
        }
    },
    async put<T>(path = "", body = {}) : Promise<Response<T>>{
        let token = localStorage.getItem('token');
        try {
            var response = await client.put(path, body, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            return {
                ...response.data,
                status: response.status
            };
        }catch(e){
            if(e instanceof AxiosError && e.response){
                return {
                    ...e.response.data,
                    status: e.response.status,
                    errors: e.response.status == 422 ? e.response.data.errors : null,
                    ok: false,
                };
            }
            return {
                message: "Falha ao se comunicar com o servidor",
                ok: false,
                result: null,
                status: 500,
            }
        }
    },
    async post<T>(path = "", body = {}) : Promise<Response<T>>{
        let token = localStorage.getItem('token');
        try {
            var response = await client.post(path, body, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            return {
                ...response.data,
                status: response.status
            };
        }catch(e){
            if(e instanceof AxiosError && e.response){
                return {
                    ...e.response.data,
                    status: e.response.status,
                    errors: e.response.status == 422 ? e.response.data.errors : null,
                    ok: false,
                };
            }
            return {
                message: "Falha ao se comunicar com o servidor",
                ok: false,
                result: null,
                status: 500,
            }
        }
    },
    async delete<T>(path = "") : Promise<Response<T>>{
        let token = localStorage.getItem('token');
        try {
            var response = await client.delete(path, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            return {
                ...response.data,
                status: response.status
            };
        }catch(e){
            if(e instanceof AxiosError && e.response){
                return {
                    ...e.response.data,
                    status: e.response.status,
                    errors: e.response.status == 422 ? e.response.data.errors : null,
                    ok: false,
                };
            }
            return {
                message: "Falha ao se comunicar com o servidor",
                ok: false,
                result: null,
                status: 500,
            }
        }
    },
}

interface Response<T> {
    result?: T | null,
    ok: boolean,
    message: string,
    status: number,
    errors?: object
}

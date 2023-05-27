import axios, { AxiosError } from "axios"

const client = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
    headers: {
        Accept: 'application/json',
        "Content-Type": "application/json"
    }
})
export default {
    get(path = ""){
        let token = localStorage.getItem('token');
        return client.get(path, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
    },
    async post<T>(path = "", body = {}) : Promise<Response<T>>{
        let token = localStorage.getItem('token');
        try {
            var response = await client.post(path, body, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            return response.data;
        }catch(e){
            if(e instanceof AxiosError && e.response){
                return e.response.data;
            }
            return {
                message: "Falha ao se comunicar com o servidor",
                ok: false,
                result: null,
            }
        }
    },
}

interface Response<T> {
    result: T | null,
    ok: boolean,
    message: string,
}

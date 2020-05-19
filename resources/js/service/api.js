import axios from "axios";

export default()=>{
    return axios.create({
        baseURL:"http://127.0.0.1:8000/admin",
        withCredentials:false,
        headers:{
            Accept:"application/json",
            "Context-Type":"application/json"
        }
    })
}

// import axios from 'axios'

export function get(url, params) {
    return axios({
        method: 'GET',
        url: url,
        params: params
    })
}

export function byMethod(method, url, data) {
    return axios({
        method: method,
        url: url,
        data: data
    })
}
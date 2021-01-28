import axios from 'axios'


function bootstrap(){
    window.axios = axios    
    window.axios.defaults.baseURL = process.env.API_URL    
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'    
}

export default {
    bootstrap
}

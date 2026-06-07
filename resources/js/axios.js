import axios from "axios"
import router from './router.js'
console.log(import.meta.env.baseURL);

const axiosClient = axios.create({
  baseURL: import.meta.env.baseURL,
  withCredentials: true,
  withXSRFToken: true
})

/* axiosClient.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
}) */

axiosClient.interceptors.response.use(response => {
  return response
}, error => {

  if( error.response && error.response.status === 401 ) {
    router.push('/login')
  }

  throw error

})

export default axiosClient

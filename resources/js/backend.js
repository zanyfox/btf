import './bootstrap.js'
import '../assets/backend/js/plugins/popper.min.js'
import '../assets/backend/js/plugins/bootstrap.min.js'
import '../assets/backend/js/script.js'
import '../assets/backend/js/theme.js'
import '../assets/backend/js/plugins/feather.min.js'

import Gate from "./gate.js"

import Swal from 'sweetalert2'
window.swal = Swal
window.toast = Swal.mixin({
  toast: true,
  icon: 'success',
  title: 'General Title',
  animation: false,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'
toastr.options = {
  closeButton: false,
  progressBar: false,
  positionClass: 'toast-top-right',
  timeOut: 5000
}
window.toastr = toastr

import { createApp } from 'vue/dist/vue.esm-bundler.js'
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'

import ru from '../../lang/ru.json'
import en from '../../lang/en.json'
const i18n = createI18n({
  legacy: false,
  locale: 'ru',
  fallbackLocale: 'en',
  messages: {
    en: en,
    ru: ru,
  }
})
import router from './router.js'
//import BackendLayout from './layouts/BackendLayout.vue'

const app = createApp({})
const pinia = createPinia()

//console.log(window.user);

const gate = new Gate(window.user)
app.config.globalProperties.$gate = gate
app.provide('gate', gate)

app.use(i18n).use(pinia).use(router).mount('#app')

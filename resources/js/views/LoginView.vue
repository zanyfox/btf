<template>
  <AuthLayout title="Авторизация">
    <div class="alert alert-danger" role="alert" v-if="errorMessage" v-html="errorMessage"></div>
    <form @submit.prevent="handleSubmit" role="form">
      <div class="form-group mb-3">
        <input type="email" v-model="form.email" class="form-control" placeholder="Email" />
      </div>
      <div class="form-group mb-3">
        <input type="password" v-model="form.password" class="form-control" placeholder="Password" />
      </div>
      <div class="d-flex mt-1 justify-content-between align-items-center">
        <div class="form-check">
          <input type="checkbox" v-model="form.remember" id="customCheckc1" class="form-check-input input-primary" checked />
          <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
        </div>
      </div>
      <div class="text-center mt-4">
        <button type="submit" :disabled="loading" class="btn btn-primary shadow px-sm-4 d-flex align-items-center">
          <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <span v-else>Login</span>
        </button>
      </div>
    </form>
  </AuthLayout>
</template>
<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { useUserStore } from '@/stores/user'
const userStore = useUserStore()
const router = useRouter()
const form = reactive({
  email: '',
  password: '',
  remember: false
})
const loading = ref(false)
const errorMessage = ref('')

function handleSubmit() {
  errorMessage.value = ''
  loading.value = true

  fetch('/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: JSON.stringify({
      email: form.email,
      password: form.password,
      remember: form.remember
    })
  }).then(response => {
    if (response.status === 200) {
      userStore.updateUser({isLoggedIn: true})
      console.log(userStore.getUser);
      //router.push('/backend/dashboard')
      window.location.href = '/backend/dashboard'
    } else {
      errorMessage.value = 'Incorrect credentials'
    }
  }).catch(error => console.error(error)).finally(() => loading.value = false)
}
</script>

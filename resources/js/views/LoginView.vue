<template>
  <div class="card borderless">
  <div class="align-items-center ">
      <div class="card-body">
        <h4 class="mb-3 f-w-400">Authorization</h4>
        <hr>
        <form @submit.prevent="handleSubmit" class="login-form" role="form">
          <div class="form-group mb-3">
            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" autofocus>
          </div>
          <div class="form-group mb-4">
            <input type="password" v-model="form.password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off">
          </div>
          <div class="custom-control custom-checkbox text-left mb-4 mt-2">
            <input type="checkbox" v-model="form.remember" class="custom-control-input" id="inputRemember" value="true">
            <label class="custom-control-label" for="inputRemember">Save Credentials</label>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Sign in</button>
        </form>
      </div>
  </div>
</div>
</template>
<script setup>
import { reactive } from 'vue'
const form = reactive({
  email: '',
  password: '',
  remember: false
})

const handleSubmit = () => {

  const data = {
    email: form.email,
    password: form.password,
    remember: form.remember
  }

  //alert(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

  fetch('/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'csrf-token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
  }).then(response => response.json()).then(data => {
    console.log(data)
    if (data.success) {
      localStorage.setItem('token', data.token)
      window.location.href = '/backend/dashboard'
    } else {
      alert('Login failed')
    }
  }).catch(error => console.error(error))
}
</script>

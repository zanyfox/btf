<template>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link>
          </li>
          <li class="breadcrumb-item"><a href="#!">Профиль</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form @submit.prevent="updateProfile" enctype="multipart/form-data" novalidate>
        <div class="card pb-5">
          <div class="card-header">
            <h4 сlass="card-title">Редактирование профиля</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="mb-3">
                  <label for="inputName" class="form-label">Имя</label>
                  <input type="text" v-model.trim="formValues.name" class="form-control" :class="{'is-invalid': errors.name}" id="inputName" autocomplete="Name">
                  <span v-if="errors && errors.name" class="invalid-feedback">{{ errors.name[0] }}</span>
                </div>
                <div class="mb-3">
                  <label for="inputSurname" class="form-label">Фамилия</label>
                  <input type="text" v-model.trim="formValues.surname" class="form-control" id="inputSurname">
                </div>
                <h5 class="mt-5">Контактные данные</h5>
                <hr>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input
                      type="email"
                      v-model.trim="formValues.email"
                      class="form-control"
                      :class="{'is-invalid': errors.email}"
                      id="inputEmail"
                    >
                    <span class="invalid-feedback" v-if="errors && errors.email">{{ errors.email[0] }}</span>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="inputPhone" class="form-label">Телефон</label>
                    <input type="tel" v-model.trim="formValues.phone" class="form-control" id="inputPhone">
                    <div class="d-block"></div>
                  </div>
                </div>
                <h5 class="mt-5">Пароль <i class="feather icon-alert-circle"></i></h5>
                <hr>
                <div class="row">
                  <div class="mb-3 col-md-4">
                    <label for="inputCurrentPassword" class="form-label">Текущий пароль</label>
                    <input
                      type="password"
                      v-model.trim="formValues.currentPassword"
                      class="form-control"
                      :class="{'is-invalid': errors.currentPassword}"
                      id="inputCurrentPassword"
                    >
                    <span v-if="errors && errors.currentPassword" class="invalid-feedback">{{ errors.currentPassword[0] }}</span>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="inputNewPassword" class="form-label">Новый пароль</label>
                    <input
                      type="password"
                      v-model.trim="formValues.newPassword"
                      class="form-control"
                      :class="{'is-invalid': errors.newPassword}"
                      id="inputNewPassword"
                    >
                    <span v-if="errors && errors.newPassword" class="invalid-feedback">{{ errors.newPassword[0] }}</span>
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="inputNewPasswordConfirm" class="form-label">Подтвердить пароль</label>
                    <input
                      type="password"
                      v-model.trim="formValues.newPasswordConfirm"
                      class="form-control"
                      :class="{'is-invalid': errors.newPasswordConfirm}"
                      id="inputNewPasswordConfirm"
                    >
                    <span v-if="errors && errors.newPasswordConfirm" class="invalid-feedback">{{ errors.newPasswordConfirm[0] }}</span>
                  </div>
                  <p class="text-info text-center" title="Leave empty if not changing">Чтобы изменить пароль, вставьте значение, в противном случае оставьте пустым</p>
                </div>
              </div>
              <div class="col col-4">
                <div class="mb-3">
                  <label for="inputRole" class="form-label">Choose role</label>
                  <select v-model="formValues.role" class="form-control" id="inputRole">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name }}</option>
                  </select>
                  <div class="d-block"></div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input type="checkbox" name="status"  class="form-check-input" id="inputStatus">
                    <label class="form-check-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input type="checkbox" name="marketingoptin" class="form-check-input" id="inputMarketingoptin">
                    <label class="form-check-label" for="inputMarketingoptin">Маркетинговое согласие</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="inputAvatar" class="form-label">Profile Photo</label>
                  <div v-if="formValues.picture" class="upload-preview">
                    <div class="position-relative mb-3">
                      <img class="w-100 img-thumbnail" :src="formValues.picture" alt="">
                      <button type="button" @click="removePicture()" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;">
                        <i class="feather icon-trash"></i>
                      </button>
                    </div>
                  </div>
                  <label for="fileInput" class="form-label">Загрузить изображение</label>
                  <input type="file" name="picture" @change="handleFileChange" ref="fileInput" id="fileInput" class="d-none">
                  <div @click="openFileInput" id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <i class="feather icon-upload-cloud" style="font-size:52px;color:#04a9f5;"></i>
                    <p>Click or drag files here to upload</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="fixed-bottom pt-3 pb-3 w-100 bg-light ms-5" style="padding-left: 260px; z-index: 10; box-shadow: lightgrey -1px 0px 2px;">
          <button type="submit" class="btn btn-primary me-2">Обновить</button>
          <button type="button" data-url="http://127.0.0.1:8000/backend/profile" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">Отмена</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'

const roles = ref([])
const formValues = ref({
  name: '',
  surname: '',
  email: '',
  phone: '',
  picture: '',
  role: '',
  status: 1,
  marketingoptin: 0,
  currentPassword: '',
  newPassword: '',
  newPasswordConfirm: '',
})

const fileInput = ref(null)
const openFileInput = () => {
  fileInput.value.click()
}

const removePicture = () => {
  if(confirm('Вы уверены, что хотите удалить изображение?')) {

    formValues.value.picture = ''

    fetch('/api/backend/profile/remove-picture', {
      method: 'DELETE',
    }).then(response => response.json()).then(data => {
      if (data.success) {
        console.info('Picture removed successfully')
      }
    }).catch(error => {
      console.error('Error fetching user:', error.message)
    })

  }
}

const handleFileChange = (event) => {
  let file = event.target.files[0]

  if (file['size'] > 2111778) {
    toastr.error('File size must be less than 2MB', 'Oops!')
    return
  }

  console.log(URL.createObjectURL(file))

  // Method 1
  /* const formData = new FormData()
  formData.append('picture', file)
  //console.log(formData)
  fetch('/api/backend/profile/upload-picture', {
    method: 'POST',
    body: formData
  }).then(response => response.json()).then(data => {
    console.log(data.picture);

    if (data.success) {
      formValues.value.picture = data.picture
      console.info('Picture uploaded successfully:', data.picture)
    }
  }).catch(error => {
    console.error('Error fetching user:', error.message)
  }) */

  // Method 2
  const reader = new FileReader()
  reader.onloadend = () => {
    formValues.value.picture = reader.result
  }
  reader.readAsDataURL(file)

}

const errors = ref({})

const fetchUser = () => {
  fetch('/api/backend/profile/index').then(response => response.json()).then(data => {
    if (data.success) {
      formValues.value = data.user
      formValues.value.picture = '/uploads/users/' + formValues.value.picture
    }
  }).catch(error => {
    console.error('Error fetching user:', error.message)
  })
}

const updateProfile = () => {
  console.log(formValues.value);
  fetch('/api/backend/profile', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formValues.value)
  }).then(response => response.json()).then(data => {
    console.log(data);

    if (data.success) {
      toastr.success(data.message, 'Success')
      formValues.value.currentPassword = ''
      formValues.value.newPassword = ''
      formValues.value.newPasswordConfirm = ''

    } else {
      errors.value = data.errors
      toastr.error('Profile update failed', 'Error')
    }
  }).catch(error => console.error('Error updating profile:', error.message))
}

const fetchRoles = () => {
  fetch('/api/backend/roles')
  .then(response => response.json())
  .then(data => {
    roles.value = data.roles
  })
}

onMounted(() => {
  fetchUser(),
  fetchRoles()
})
</script>

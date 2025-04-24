<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard">Dashboard</router-link></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">

      <div class="d-flex justify-content-between mb-3">
        <div>
          <button type="button" @click.prevent="showCreateSettingModal = true" class="btn btn-secondary">
            <i class="fa fa-plus-circle mr-1"></i> New Setting
          </button>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Имя</th>
              <th scope="col">Ключ</th>
              <th scope="col">Значение</th>
              <th scope="col">Язык</th>
              <th scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(setting, index) in settings" :key="setting.id">
              <td>{{ index + 1 }}</td>
              <td>{{ setting.name }}</td>
              <td>{{ setting.key }}</td>
              <td>{{ setting.value }}</td>
              <td>{{ setting.lang }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning" @click="editSetting(setting.id)">
                  <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger ml-2" @click="deleteSetting(setting.id)">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div v-if="showCreateSettingModal" class="modal fade show" id="createSettingModal" style="display: block;" tabindex="-1" role="dialog" aria-labelledby="createSettingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createSettingModalLabel">Create New Setting</h5>
          <button @click.prevent="showCreateSettingModal = false" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="createSetting">
            <div class="form-group">
              <label for="settingName">Setting Name</label>
              <input type="text" class="form-control" id="settingName" v-model="newSetting.name" required>
            </div>
            <div class="form-group">
              <label for="settingKey">Setting Key</label>
              <input type="text" class="form-control" id="settingKey" v-model="newSetting.key" required>
            </div>
            <div class="form-group">
              <label for="settingValue">Setting Value</label>
              <input type="text" class="form-control" id="settingValue" v-model="newSetting.value" required>
            </div>
            <div class="form-group">
              <label for="settingLang">Language</label>
              <select class="form-control" id="settingLang" v-model="newSetting.lang">
                <option value="">Select Language</option>
                <option value="en">English</option>
                <option value="ru">Russian</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Setting</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div v-if="showEditSettingModal" class="modal fade show" style="display: block;" id="editSettingModal" tabindex="-1" role="dialog" aria-labelledby="editSettingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSettingModalLabel">Edit Setting</h5>
          <button type="button" class="close" @click.prevent="showEditSettingModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateSetting">
            <div class="form-group">
              <label for="settingName">Setting Name</label>
              <input type="text" class="form-control" id="settingName" v-model="editSettingData.name" required>
            </div>
            <div class="form-group">
              <label for="settingKey">Setting Key</label>
              <input type="text" class="form-control" id="settingKey" v-model="editSettingData.key" required>
            </div>
            <div class="form-group">
              <label for="settingValue">Setting Value</label>
              <input type="text" class="form-control" id="settingValue" v-model="editSettingData.value" required>
            </div>
            <div class="form-group">
              <label for="settingLang">Language</label>
              <select class="form-control" id="settingLang" v-model="editSettingData.lang">
                <option value="">Select Language</option>
                <option value="en">English</option>
                <option value="ru">Russian</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Setting</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>
<script setup>
import { ref, onMounted } from 'vue'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  timeOut: 5000
}
const settings = ref([])
const showCreateSettingModal = ref(false)
const showEditSettingModal = ref(false)

const newSetting = ref({
  name: '',
  key: '',
  value: '',
  lang: '',
  status: 1
})

const editSettingData = ref({
  id: null,
  name: '',
  key: '',
  value: '',
  lang: '',
  status: 1
})
const editSetting = (id) => {
  const setting = settings.value.find(setting => setting.id === id)
  if (setting) {
    editSettingData.value = { ...setting }
    showEditSettingModal.value = true
  }
}
const updateSetting = () => {
  fetch(`/api/backend/settings/${editSettingData.value.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(editSettingData.value)
  }).then(response => response.json()).then(data => {
    if (data.status === 'ok') {
      const index = settings.value.findIndex(setting => setting.id === editSettingData.value.id)
      if (index !== -1) {
        settings.value[index] = data.setting
      }
      toastr.success('Setting updated successfully', 'Success')
      showEditSettingModal.value = false
    } else {
      toastr.error(data.message, 'Error')
    }
  }).catch(error => {
    console.error('Error:', error)
    toastr.error('An error occurred while updating the setting', 'Error')
  })
}

const createSetting = () => {
  fetch('/api/backend/settings', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(newSetting.value)
  }).then(response => response.json()).then(data => {
    if (data.status === 'ok') {
      settings.value.push(data.setting)
      toastr.success('Setting created successfully', 'Success')
      showCreateSettingModal.value = false
    } else {
      toastr.error(data.message, 'Error')
    }
  }).catch(error => {
    console.error('Error:', error)
    toastr.error('An error occurred while creating the setting', 'Error')
  })
}

const deleteSetting = (id) => {
  // Logic to delete the setting
  console.log('Delete setting with ID:', id)
  // Example of using toastr for notifications
  toastr.success('Setting deleted successfully', 'Success')
  // Uncomment the line below to show an error message
  // toastr.error('Error', 'Error')
}

//toastr.error('Error', 'Error')

const getSettings = async () => {
  const data = await fetch('/api/backend/settings').then(res => res.json())
  if (data.status === 'ok') {
    settings.value = data.settings
  } else {
    // Handle error
    console.error(data.message)
  }
}

onMounted(() => {
  getSettings()
})
</script>

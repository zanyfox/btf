<template>
    <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link>
            </li>
            <li class="breadcrumb-item"><a href="#!">Settings</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 ref="pageTitle" class="card-title">Settings</h4>
      <button type="button" @click.prevent="showCreateSettingModal = true" title="Создать новый тип" class="btn btn-sm btn-primary">
        <i class="feather icon-plus"></i> New Setting
      </button>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Имя</th>
              <th>Ключ</th>
              <th>Значение</th>
              <th>Язык</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(setting, index) in settings" :key="setting.id">
              <td>{{ index + 1 }}</td>
              <td>{{ setting.name }}</td>
              <td>{{ setting.key }}</td>
              <td>{{ setting.value }}</td>
              <td>{{ setting.lang }}</td>
              <td class="text-end" style="width: 100px;">
                <button type="button" class="btn btn-sm btn-warning" @click="editSetting(setting.id)">
                  <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger ms-1" @click="deleteSetting(setting.id)">
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
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createSettingModalLabel">Create New Setting</h5>
          <button type="button" class="btn-close" @click.prevent="showCreateSettingModal = false" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="createSetting">
            <div class="mb-3">
              <label for="settingName" class="form-label">Setting Name</label>
              <input type="text" class="form-control" id="settingName" v-model="newSetting.name" required>
              <div class="invalid-feedback d-block text-danger text-sm" v-if="errors.name">{{ errors.name }}</div>
            </div>
            <div class="mb-3">
              <label for="settingKey" class="form-label">Setting Key</label>
              <input type="text" class="form-control" id="settingKey" v-model="newSetting.key" required>
              <div class="invalid-feedback d-block text-danger text-sm" v-if="errors.key">{{ errors.key }}</div>
            </div>
            <div class="mb-3">
              <label for="settingValue" class="form-label">Setting Value</label>
              <input type="text" class="form-control" id="settingValue" v-model="newSetting.value" required>
              <div class="invalid-feedback d-block text-danger text-sm" v-if="errors.value">{{ errors.value }}</div>
            </div>
            <div class="mb-3">
              <label for="settingLang" class="form-label">Language</label>
              <select class="form-control" id="settingLang" v-model="newSetting.lang">
                <option value="">Select Language</option>
                <option :value="lang.code" v-for="lang in langs" :key="lang.id">{{ lang.name }}</option>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSettingModalLabel">Edit Setting</h5>
          <button type="button" class="btn-close" @click.prevent="showEditSettingModal = false" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateSetting">
            <div class="mb-3">
              <label for="settingName" class="form-label">Setting Name</label>
              <input type="text" class="form-control" id="settingName" v-model="editSettingData.name" required>
            </div>
            <div class="mb-3">
              <label for="settingKey" class="form-label">Setting Key</label>
              <input type="text" class="form-control" id="settingKey" v-model="editSettingData.key" required>
            </div>
            <div class="mb-3">
              <label for="settingValue" class="form-label">Setting Value</label>
              <input type="text" class="form-control" id="settingValue" v-model="editSettingData.value" required>
            </div>
            <div class="mb-3">
              <label for="settingLang" class="form-label">Language</label>
              <select class="form-control" id="settingLang" v-model="editSettingData.lang">
                <option value="">Select Language</option>
                <option :value="lang.code" v-for="lang in langs" :key="lang.id">{{ lang.name }}</option>
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
import { useSettingsStore } from '@/stores/settings'

const errors = ref({
  name: '',
  key: '',
  value: ''
})

const settings = ref([])
const showCreateSettingModal = ref(false)
const showEditSettingModal = ref(false)

const settingsStore = useSettingsStore()
const langs = settingsStore.getLangs

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

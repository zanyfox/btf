<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><a href="#!">Типы</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 ref="pageTitle">Типы</h5>
      <button type="button" @click="addType" title="Создать новый тип" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> Новый тип
      </button>
    </div>
    <div class="card-body table-border-style">
      <div class="form-inline float-right">
        <div class="form-group mb-2">
          <label for="inputSearch" class="mr-2">Поиск</label>
          <input type="search" @input="searchTypes" class="form-control form-control-sm" id="inputSearch" placeholder="Поиск по названию или коду...">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Имя</th>
              <th>Код</th>
              <th>Статус</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(type, index) in types" :key="type.id">
              <td>{{ index + 1 }}</td>
              <td>{{ type.name }}</td>
              <td>{{ type.code }}</td>
              <td>
                <i class="feather" :class="type.status ? 'icon-check-circle text-success' : 'icon-slash text-danger'"></i>
              </td>
              <td class="text-right">
                <button type="button" @click.ptevent="editType(type)" title="Редактировать" class="btn btn-sm btn-info mr-1"><i class="feather icon-edit"></i></button>
                <a href="javascript:void(0)" type="button" @click.prevent="deleteType(type.id)" title="Удалить" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div v-if="showCreateModal" class="modal fade show" style="display: block;" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Новый тип</h4>
          <button type="button" class="close" @click="showCreateModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form @submit.prevent="createType">
            <div class="form-group">
              <label for="inputName">Название типа</label>
              <input
                v-model="formValues.name"
                type="text"
                class="form-control"
                id="inputName"
                placeholder="Enter name"
              />
              <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="inputCode">Код типа</label>
              <input
                v-model="formValues.code"
                type="text"
                class="form-control"
                id="inputCode"
              />
              <span v-if="errors.code" class="text-danger">{{ errors.code }}</span>
            </div>
            <div class="form-check mb-3">
              <input
                v-model="formValues.status"
                type="checkbox"
                class="form-check-input"
                id="inputStatus"
                value="1"
              />
              <label class="form-check-label" for="inputStatus">Активен</label>
            </div>
            <button type="submit" class="btn btn-primary" title="Save changes">Создать</button>
            <button type="button" @click="showCreateModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div v-if="showEditModal" class="modal fade show" style="display: block;" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Редактировать тип</h4>
          <button type="button" class="close" @click="showEditModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateType(formValues.id)">
            <div class="form-group">
              <label for="inputName">Название типа</label>
              <input
                v-model="formValues.name"
                type="text"
                class="form-control"
                id="inputName"
                placeholder="Enter name"
              />
              <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="inputCode">Код типа</label>
              <input
                v-model="formValues.code"
                type="text"
                class="form-control"
                id="inputCode"
              />
              <span v-if="errors.code" class="text-danger">{{ errors.code }}</span>
            </div>
            <div class="form-check mb-3">
              <input
                v-model="formValues.status"
                type="checkbox"
                class="form-check-input"
                id="inputStatus"
                value="1"
              />
              <label class="form-check-label" for="inputStatus">Активен</label>
            </div>
            <button type="submit" class="btn btn-primary" title="Save changes">Создать</button>
            <button type="button" @click="showEditModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-backdrop fade show" v-if="showCreateModal || showEditModal"></div>

</template>

<script setup>
import {onMounted, ref} from 'vue'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  timeOut: 5000
}
const types = ref([])
const formValues = ref({
  id: null,
  name: '',
  code: '',
  status: true
})
const showCreateModal = ref(false)
const showEditModal = ref(false)

const errors = ref({
  name: '',
  code: '',
  status: ''
})

const searchTypes = (e) => {
  const searchQuery = e.target.value
  if (searchQuery.length < 2) {
    fetchTypes()
    return
  }
  // Filter types based on search query
  types.value = types.value.filter(type => {
    return type.name.toLowerCase().includes(searchQuery.toLowerCase()) || type.code.toLowerCase().includes(searchQuery.toLowerCase())
  })
}

const fetchTypes = () => {
  fetch('/api/backend/types').then(response => response.json()).then(data => {
    if(data.status == 'ok') {
      types.value = data.types
    }
  }).catch(error => {
    console.error('Error fetching types:', error)
  })
}

const addType = () => {

  formValues.value.id  = null
  formValues.value.name = ''
  formValues.value.code = ''
  formValues.value.status = true

  errors.value.name = ''
  errors.value.code = ''
  errors.value.status = true

  showCreateModal.value = true
}

const createType = () => {
  fetch('/api/backend/types', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: formValues.value.name,
      code: formValues.value.code,
      status: formValues.value.status
    })
  }).then(response => response.json()).then(data => {

    if (data.status == 'success') {
      toastr.success('Type has been created successfully')
      //fetchTypes()
      types.value = data.types
      //types.value.push(data.type)
      formValues.value.id  = null
      formValues.value.name = ''
      formValues.value.code = ''
      formValues.value.status = true
      showCreateModal.value = false
    } else if (data.status == 'fail') {
      errors.value.name = data.errors.name ? data.errors.name[0] : ''
      errors.value.code = data.errors.code ? data.errors.code[0] : ''
    } else {
      toastr.error('Ошибка при создании типа')
    }
  }).catch(error => {
    console.error('Error creating type:', error)
  })
}

const editType = (type) => {
  formValues.value.id = type.id
  formValues.value.name = type.name
  formValues.value.code = type.code
  formValues.value.status = type.status

  errors.value.name = ''
  errors.value.code = ''

  showEditModal.value = true
}
const updateType = (id) => {
  fetch(`/api/backend/types/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: formValues.value.name,
      code: formValues.value.code,
      status: formValues.value.status
    })
  }).then(response => response.json()).then(data => {
    if (data.status == 'success') {
      fetchTypes()
      toastr.success('Тип успешно обновлен')
      showEditModal.value = false
    } else if (data.status == 'fail') {
      errors.value.name = data.errors.name ? data.errors.name[0] : ''
      errors.value.code = data.errors.code ? data.errors.code[0] : ''
    } else {
      toastr.error('Ошибка при обновлении типа')
    }
  }).catch(error => {
    console.error('Error updating type:', error)
  })
}

const deleteType = (id) => {
  if (confirm('Are you sure you want to delete this type?')) {
    fetch(`/api/backend/types/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(response => response.json()).then(data => {
      if (data.status == 'success') {
        //fetchTypes()
        types.value = types.value.filter(type => type.id !== id)
        toastr.success('Type has been deleted successfully')
      } else {
        toastr.error('Error deleting type')
      }
    }).catch(error => {
      console.error('Error deleting type:', error)
    })
  }
}

const pageTitle = ref(null)

onMounted(() => {
  const documentTitle = pageTitle.value.innerText + ' | ' + document.title;
  document.title = documentTitle
  fetchTypes()
})
</script>

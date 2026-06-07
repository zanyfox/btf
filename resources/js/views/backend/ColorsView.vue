<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><a href="#!">Цвета</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 ref="pageTitle">Цвета</h5>
      <button type="button" @click="addColor" title="Создать новый цвет" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> Новый цвет
      </button>
    </div>
    <div class="card-body table-border-style">
      <div class="form-inline float-right">
        <div class="form-group mb-2">
          <label for="inputSearch" class="mr-2">Поиск</label>
          <input type="search" @input="searchColors" class="form-control form-control-sm" id="inputSearch" placeholder="Поиск по названию или коду...">
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
            <tr v-for="(color, index) in colors" :key="color.id">
              <td>{{ index + 1 }}</td>
              <td>{{ color.name }}</td>
              <td>
                <span class="badge" :style="`background-color: ${color.code}; color: ${shouldUseWhiteText(color.code) ? 'black' : 'white'}`">{{ color.code }}</span>
              </td>
              <td>
                <i class="feather" :class="color.status ? 'icon-check-circle text-success' : 'icon-slash text-danger'"></i>
              </td>
              <td class="text-right">
                <button type="button" @click.ptevent="editColor(color)" title="Редактировать" class="btn btn-sm btn-info mr-1"><i class="feather icon-edit"></i></button>
                <a href="javascript:void(0)" type="button" @click.prevent="deleteColor(color.id)" title="Удалить" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></a>
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
          <h4 class="modal-title">Новый цвет</h4>
          <button type="button" class="close" @click="showCreateModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form @submit.prevent="createColor">
            <div class="form-group">
              <label for="inputName">Название цвета</label>
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
              <label for="inputCode">Код цвета</label>
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
          <h4 class="modal-title">Редактировать цвет</h4>
          <button type="button" class="close" @click="showEditModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateColor(formValues.id)">
            <div class="form-group">
              <label for="inputName">Название цвета</label>
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
              <label for="inputCode">Код цвета</label>
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
const colors = ref([])
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

const searchColors = (e) => {
  const searchQuery = e.target.value
  if (searchQuery.length < 2) {
    fetchColors()
    return
  }
  // Filter colors based on search query
  colors.value = colors.value.filter(color => {
    return color.name.toLowerCase().includes(searchQuery.toLowerCase()) || color.code.toLowerCase().includes(searchQuery.toLowerCase())
  })
}

const fetchColors = () => {
  fetch('/api/backend/colors').then(response => response.json()).then(data => {
    if(data.status == 'ok') {
      colors.value = data.colors
    }
  }).catch(error => {
    console.error('Error fetching colors:', error)
  })
}

const addColor = () => {

  formValues.value.id  = null
  formValues.value.name = ''
  formValues.value.code = ''
  formValues.value.status = true

  errors.value.name = ''
  errors.value.code = ''
  errors.value.status = true

  showCreateModal.value = true
}

const createColor = () => {
  console.log('Creating color:', formValues.value)
  fetch('/api/backend/colors', {
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
      toastr.success('Color has been created successfully')
      //fetchColors()
      colors.value = data.colors
      //colors.value.push(data.color)
      formValues.value.id  = null
      formValues.value.name = ''
      formValues.value.code = ''
      formValues.value.status = true
      showCreateModal.value = false
    } else if (data.status == 'fail') {
      errors.value.name = data.errors.name ? data.errors.name[0] : ''
      errors.value.code = data.errors.code ? data.errors.code[0] : ''
    } else {
      toastr.error('Ошибка при создании цвета')
    }
  }).catch(error => {
    console.error('Error creating color:', error)
  })
}

const editColor = (color) => {
  formValues.value.id = color.id
  formValues.value.name = color.name
  formValues.value.code = color.code
  formValues.value.status = color.status

  errors.value.name = ''
  errors.value.code = ''

  showEditModal.value = true
}
const updateColor = (id) => {
  fetch(`/api/backend/colors/${id}`, {
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
      //fetchColors()
      const index = colors.value.findIndex(color => color.id === id)

      if (index !== -1) {
        colors.value[index].name = data.color.name
        colors.value[index].code = data.color.code
        colors.value[index].status = data.color.status
      }
      toastr.success('Цвет успешно обновлен')
      showEditModal.value = false
    } else if (data.status == 'fail') {
      errors.value.name = data.errors.name ? data.errors.name[0] : ''
      errors.value.code = data.errors.code ? data.errors.code[0] : ''
    } else {
      toastr.error('Ошибка при обновлении цвета')
    }
  }).catch(error => {
    console.error('Error updating color:', error)
  })
}

const deleteColor = (id) => {
  if (confirm('Are you sure you want to delete this color?')) {
    fetch(`/api/backend/colors/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(response => response.json()).then(data => {
      if (data.status == 'success') {
        //fetchColors()
        colors.value = colors.value.filter(color => color.id !== id)
        toastr.success('Color has been deleted successfully')
      } else {
        toastr.error('Error deleting color')
      }
    }).catch(error => {
      console.error('Error deleting color:', error)
    })
  }
}

function shouldUseWhiteText(hexColor) {
  hexColor = hexColor.replace('#', '')
  const r = parseInt(hexColor.substring(0, 2), 16) / 255
  const g = parseInt(hexColor.substring(2, 4), 16) / 255
  const b = parseInt(hexColor.substring(4, 6), 16) / 255
  // Рассчитываем относительную яркость (по формуле W3C)
  const luminance = 0.2126 * r + 0.7152 * g + 0.0722 * b
  return luminance > 0.5
}

const pageTitle = ref(null)

onMounted(() => {
  const documentTitle = pageTitle.value.innerText + ' | ' + document.title;
  document.title = documentTitle
  fetchColors()
})
</script>

<template>
	<div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link>
          </li>
          <li class="breadcrumb-item"><a href="#!" ref="pageTitle">{{ $t('Users') }}</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card" v-if="!isLoading && $gate.isAdmin()">
    <div class="card-body table-border-style">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link text-uppercase" :class="{'active': activeTab === 'users'}" @click="changeTab('users')" data-bs-toggle="tab" data-bs-target="#usersTab" role="tab" aria-controls="usersTab" aria-selected="true">{{ $t('Users') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase" :class="{'active': activeTab === 'roles'}" @click="changeTab('roles')" data-bs-toggle="tab" data-bs-target="#rolesTab" role="tab" aria-controls="rolesTab" aria-selected="false">Роли</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase" :class="{'active': activeTab === 'permissions'}" @click="changeTab('permissions')" data-bs-toggle="tab" data-bs-target="#permissionsTab" role="tab" aria-controls="permissionsTab" aria-selected="false">Разрешения</a>
        </li>
      </ul>

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" :class="{'active show': activeTab === 'users'}" id="usersTab" role="tabpanel" aria-labelledby="usersTab">
          <div class="card-header mb-3 px-0 d-flex justify-content-between align-items-center">
            <h4>Пользователи</h4>
            <button type="button" class="btn btn-sm btn-primary" @click="addUserModal">
              <i class="feather icon-user-plus"></i> Новый пользователь
            </button>
          </div>

          <div class="d-flex" :class="selectedUsers.length ? 'justify-content-between' : 'justify-content-end'">
            <div v-if="selectedUsers.length" class="form-inline d-flex align-items-center gap-3">
              <div class="form-group">
                <select @change="bulkModify" class="form-control form-control-sm" id="inputBulkAction">
                  <option value="" disabled selected>Выберите действие</option>
                  <option value="ban">Заблокировать выбранных</option>
                  <option value="unban">Разблокировать выбранных</option>
                </select>
              </div>
              <span class="text-muted">Selected: {{ selectedUsers.length }}</span>
              <!-- <div class="form-group mb-2">
                <label for="inputPerPage" class="mr-1">Смотреть</label>
                <select class="form-control form-control-sm mr-1" id="inputPerPage">
                  <option value="10" selected>10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
                <label>записей</label>
              </div> -->
            </div>
            <div class="form-inline">
              <div class="form-group">
                <input
                  type="search"
                  v-model="searchQuery"
                  class="form-control form-control-sm"
                  placeholder="Поиск по имени, email, телефону..."
                >
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><input type="checkbox" @change="selectAllUsers" :checked="selectedUsers.length === users.data.length"></th>
                  <th>#</th>
                  <th>Имя</th>
                  <th>Email</th>
                  <th>Телефон</th>
                  <th>Роли</th>
                  <th>Дата создания</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody v-if="users.data.length > 0">
                <tr v-for="user in users.data" :key="user.id">
                  <td><input type="checkbox" :checked="selectedUsers.includes(user.id)" @change="toggleSelection(user)"></td>
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.phone }}</td>
                  <td>{{ user.role }}
                    <!-- <span v-for="(userRole, index) in user.roles" :key="index" class="badge rounded-pill bg-info ms-1">{{ userRole.name }}</span> -->
                  </td>
                  <td>
                    {{ moment(String(user.created_at)).format('DD.MM.YYYY HH:mm') }}
                  </td>
                  <td class="text-end">
                    <button type="button" @click.prevent="changeStatus(user)" class="btn btn-sm me-1" :class="user.status !== 1 ? 'btn-danger' : 'btn-success'" title="Изменить статус">
                      <i class="fa" :class="user.status !== 1 ? 'fa-lock' : 'fa-lock-open'"></i>
                    </button>
                    <button type="button" @click.prevent="editUserModal(user)" class="btn btn-sm btn-info" title="Редактировать">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" @click.prevent="deleteUser(user)" class="btn btn-sm btn-danger ms-1" title="Удалить">
                      <i class="fa fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="7" class="text-center">No results found</td>
                </tr>
              </tbody>
            </table>
          </div>

          <Bootstrap4Pagination :data="users" @pagination-change-page="fetchUsers" />

        </div>
        <div class="tab-pane fade" :class="{'active show': activeTab === 'roles'}" id="rolesTab" role="tabpanel" aria-labelledby="rolesTab">
          <RolesComponent />
        </div>
        <div class="tab-pane fade" :class="{'active show': activeTab === 'permissions'}" id="permissionsTab" role="tabpanel" aria-labelledby="permissionsTab">
          <PermissionsComponent />
        </div>
      </div>
    </div>
  </div>

  <div v-if="showUserFormModal" class="modal fade show d-block" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <span v-show="editMode">Редактировать пользователя</span>
            <span v-show="!editMode">Новый пользователь</span>
          </h5>
          <button type="button" class="btn-close" @click.prevent="showUserFormModal = false" aria-label="Close"></button>
        </div>
        <Form @submit="handleSubmit" v-slot:default="{ errors }" :initial-values="formValues">
          <div class="modal-body">
            <div class="row">
              <div class="col col-8">
                <div class="mb-2">
                  <label for="inputName" class="form-label">Имя</label>
                  <Field
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': errors.name }"
                    id="inputName"
                    placeholder="Enter name"
                  />
                  <span v-if="errors.name" class="invalid-feedback">{{ errors.name }}</span>
                </div>
                <div class="form-group">
                  <label for="inputSurname" class="form-label">Фамилия</label>
                  <Field
                    type="text"
                    name="surname"
                    class="form-control"
                    :class="{ 'is-invalid': errors.surname }"
                    id="inputSurname"
                  />
                  <span v-if="errors.surname" class="invalid-feedback">{{ errors.surname }}</span>
                </div>
                <h5 class="mt-4">Контактные данные</h5>
                <hr>
                <div class="row">
                  <div class="mb-2 col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <Field
                      type="email"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid': errors.email }"
                      id="inputEmail"
                      placeholder="Enter email"
                    />
                    <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>
                  </div>
                  <div class="mb-2 col-md-6">
                    <label for="inputPhone" class="form-label">Телефон</label>
                    <Field
                      type="text"
                      name="phone"
                      class="form-control"
                      :class="{ 'is-invalid': errors.phone }"
                      id="inputPhone"
                      placeholder="Enter phone"
                    />
                    <span v-if="errors.phone" class="invalid-feedback">{{ errors.phone }}</span>
                  </div>
                </div>
                <h5 class="mt-5">Задать пароль</h5>
                <hr>
                <div class="row">
                  <div class="mb-2 col-md-8">
                    <label for="inputPassword" class="form-label">Пароль</label>
                    <Field
                      type="password"
                      name="password"
                      class="form-control"
                      :class="{ 'is-invalid': errors.password }"
                      id="inputPassword"
                      placeholder="Enter password"
                    />
                    <span v-if="errors.password" class="invalid-feedback">{{ errors.password }}</span>
                  </div>
                </div>
              </div>
              <div class="col col-4">
                <div class="mb-3">
                  <label for="inputRole" class="form-label">Choose role</label>
                  <Field name="role" as="select" class="form-control" id="inputRole">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name }}</option>
                  </Field>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="inputStatus" :checked="formValues.status">
                    <label class="form-check-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="inputBirthdate" class="form-label">Birth date</label>
                  <Field
                    type="date"
                    name="birthdate"
                    class="form-control flatpickr"
                    :class="{ 'is-invalid': errors.birthdate }"
                    id="inputBirthdate"
                    placeholder="Enter birth date"
                  />
                  <span class="invalid-feedback" v-if="errors.birthdate">{{ errors.birthdate }}</span>
                </div>
                <div class="mb-3">
                  <label for="uploadFile" class="form-label">Изображение</label>
                  <input type="hidden" value="" id="inputImageId">
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <i class="feather icon-upload-cloud" style="font-size: 52px; color: #04a9f5;"></i>
                    <p>Click or drag files here to upload</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" title="Save changes">{{ editMode ? 'Сохранить' : 'Создать' }}</button>
            <button type="button" @click.prevent="showUserFormModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, inject } from 'vue'
import { Form, Field} from 'vee-validate'
import * as yup from 'yup'
import moment from 'moment'
import { debounce } from 'lodash'
import { Bootstrap4Pagination } from 'laravel-vue-pagination'
import flatpickr from 'flatpickr'
import 'flatpickr/dist/flatpickr.min.css'
import PermissionsComponent from '@/components/Permissions.vue'
import RolesComponent from '@/components/Roles.vue'

const editMode = ref(false)
const showUserFormModal = ref(false)

const users = ref({'data': []})
const roles = ref([])
const formValues = ref({
  name: '',
  surname: '',
  email: '',
  phone: '',
  password: '',
  role: '',
  status: true,
  birthdate: ''
})
/* const formValues = new Form({
  name: '',
  surname: '',
  email: '',
  phone: '',
  password: '',
  role: '',
  status: true,
  birthdate: ''
}) */

const errors = ref({
  name: '',
  surname: '',
  email: '',
  phone: '',
  password: '',
  role: '',
  status: '',
  birthdate: ''
})

const searchQuery = ref(null)

watch(searchQuery, debounce((newValue) => {
  if (newValue) {
    searchUsers()
  } else {
    fetchUsers()
  }
}, 300))

const searchUsers = () => {
  if(gate.isAdmin() && searchQuery.value.length >= 2) {
    // Fetch users from the backend
    fetch('/api/backend/users?search=' + searchQuery.value).then(response => response.json()).then(data => {
      users.value.data = data.users.data
    }).catch(error => {
      console.error('Error fetching users:', error.message)
    })
  }
  return users.value
}

const gate = inject('gate')

const fetchUsers = ($page = 1) => {
  if( gate.isAdmin() ) {
    fetch(`/api/backend/users/?page=${$page}`).then(response => response.json()).then(data => {
      users.value = data.users
      selectedUsers.value = []
    }).catch(error => {
      console.error('Error fetching users:', error.message)
    })
  }
}

/* const createUserSchema = yup.object({
  name: yup.string().required('Name is required').min(2, 'Name must be at least 2 characters long'),
  email: yup.string().required('Email is required').email('Email must be a valid email address'),
  //phone: yup.string().min(10, 'Phone must be at least 10 characters long'),
  password: yup.string().required('Password is required').min(8, 'Password must be at least 8 characters long'),
  //role: yup.string().required('Role is required').oneOf(['admin', 'user'], 'Role must be either admin or user')
})

const editUserSchema = yup.object({
  name: yup.string().required('Name is required').min(2, 'Name must be at least 2 characters long'),
  email: yup.string().required('Email is required').email('Email must be a valid email address'),
  phone: yup.string().min(10, 'Phone must be at least 10 characters long'),
  //password: yup.string().min(8, 'Password must be at least 8 characters long'),
  //role: yup.string().required('Role is required').oneOf(['admin', 'user'], 'Role must be either admin or user')
  password: yup.string().when((password, field) => {
    // If password is empty, return the field without any validation
    return password[0] != '' ? field.required('Password is required').min(8, 'Password must be at least 8 characters long') : field
  })
}) */

const addUserModal = () => {
  resetForm() // Reset the form fields
  editMode.value = false
  showUserFormModal.value = true
}

const editUserModal = (user) => {
  resetForm()
  editMode.value = true
  formValues.value = {
    id: user.id,
    name: user.name,
    surname: user.surname,
    email: user.email,
    phone: user.phone,
    password: '',
    role: user.role,
    status: user.status,
    birthdate: user.birthdate
  }
  showUserFormModal.value = true
}

const handleSubmit = (values, actions) => {
  if (editMode.value) {
    updateUser(values, actions)
  } else {
    createUser(values, actions)
  }
}

const createUser = (values, actions) => {

  fetch('/api/backend/users', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(values)
  }).then(response => response.json()).then(data => {
    console.log(data)

    if(data.status === 'fail') {
      errors.value.name = data.errors.name ? data.errors.name[0] : ''
      errors.value.email = data.errors.email ? data.errors.email[0] : ''
    }

    if (data.success) {
      users.value.data.unshift(data.user)
      swal.fire({
        icon: 'success',
        title: 'User created successfully',
        showConfirmButton: false,
        timer: 1500
      })
    } else {
      // Handle validation errors
      /* console.log('Validation errors:', data.errors)
      if (data.errors.email) {
        setFieldError('email', data.errors.email[0])
      }
      if (data.errors) {
        setErrors(data.errors)
      } */
      //actions.setErrors(data.errors)
    }
  }).catch(error => {
    //actions.setErrors(error.response.data.errors)
    console.error('Error creating user:', error.message)
  }).finally(() => {
    //showUserFormModal.value = false
    //resetForm()
  })

}

const updateUser = (values, actions) => {

  const formValues = {
    name: values.name,
    surname: values.surname,
    email: values.email,
    phone: values.phone,
    //role: values.role,
    //password: values.password
  }
  fetch(`/api/backend/users/${values.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formValues)
  }).then(response => response.json()).then(data => {
    //fetchUsers()
    // Update the user in the users array
    const index = users.value.data.findIndex(user => user.id === data.user.id)
    users.value.data[index] = data.user
    showUserFormModal.value = false
    swal.fire({
      icon: 'success',
      title: 'User updated successfully',
      showConfirmButton: false,
      timer: 1500
    })
  }).catch(error => {
    console.log(actions);

    /*console.log(error.response.data.errors);
    actions.setFieldError('email', error.response.data.errors.email[0]) */
    //actions.setErrors(error.response.data.errors)
    console.error('Error updating user:', error.message)
  }).finally(() => {
    resetForm()
  })

}

const resetForm = () => {
  formValues.value = {
    name: '',
    email: '',
    phone: '',
    password: '',
    role: '',
    status: true
  }
}

const deleteUser = (user) => {
  swal.fire({
    title: 'Are you sure you want to delete ' + user.name + '?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#04a9f5',
      cancelButtonColor: '#f44236',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
        // Send request to the server
        fetch(`/api/backend/users/${user.id}`, {
          method: 'DELETE'
        }).then(response => {
          if (response.status === 204) {
            // Remove the user from the users array
            const index = users.value.data.findIndex(u => u.id === user.id)
            if (index !== -1) {
              users.value.data.splice(index, 1)
            }
            swal.fire('Deleted!','User has been deleted.','success')
          } else {
            swal.fire('Error!','Error deleting user','error')
          }
        }).catch(error => {
          console.error('Error deleting user:', error.message)
        })
      }
  })
}

function changeStatus(user) {
  axios.patch(`/api/backend/users/${user.id}/change-status`, {
    status: user.status === 1 ? 0 : 1
  }).then(response => {
    // Update the user in the users array
    const index = users.value.data.findIndex(u => u.id === response.data.user.id)
    users.value.data[index] = response.data.user

    swal.fire({
      icon: 'success',
      title: 'User status updated successfully',
      showConfirmButton: false,
      timer: 1500
    })

  }).catch(error => {
    console.error('Error updating user role:', error.message)
  })
}

const selectedUsers = ref([])

const selectAllUsers = () => {
  if(selectedUsers.value.length < users.value.data.length) {
    selectedUsers.value = users.value.data.map(user => user.id)
  } else {
    selectedUsers.value = []
  }
}

const toggleSelection = (user) => {
  const index = selectedUsers.value.indexOf(user.id)
  if (index !== -1) {
    selectedUsers.value.splice(index, 1)
  } else {
    selectedUsers.value.push(user.id)
  }
  //selectedUsers.value.push(user.id)
  /* selectedUsers.value = selectedUsers.value.includes(userId)
    ? selectedUsers.value.filter((id) => id !== userId)
    : [...selectedUsers.value, userId] */
  //console.log('Selected User IDs:', selectedUsers.value)
}

const bulkModify = (event) => {
  switch (event.target.value) {
    case 'ban':
      fetch('/api/backend/users/bulk-ban', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          ids: selectedUsers.value
        })
      })
      .then(response => {
        if (response.ok) {
          fetchUsers()
          selectedUsers.value = []

          swal.fire({
            icon: 'success',
            title: 'Users has been banned',
            showConfirmButton: false,
            timer: 1500
          })

        }
      }).catch(error => {
        console.error('Error bulk modifying users:', error.message)
      })
      break
    case 'unban':
      fetch('/api/backend/users/bulk-unban', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          ids: selectedUsers.value
        })
      })
      .then(response => {
        if (response.ok) {
          fetchUsers()
          selectedUsers.value = []

          swal.fire({
            icon: 'success',
            title: 'Users has been unbanned',
            showConfirmButton: false,
            timer: 1500
          })

        }
      }).catch(error => {
        console.error('Error bulk modifying users:', error.message)
      })
      break
  }
}

const fetchRoles = () => {
  fetch('/api/backend/roles')
  .then(response => response.json())
  .then(data => {
    roles.value = data.roles
  })
}

const pageTitle = ref(null)

const isLoading = ref(true)
const activeTab = ref('users')
const changeTab = (tab) => {
  activeTab.value = tab
  localStorage.setItem('activeTab', activeTab.value)
  //console.log(activeTab.value);

}

onMounted(() => {

  activeTab.value = localStorage.getItem('activeTab') || 'users'


  const documentTitle = pageTitle.value.innerText + ' | ' + document.title;
  document.title = documentTitle

  flatpickr('.flatpickr', {
    enableTime: false,
    dateFormat: 'Y-m-d',
  })

  fetchUsers()
  fetchRoles()
  isLoading.value = false
  //setInterval(fetchUsers, 3000)
  //toastr.success('User has been created successfully', 'Success')
})
</script>

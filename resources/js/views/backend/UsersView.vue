<template>
	<div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
          <li class="breadcrumb-item"><a href="#!" ref="pageTitle">Пользователи</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body table-border-style">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-uppercase active" data-toggle="tab" href="#usersTab" role="tab" aria-controls="usersTab" aria-selected="true">Пользователи</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" data-toggle="tab" href="#rolesTab" role="tab" aria-controls="rolesTab" aria-selected="false">Роли</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" data-toggle="tab" href="#permissionsTab" role="tab" aria-controls="permissionsTab" aria-selected="false">Разрешения</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade active show" id="usersTab" role="tabpanel" aria-labelledby="usersTab">
              <div class="card-header mb-3 px-0">
                <h5>Пользователи</h5>
                <button type="button" class="btn btn-sm btn-primary float-right" @click="addUser">
                  <i class="feather icon-plus"></i> Новый пользователь
                </button>
              </div>

              <div class="form-inline float-left">
                <div class="form-group mb-2">
                  <select @change="bulkModify" class="form-control form-control-sm" id="inputBulkAction">
                    <option value="" disabled>Выберите действие</option>
                    <option value="unactiveSelected">Заблокировать выбранных</option>
                    <option value="deleteSelected">Удалить выбранных</option>
                  </select>
                </div>
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
              <div class="form-inline float-right">
                <div class="form-group mb-2">
                  <label for="inputSearch" class="mr-2">Поиск</label>
                  <input type="search" v-model="searchQuery" class="form-control form-control-sm" id="inputSearch" placeholder="Поиск по имени, email, телефону...">
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-sm2 table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox" @change="toggleAllSelection"></th>
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
                      <td><input type="checkbox" @change="toggleSelection(user.id)"></td>
                      <td>{{ user.id }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.phone }}</td>
                      <td>
                        <span v-for="(userRole, index) in user.roles" :key="index" class="badge badge-primary mr-1">{{ userRole.name }}</span>
                      </td>
                      <td>{{ moment(String(user.created_at)).format('DD.MM.YYYY HH:mm') }}</td>
                      <td class="text-right">
                        <button type="button" @click.prevent="changeStatus(user)" class="btn btn-sm mr-1" :class="user.status !== 1 ? 'btn-danger' : 'btn-success'" title="Изменить статус">
                          <i class="fa" :class="user.status !== 1 ? 'fa-lock' : 'fa-lock-open'"></i>
                        </button>
                        <button type="button" @click.prevent="editUserModal(user)" class="btn btn-sm btn-info" title="Редактировать">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" @click.prevent="deleteUser(user)" class="btn btn-sm btn-danger ml-1" title="Удалить пользователя">
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
            <div class="tab-pane fade" id="rolesTab" role="tabpanel" aria-labelledby="rolesTab">

              <div class="card-header mb-3 px-0">
                <h5>Роли</h5>
                <a href="https://btf.su/admin/roles/create" title="Создать новую роль" class="btn btn-sm btn-primary float-right">
                  <i class="feather icon-plus"></i> Добавить роль                </a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Имя</th>
                      <th scope="col">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody v-if="roles.length > 0">
                    <tr v-for="role in roles" :key="role.id">
                      <td v-text="role.id"></td>
                      <td v-text="role.name"></td>
                      <td class="text-right">
                        <button type="button" @click="givePermissions(role.id)" title="Add/Edit Role Permission" class="btn btn-sm btn-warning mr-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                        </button>
                        <button type="button" @click="editRole(role.id)" title="Редактировать" class="btn btn-sm btn-info mr-1">
                          <i class="feather icon-edit"></i>
                        </button>
                        <button type="button" @click="deleteRole(role.id)" title="Удалить" class="btn btn-sm btn-danger">
                          <i class="feather icon-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="3" class="text-center">No results found</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="permissionsTab" role="tabpanel" aria-labelledby="permissionsTab">
              <div class="card-header mb-3 px-0">
                <h5>Разрешения</h5>
                <a href="https://btf.su/admin/permissions/create" title="admin.CreateNewPermission" class="btn btn-sm btn-primary float-right">
                  <i class="feather icon-plus"></i> Добавить разрешение                </a>
              </div>
              <div class="table-responsive">
                <table id="dataTable2" class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Имя</th>
                      <th scope="col">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="permission in permissions" :key="permission.id">
                      <td>{{ permission.id }}</td>
                      <td>{{ permission.name }}</td>
                      <td class="text-right">
                        <a href="https://btf.su/admin/permissions/1/edit" title="Редактировать" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                        <button type="button" onclick="deletePermission(permission.id)" title="Удалить" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-if="showUserFormModal" class="modal fade show" style="display: block;" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <span v-if="editMode">Редактировать пользователя</span>
            <span v-else>Новый пользователь</span>
          </h4>
          <button type="button" class="close" @click="showUserFormModal = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <Form ref="userForm" @submit="handleSubmit" :validation-schema="editMode ? editUserSchema : createUserSchema" v-slot="{ errors }" :initial-values="formValues">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">Имя</label>
                  <Field
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': errors.name }"
                    id="inputName"
                    placeholder="Enter name"
                  />
                  <!-- <ErrorMessage name="name" class="invalid-feedback" /> -->
                  <span v-if="errors.name" class="invalid-feedback">{{ errors.name }}</span>
                </div>
                <div class="form-group">
                  <label for="inputSurname">Фамилия</label>
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
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
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
                  <div class="form-group col-md-6">
                    <label for="inputPhone">Телефон</label>
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
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputPassword">Пароль</label>
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
                  <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">Подтвердить пароль</label>
                    <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword">
                  </div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputRole">Роли</label>
                  <select name="roles[]" multiple class="form-control" id="inputRoles">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option v-for="role in roles" :value="role.value" :key="role.value">{{ role.name }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked="checked" class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="uploadFile">Изображение</label>
                  <input type="hidden" value="" id="inputImageId">
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <div class="dz-message needsclick">
                      <h5 class="text-primary mt-5">Нажмите здесь или перетащите сюда файлы для загрузки</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" :disabled="errors.length" class="btn btn-primary" title="Save changes">Создать</button>
            <button type="button" @click="showUserFormModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </Form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import { Form, Field, ErrorMessage } from 'vee-validate'
import * as yup from 'yup'
import moment from 'moment'
import { debounce } from 'lodash'
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import { formatDate } from '@/helper'
import Swal from 'sweetalert2'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  timeOut: 5000
}
const users = ref({'data': []})
const roles = ref([])
const permissions = ref([])
const showUserFormModal = ref(false)
const editMode = ref(false)
const formValues = ref({
  name: '',
  surname: '',
  email: '',
  phone: '',
  password: '',
  confirm_password: '',
  roles: [1],
  status: 1
})
const userForm = ref(null)
const searchQuery = ref(null)

watch(searchQuery, debounce((newValue) => {
  if (newValue) {
    searchUsers()
  } else {
    fetchUsers()
  }
}, 300))

/* function debounce(fn, delay) {
  let timeoutId;
  return function(...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => fn.apply(this, args), delay);
  };
} */

const searchUsers = () => {

  // Fetch users from the backend
  fetch('/api/backend/users?search=' + searchQuery.value).then(response => response.json()).then(data => {
    users.value.data = data.users.data
  }).catch(error => {
    console.error('Error fetching users:', error.message)
  })

  return users.value
}

const fetchUsers = ($page = 1) => {
  try {
    fetch(`/api/backend/users/?page=${$page}`).then(response => response.json()).then(data => {
      users.value = data.users
      roles.value = data.roles
      permissions.value = data.permissions
    })
  } catch (error) {
    console.error('Error fetching users:', error.message)
  }
}

const createUserSchema = yup.object({
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
})

const addUser = () => {
  //userForm.value.resetForm()
  formValues.value = {
    name: '',
    surname: '',
    email: '',
    phone: '',
    password: '',
    confirm_password: '',
    roles: [],
    status: 1
  }
  editMode.value = false
  showUserFormModal.value = true
}

const createUser = (values, { resetForm, setFieldError, setErrors }) => {

  fetch('/api/backend/users', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(values)
  }).then(response => response.json()).then(data => {
    if (data.status === 'ok') {
      users.value.data.unshift(data.user)
      resetForm()
      showUserFormModal.value = false
      toastr.success('User created successfully', 'Success')
    } else {
      // Handle validation errors
      console.log('Validation errors:', data.errors)
      /* if (data.errors.email) {
        setFieldError('email', data.errors.email[0])
      } */
      if (data.errors) {
        setErrors(data.errors)
      }
    }
  }).catch(error => {
    console.error('Error creating user:', error.message)
  })

}

const editUserModal = (user) => {
  formValues.value = {
    id: user.id,
    name: user.name,
    surname: user.surname,
    email: user.email,
    phone: user.phone,
    password: '',
    role: user.role
  }
  editMode.value = true
  showUserFormModal.value = true
}
const updateUser = (values, actions) => {
  axios.put(`/api/backend/users/${values.id}`, {
    name: values.name,
    email: values.email,
    phone: values.phone,
    //role: values.role,
    //password: values.password
  }).then(response => {
    // Update the user in the users array
    const index = users.value.data.findIndex(user => user.id === response.data.user.id)
    users.value.data[index] = response.data.user
    //fetchUsers()
    showUserFormModal.value = false

    toastr.success('User updated successfully', 'Success')

    // Reset the form
    /* formValues.value = {
      name: '',
      email: '',
      phone: '',
      password: '',
      role: ''
    } */

  }).catch(error => {

    /* console.log(actions);

    console.log(error.response.data.errors);
    actions.setFieldError('email', error.response.data.errors.email[0]) */
    //actions.setErrors(error.response.data.errors)
    console.error('Error updating user:', error.message)
  }).finally(() => {
    actions.resetForm()
    // Reset the form
    /* formValues.value = {
      name: '',
      email: '',
      phone: '',
      password: '',
      role: ''
    } */
  })
}

const handleSubmit = (values, actions) => {
  if (editMode.value) {
    updateUser(values, actions)
  } else {
    createUser(values, actions)
  }
}

const deleteUser = (user) => {

  Swal.fire({
    title: 'Are you sure you want to delete ' + user.name + '?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
      if (result.isConfirmed) {
        fetch(`/api/backend/users/${user.id}`, {
          method: 'DELETE'
        }).then(response => response.json()).then(data => {
          if (data.status === 'ok') {
            // Remove the user from the users array
            const index = users.value.data.findIndex(u => u.id === user.id)
            if (index !== -1) {
              users.value.data.splice(index, 1)
            }
            toastr.success('User deleted successfully', 'Success')
          } else {
            toastr.error('Error deleting user', 'Error')
          }
        }).catch(error => {
          console.error('Error deleting user:', error.message)
        })
      }
  })


  /* if (confirm('Are you sure you want to delete ' + user.name + '?')) {
    axios.delete(`/api/backend/users/${user.id}`).then(response => {

      // Remove the user from the users array
      const index = users.value.findIndex(u => u.id === user.id)
      if (index !== -1) {
        users.value.splice(index, 1)
      }

      //fetchUsers()

      toastr.success('User deleted successfully', 'Success')

    }).catch(error => {

      toastr.error('Error deleting user', 'Error')

      console.error('Error deleting user:', error.message)
    })
  } */
}

function changeStatus(user) {
  axios.patch(`/api/backend/users/${user.id}/change-status`, {
    status: user.status === 1 ? 0 : 1
  }).then(response => {
    // Update the user in the users array
    const index = users.value.data.findIndex(u => u.id === response.data.user.id)
    users.value.data[index] = response.data.user
    toastr.success('User role updated successfully', 'Success')
  }).catch(error => {
    console.error('Error updating user role:', error.message)
  })
}

const selectedUserIds = ref([])

const toggleAllSelection = (event) => {
  const isChecked = event.target.checked
  const checkboxes = document.querySelectorAll('input[type="checkbox"]')
  checkboxes.forEach((checkbox) => {
    checkbox.checked = isChecked
  })
}

const toggleSelection = (userId) => {
  selectedUserIds.value = selectedUserIds.value.includes(userId)
    ? selectedUserIds.value.filter((id) => id !== userId)
    : [...selectedUserIds.value, userId]
  console.log('Selected User IDs:', selectedUserIds.value)
}
/* const roles = [
  { name: 'USER', value: 1 },
  { name: 'ADMIN', value: 2 }
] */

const pageTitle = ref(null)

onMounted(() => {
  const documentTitle = pageTitle.value.innerText + ' | ' + document.title;
  document.title = documentTitle
  fetchUsers()
})
</script>

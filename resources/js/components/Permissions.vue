<template>
  <div class="card-header mb-3 px-0 d-flex justify-content-between align-items-center">
    <h4>Разрешения</h4>
    <button type="button" title="Add New Permission" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
      <i class="feather icon-plus"></i> Добавить разрешение
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Дата создания</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="permission in permissions" :key="permission.id">
          <td>{{ permission.id }}</td>
          <td>{{ permission.name }}</td>
          <td>{{ moment(String(permission.created_at)).format('DD.MM.YYYY HH:mm') }}</td>
          <td class="text-end">
            <button type="button" @click="editPermission(permission)" title="Редактировать" class="btn btn-sm btn-info me-1"><i class="feather icon-edit"></i></button>
            <button type="button" @click="deletePermission(permission)" title="Удалить" class="btn btn-sm btn-danger">
              <i class="feather icon-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal fade" ref="addModalElement" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Новое разрешение</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form @submit.prevent="createPermission">
          <div class="modal-body">
            <div class="mb-2">
              <label for="inputPermissionName" class="form-label">Название</label>
              <input
                type="text"
                v-model.trim="formValues.name"
                class="form-control"
                :class="{ 'is-invalid': permissionNameError }"
                id="inputPermissionName"
                placeholder="Enter permission name"
              />
              <span v-if="permissionNameError" class="invalid-feedback">{{ permissionNameError }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" title="Add new permission">Создать</button>
            <button type="button" data-bs-dismiss="modal" class="ml-3 btn btn-outline-warning">Отмена</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" ref="editModalElement" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Редактировать разрешение</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form @submit.prevent="updatePermission">
          <div class="modal-body">
            <div class="mb-2">
              <label for="inputEditPermissionName" class="form-label">Название</label>
              <input
                type="text"
                v-model.trim="formValues.name"
                class="form-control"
                :class="{ 'is-invalid': permissionNameError }"
                id="inputEditPermissionName"
                placeholder="Enter permission name"
              />
              <span v-if="permissionNameError" class="invalid-feedback">{{ permissionNameError }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" title="Save changes">Сохранить</button>
            <button type="button" data-bs-dismiss="modal" class="ml-3 btn btn-outline-warning">Отмена</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import moment from 'moment'

const permissions = ref([])
const formValues = ref({
  id: null,
  name: ''
})
const errors = ref({})
const permissionNameError = ref('')

const addModalElement = ref(null)
let addFormModal = null

const editModalElement = ref(null)
let editFormModal = null

const fetchPermissions = () => {
  fetch('/api/backend/permissions').then(response => response.json()).then(data => {
    permissions.value = data.permissions
  }).catch(error => {
    console.error('Error fetching permissions:', error.message)
  })
}

const createPermission = () => {
  fetch('/api/backend/permissions', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ name: formValues.value.name })
  }).then(response => response.json()).then(data => {
    if(data.success) {
      addFormModal.hide()
      formValues.value.name = ''
      permissions.value.unshift(data.permission)

      swal.fire({
        icon: 'success',
        title: 'Permission created successfully',
        showConfirmButton: false,
        timer: 1500
      })

    }
  }).catch(error => {
    console.error('Error creating permission:', error.message)
  })
}

const editPermission = (permission) => {
  formValues.value.id = permission.id
  formValues.value.name = permission.name
  editFormModal.show()
}

const updatePermission = () => {
  fetch(`/api/backend/permissions/${formValues.value.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ name: formValues.value.name })
  }).then(response => response.json()).then(data => {
    console.log(data);

    if(data.success) {
      editFormModal.hide()
      permissions.value.find(permission => permission.id === formValues.value.id).name = formValues.value.name

      swal.fire({
        icon: 'success',
        title: 'Permission updated successfully',
        showConfirmButton: false,
        timer: 1500
      })
    }
  }).catch(error => {
    console.error('Error updating permission:', error.message)
  })
}

const deletePermission = (permission) => {
  swal.fire({
    title: 'Are you sure you want to delete ' + permission.name + '?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#04a9f5',
      cancelButtonColor: '#f44236',
      confirmButtonText: 'Yes, delete it!'
  }).then(result => {
      if (result.isConfirmed) {
        // Send request to the server
        fetch(`/api/backend/permissions/${permission.id}`, {
          method: 'DELETE'
        }).then(response => {
          if (response.status === 204) {
            // Remove the user from the users array
            const index = permissions.value.findIndex(u => u.id === permission.id)
            if (index !== -1) {
              permissions.value.splice(index, 1)
            }
            swal.fire('Deleted!','Permission has been deleted.','success')
          } else {
            swal.fire('Error!','Error deleting permission','error')
          }
        }).catch(error => {
          console.error('Error deleting permission:', error.message)
        })
      }
  })
}

onMounted(() => {
  addFormModal = new bootstrap.Modal(addModalElement.value) // Инициализация при монтировании
  editFormModal = new bootstrap.Modal(editModalElement.value) // Инициализация при монтировании
  fetchPermissions()
})
</script>

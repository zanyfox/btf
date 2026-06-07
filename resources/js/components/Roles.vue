<template>
  <div class="card-header mb-3 px-0 d-flex justify-content-between align-items-center">
    <h4>{{ $t('Role Management') }}</h4>
    <button type="button" @click="addRoleModal" class="btn btn-sm btn-primary float-right">
      <i class="feather icon-plus"></i> {{ $t('Add New Role') }}
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Разрешения</th>
          <th scope="col">Guard</th>
          <th scope="col">Дата создания</th>
          <th scope="col">Дата обновления</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </thead>
      <tbody v-if="roles.length > 0">
        <tr v-for="role in roles" :key="role.id">
          <td v-text="role.id"></td>
          <td v-text="role.name"></td>
          <td v-text="role.permissions.length"></td>
          <td v-text="role.guard_name"></td>
          <td v-text="moment(String(role.created_at)).format('DD.MM.YYYY HH:mm')"></td>
          <td v-text="moment(String(role.updated_at)).format('DD.MM.YYYY HH:mm')"></td>
          <td class="text-end">
            <button type="button" @click="editRoleModal(role)" title="Редактировать" class="btn btn-sm btn-info me-1">
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
          <td colspan="5" class="text-center">No results found</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-if="showAddRoleModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $t('Add New Role') }}</h5>
          <button type="button" class="btn-close" @click.prevent="showAddRoleModal = false" aria-label="Close"></button>
        </div>
        <form @submit.prevent="createRole">
          <div class="modal-body">
            <div class="mb-3">
              <label for="inputRoleName" class="form-label">Role Name</label>
              <input
                type="text"
                v-model.trim="formValues.name"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                id="inputRoleName"
                placeholder="Enter role name"
              />
              <span v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</span>
            </div>
            <div>
              <label class="form-label">Assign Permissions</label>
              <div class="row">
                <div class="col col-3" v-for="permission in permissions" :key="permission.id">
                  <div class="form-check mb-2">
                    <label class="form-check-label text-nowrap2">
                      <input
                        type="checkbox"
                        v-model="formValues.permissions"
                        :value="permission.id"
                        class="form-check-input"
                      >
                        {{ permission.name }}
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Role</button>
            <button type="button" @click.prevent="showAddRoleModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div v-if="showEditRoleModal" class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edin Role <strong>{{ formValues.name }}</strong></h5>
          <button type="button" class="btn-close" @click.prevent="showEditRoleModal = false" aria-label="Close"></button>
        </div>
        <form @submit.prevent="updateRole">
          <div class="modal-body">
            <div class="mb-3">
              <label for="inputRoleName" class="form-label">Role Name</label>
              <input
                type="text"
                v-model.trim="formValues.name"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                id="inputRoleName"
                placeholder="Enter role name"
              />
              <span v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</span>
            </div>
            <div class="row">
              <div class="col col-3" v-for="permission in permissions" :key="permission.id">
                <div class="form-check mb-2">
                  <label class="form-check-label text-nowrap2">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      v-model="formValues.permissions"
                      :checked="formValues.permissions.includes(permission.id)"
                      :value="permission.id"
                    >
                      {{ permission.name }}
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" title="Add new role">Создать</button>
            <button type="button" @click.prevent="showEditRoleModal = false" class="ml-3 btn btn-outline-warning">Отмена</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import moment from 'moment'
const roles = ref([])
const permissions = ref([])
const loading = ref(false)
const formValues = ref({
  id: null,
  name: '',
  permissions: []
})
const errors = ref({})
const showAddRoleModal = ref(false)
const showEditRoleModal = ref(false)
const selectedRole = ref({})

const fetchRoles = () => {
  fetch('/api/backend/roles').then(response => response.json()).then(data => {
    roles.value = data.roles
  }).catch(error => {
    console.error('Error fetching roles:', error.message)
  })
}

const fetchPermissions = () => {
  fetch('/api/backend/permissions').then(response => response.json()).then(data => {
    if(data.success) {
      permissions.value = data.permissions
    }
  }).catch(error => {
    console.error('Error fetching permissions:', error.message)
  })
}

const addRoleModal = () => {
  formValues.value.id = null
  formValues.value.name = ''
  formValues.value.permissions = []
  showAddRoleModal.value = true
}

const editRoleModal = (role) => {
  formValues.value.id = role.id
  formValues.value.name = role.name
  formValues.value.permissions = role.permissions.map(permission => permission.id)
  showEditRoleModal.value = true
}

const createRole = () => {
  fetch('/api/backend/roles', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: formValues.value.name,
      permissions: formValues.value.permissions
    })
  }).then(response => response.json()).then(data => {
    console.log(data);

    if(!data.success) {

      errors.value = data.errors
    }

    if(data.success) {
      showAddRoleModal.value = false
      formValues.value.name = ''
      roles.value.unshift(data.role)

      /* toast.fire({
        icon: 'success',
        title: 'Role created successfully'
      }) */

      swal.fire({
        icon: 'success',
        title: 'New Role has been created',
        showConfirmButton: false,
        timer: 1500
      })

    }
  }).catch(error => {
    showAddRoleModal.value = false
    swal.fire({
      icon: 'error',
      title: 'Error creating role',
      text: 'Something went wrong',
      showConfirmButton: true
    })
    console.error('Error creating role:', error.message)
  })
}

const updateRole = () => {
  fetch(`/api/backend/roles/${formValues.value.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: formValues.value.name,
      permissions: formValues.value.permissions
    })
  }).then(response => response.json()).then(data => {
    showEditRoleModal.value = false
    fetchRoles()
  }).catch(error => {
    console.error('Error updating role:', error.message)
  })
}

const openRolePermissionsModal = (role) => {
  role.permissionIds = role.permissions.map(permission => permission.id)
  selectedRole.value = role
  showRolePermissionsModal.value = true
}

onMounted(() => {
  fetchRoles()
  fetchPermissions()
})
</script>

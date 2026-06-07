<template>
	<div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link>
          </li>
          <li class="breadcrumb-item"><a href="#!" ref="pageTitle">{{ $t('Posts') }}</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card" v-if="!isLoading">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>{{ $t('Posts') }}</h4>
      <router-link to="/backend/posts/create" class="btn btn-sm btn-primary">
        <i class="feather icon-plus"></i> {{ $t('Add New Post') }}
      </router-link>
    </div>
    <div class="card-body table-border-style">
      <div class="d-flex" :class="selectedItems.length ? 'justify-content-between' : 'justify-content-end'">
        <div v-if="selectedItems.length" class="form-inline d-flex align-items-center gap-3">
          <div class="form-group">
            <select @change="bulkModify" class="form-control form-control-sm" id="inputBulkAction">
              <option value="" disabled selected>Выберите действие</option>
              <option value="ban">Снять выбранные с публикации</option>
              <option value="unban">Опубликовать выбранные</option>
            </select>
          </div>
          <span class="text-muted">Selected: {{ selectedItems.length }}</span>
        </div>
        <div class="form-inline">
          <div class="form-group">
            <input
              type="search"
              v-model="searchQuery"
              class="form-control form-control-sm"
              id="inputSearch"
              placeholder="Поиск по названию..."
            >
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" @change="selectAllItems" :checked="selectedItems.length === items.data.length"></th>
              <th>#</th>
              <th>{{ $t('Title') }}</th>
              <th>{{ $t('Rubric') }}</th>
              <th>{{ $t('Tags') }}</th>
              <th>{{ $t('Author') }}</th>
              <th>{{ $t('CreatedAt') }}</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody v-if="items.data.length > 0">
            <tr v-for="item in items.data" :key="item.id">
              <td><input type="checkbox" :checked="selectedItems.includes(item.id)" @change="toggleSelection(item)"></td>
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.rubric?.title }}</td>
              <td>
                <span v-if="item.tags?.length > 0" v-for="tag in item.tags" :key="tag.id">{{ tag.name }}</span>
              </td>
              <td>{{ item.author?.name }}</td>
              <td>
                {{ moment(String(item.created_at)).format('DD.MM.YYYY HH:mm') }}
              </td>
              <td class="text-end">
                <button type="button" @click.prevent="changeStatus(item)" class="btn btn-sm me-1" :class="item.status !== 1 ? 'btn-danger' : 'btn-success'" title="Изменить статус">
                  <i class="fa" :class="item.status !== 1 ? 'fa-lock' : 'fa-lock-open'"></i>
                </button>
                <router-link :to="`/backend/posts/${item.id}/edit`" class="btn btn-sm btn-info" title="Редактировать">
                  <i class="fa fa-edit"></i>
                </router-link>
                <button type="button" @click.prevent="deleteItem(item.id)" class="btn btn-sm btn-danger ms-1" title="Удалить">
                  <i class="fa fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="8" class="text-center">No results found</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Bootstrap4Pagination :data="items" @pagination-change-page="fetchItems" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { Form, Field} from 'vee-validate'
import * as yup from 'yup'
import moment from 'moment'
import { debounce } from 'lodash'
import { Bootstrap4Pagination } from 'laravel-vue-pagination'
import flatpickr from 'flatpickr'
import 'flatpickr/dist/flatpickr.min.css'

const items = ref({'data': []})
const searchQuery = ref(null)

watch(searchQuery, debounce((newValue) => {
  if (newValue) {
    searchItems()
  } else {
    fetchItems()
  }
}, 300))

const searchItems = () => {
  // Fetch items from the backend
  fetch('/api/backend/posts?search=' + searchQuery.value).then(response => response.json()).then(data => {
    items.value.data = data.items.data
  }).catch(error => {
    console.error('Error fetching items:', error.message)
  })
  return items.value
}

const fetchItems = ($page = 1) => {
  fetch(`/api/backend/posts/?page=${$page}`).then(response => response.json()).then(data => {
    if(data.success) {
      items.value = data.posts
    }
    selectedItems.value = []
  }).catch(error => console.error('Error fetching items:', error.message))
}

const deleteItem = (id) => {
  if(confirm('Вы действительно хотите удалить эту запись?')) {
    fetch(`/api/backend/posts/${id}`, {
      method: 'DELETE'
    }).then(response => {
      if (response.status === 204) {
        const index = items.value.data.findIndex(u => u.id === id)
        if (index !== -1) {
          items.value.data.splice(index, 1)
          toastr.success('Item has been deleted successfully')
        }
      } else {
        toastr.error('Error deleting item')
      }
    }).catch(error => console.error('Error deleting item:', error.message))
  }
}

function changeStatus(item) {
  item.status = item.status === 1 ? 0 : 1
  fetch(`/api/backend/posts/${item.id}/change-status`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      status: item.status
    })
  }).then(response => {
    if (response.ok) {
      const index = items.value.data.findIndex(i => i.id === item.id)
      items.value.data[index] = item
      toastr.success('Item status has been changed successfully')
    } else {
      console.error('Error changing item status')
      toastr.error('Error changing item status')
    }
  })

}

const selectedItems = ref([])

const selectAllItems = () => {
  if(selectedItems.value.length < items.value.data.length) {
    selectedItems.value = items.value.data.map(item => item.id)
  } else {
    selectedItems.value = []
  }
}

const toggleSelection = (item) => {
  const index = selectedItems.value.indexOf(item.id)
  if (index !== -1) {
    selectedItems.value.splice(index, 1)
  } else {
    selectedItems.value.push(item.id)
  }
  //selectedItems.value.push(user.id)
  /* selectedItems.value = selectedItems.value.includes(userId)
    ? selectedItems.value.filter((id) => id !== userId)
    : [...selectedItems.value, userId] */
  //console.log('Selected User IDs:', selectedItems.value)
}

const bulkModify = (event) => {
  switch (event.target.value) {
    case 'ban':
      fetch('/api/backend/posts/bulk-ban', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          ids: selectedItems.value
        })
      })
      .then(response => {
        if (response.ok) {
          fetchPosts()
          selectedItems.value = []

          swal.fire({
            icon: 'success',
            title: 'Items has been banned',
            showConfirmButton: false,
            timer: 1500
          })

        }
      }).catch(error => {
        console.error('Error bulk modifying users:', error.message)
      })
      break
    case 'unban':
      fetch('/api/backend/posts/bulk-unban', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          ids: selectedItems.value
        })
      })
      .then(response => {
        if (response.ok) {
          fetchItems()
          selectedItems.value = []

          swal.fire({
            icon: 'success',
            title: 'Users has been unbanned',
            showConfirmButton: false,
            timer: 1500
          })

        }
      }).catch(error => {
        console.error('Error bulk modifying items:', error.message)
      })
      break
  }
}
const pageTitle = ref(null)
const isLoading = ref(true)
onMounted(() => {
  const documentTitle = pageTitle.value.innerText + ' | ' + document.title;
  document.title = documentTitle
  fetchItems()
  isLoading.value = false
})
</script>

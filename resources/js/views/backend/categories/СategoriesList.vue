<template>

  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb mb-0">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><a href="#!">Категории</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>Категории</h5>
      <router-link to="/backend/categories/create" title="Создать новую категорию" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> Добавить категорию
      </router-link>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Изображение</th>
              <th>Имя</th>
              <th>Родитель</th>
              <th>Порядок</th>
              <th>Дата создания</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories" :key="category.id">
              <td>{{ category.id }}</td>
              <td>
                <img :src="`/uploads/categories/thumbs/${ category.picture }`" width="60" alt="">
              </td>
              <td>
                {{ category.name }}<br>
                <small>{{ category.slug }}</small>
              </td>
              <td>Без родителя</td>
              <td>{{ category.order_by }}</td>
              <td>{{  moment(String(category.created_at)).format('DD.MM.YYYY HH:mm')}}</td>
              <td class="text-right">
                <a href="javascript:void(0)" @click.prevent="changeStatus(category.id)" class="btn btn-sm btn-light mr-1" title="Изменить статус">
                  <i class="feather icon-check-circle text-success" v-if="category.status == 1"></i>
                  <i class="feather icon-slash text-danger" v-else></i>
                </a>
                <router-link :to="`/backend/categories/${category.id}/edit`" title="Редактировать" class="btn btn-sm btn-info mr-1"><i class="feather icon-edit"></i></router-link>
                <button @click.prevent="deleteCategory(category.id)" title="Удалить" class="btn btn-sm btn-danger">
                  <i class="feather icon-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import moment from 'moment'
const categories = ref([])
const loading = ref(false);

const getCategories = (status) => {
  loading.value = true
  fetch('/api/backend/categories').then(response => response.json()).then(data => {
    categories.value = data.categories
    loading.value = false
  }).catch(error => {
    console.error('Ошибка при загрузке категорий:', error)
    loading.value = false
  })
}

const changeStatus = (id) => {
  fetch(`/api/backend/categories/${id}/change-status`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      getCategories()
    } else {
      alert('Ошибка при изменении статуса категории')
    }
  })
}

const deleteCategory = (id) => {
  if (confirm('Вы уверены, что хотите удалить эту категорию?')) {
    fetch(`/api/backend/categories/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(response => {
      if (response.ok) {
        const index = categories.value.findIndex(category => category.id === id)
        if (index !== -1) {
          categories.value.splice(index, 1)
        }
      } else {
        alert('Ошибка при удалении категории')
      }
    })
  }
}

onMounted(() => {
  getCategories()
})
</script>

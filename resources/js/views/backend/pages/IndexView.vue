<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <RouterLink to="/backend/dashboard"><i class="feather icon-home"></i></RouterLink>
            </li>
            <li class="breadcrumb-item"><a href="#!">Страницы</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title">Страницы</h4>
      <RouterLink :to="{name: 'BackendPageCreate'}">
        <button class="btn btn-sm btn-primary"><i class="feather icon-plus"></i> Новая страница</button>
      </RouterLink>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Заголовок</th>
              <th scope="col">Слаг</th>
              <th scope="col">Порядок</th>
              <th scope="col">Статус</th>
              <th scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(page, index) in pages" :key="page.id">
              <td>{{ index + 1 }}</td>
              <td>{{ page.title }}</td>
              <td>{{ page.slug }}</td>
              <td>{{ page.order }}</td>
              <td>
                <span class="badge" :class="`badge-${page.status}`"></span>
              </td>
              <td class="text-end">
                <RouterLink :to="{ name: 'BackendPageEdit', params: { id: page.id } }" class="btn btn-sm btn-info me-1">
                  <i class="feather icon-edit"></i>
                </RouterLink>
                <button type="button" @click.prevent="destroyPage(page.id)" class="btn btn-sm btn-danger">
                  <i class="feather icon-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- <Preloader :loading="loading" /> -->
</template>
<script setup>
import { onMounted } from 'vue'
import usePages from '../../../composables/pages'
import { RouterLink } from 'vue-router';
//import Preloader from '../../components/Preloader.vue';

const { pages, getPages, destroyPage } = usePages()

//const items = ref([])
//const loading = ref(false)
/* const getItems = () => {
  loading.value = true
  fetch('/api/backend/pages').then((response) => response.json()).then((data) => {
    items.value = data.pages
  }).catch((error) => {
    console.error('Error fetching items:', error)
  }).finally(() => {
    loading.value = false
  })
} */

onMounted(() => getPages())
</script>

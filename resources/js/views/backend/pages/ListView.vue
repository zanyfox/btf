<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pages</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard">Home</router-link></li>
            <li class="breadcrumb-item active">Pages</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-2">
            <div>
              <router-link to="/admin/pages/create">
                <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New
                      Page</button>
              </router-link>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
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
                  <tr v-for="(item, index) in items" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.slug }}</td>
                    <td>{{ item.order }}</td>
                    <td>
                      <span class="badge" :class="`badge-${item.status}`"></span>
                    </td>
                    <td>
                        <router-link :to="`/admin/appointments/${item.id}/edit`">
                            <i class="fa fa-edit mr-2"></i>
                        </router-link>

                        <a href="#" @click.prevent="deleteAppointment(item.id)">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
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
  <!-- <Preloader :loading="loading" /> -->
</template>
<script setup>
import { onMounted, ref, computed } from 'vue'
import Swal from 'sweetalert2';
import axios from 'axios';
//import Preloader from '../../components/Preloader.vue';

const items = ref([])
const loading = ref(false)
const getItems = (status) => {
  loading.value = true

  fetch('/api/backend/pages').then((response) => response.json()).then((data) => {
    items.value = data.pages
  }).catch((error) => {
    console.error('Error fetching items:', error)
  }).finally(() => {
    loading.value = false
  })

}

const deleteAppointment = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/appointments/${id}`)
                .then((response) => {
                    updateAppointmentStatusCount(id);
                    appointments.value.data = appointments.value.data.filter(appointment => appointment.id !== id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                });
        }
    })
}

onMounted(() => {
  getItems()
})
</script>

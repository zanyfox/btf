<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Список сообщений</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard">Dashboard</router-link></li>
            <li class="breadcrumb-item active">Messages</li>
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
            <div class="btn-group">
              <button @click="getMessages()" type="button" class="btn"
                :class="[typeof selectedStatus === 'undefined' ? 'btn-secondary' : 'btn-default']">
                <span class="mr-1">All</span>
                <span class="badge badge-pill badge-info">{{ appointmentsCount }}</span>
              </button>

              <button v-for="status in appointmentStatus" @click="getMessages(status.value)"
                type="button" class="btn"
                :class="[selectedStatus === status.value ? 'btn-secondary' : 'btn-default']">
                <span class="mr-1">{{ status.name }}</span>
                <span class="badge badge-pill" :class="`badge-${status.color}`">{{ status.count
                    }}</span>
              </button>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя отправителя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(message, index) in messages" :key="message.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ message.name }}</td>
                    <td>{{ message.email }}</td>
                    <td>{{ message.phone }}</td>
                    <td>
                      <span class="badge" :class="`badge-${message.status}`">
                        {{message.status }}</span>
                    </td>
                    <td>{{ moment(message.created_at).format('DD.MM.YYYY HH:mm') }}</td>
                    <td>
                      <button class="btn btn-sm btn-info" @click="getMessages(message.id)">
                        <i class="fa fa-eye"></i>
                      </button>
                      <a href="#" class="btn btn-sm btn-danger ml-2" @click.prevent="deleteAppointment(message.id)">
                        <i class="fa fa-trash"></i>
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
import Swal from 'sweetalert2'
import axios from 'axios'
import moment from 'moment'
//import Preloader from '../../components/Preloader.vue';

const selectedStatus = ref();
const appointmentStatus = ref([]);
const messages = ref([]);
const loading = ref(false);
const getMessages = (status) => {
  loading.value = true
  selectedStatus.value = status
  const params = {}
  if (status) {
    params.status = status
  }
  axios.get('/api/backend/messages', {
    params: params,
  }).then((response) => {
    console.log(response.data)
    messages.value = response.data.messages
    loading.value = false
  })
}

const appointmentsCount = computed(() => {
    return appointmentStatus.value.map(status => status.count).reduce((acc, value) => acc + value, 0);
});

const updateAppointmentStatusCount = (id) => {
    const deletedAppointmentStatus = appointments.value.data.find(appointment => appointment.id === id).status.name;
    const statusToUpdate = appointmentStatus.value.find(status => status.name === deletedAppointmentStatus);
    statusToUpdate.count--;
};

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
};

onMounted(() => {
  getMessages()
})
</script>

<template>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link>
          </li>
          <li class="breadcrumb-item"><a href="#!" ref="pageTitle">Сообщения</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h4>Сообщения</h4>
        <div class="btn-group btn-group-sm" role="group" aria-label="Message Status">
          <button
            type="button"
            class="btn btn-outline-primary"
            :class="{ 'active': selectedStatus == 'all' }"
            @click="selectedStatus = 'all'; getMessages()">
            Все <span class="badge rounded-pill bg-info ms-1">{{ messagesTotalCount }}</span>
          </button>
          <button type="button" v-for="status in messageStatuses" class="btn btn-outline-primary" :class="{ 'active': selectedStatus == status.value }" @click="selectedStatus = status.value; getMessages()">
            {{ status.name }} <span class="badge rounded-pill ms-1" :class="`bg-${status.color}`">{{ status.count }}</span>
          </button>
        </div>
      </div>
    </div>
    <div class="card-body table-border-style">

      <div class="table-responsive" v-if="!loading">
        <table class="table table-striped">
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
            <tr v-for="(message, index) in messages.data" :key="message.id">
              <td>{{ index + 1 }}</td>
              <td>{{ message.name }}</td>
              <td>{{ message.email }}</td>
              <td>{{ message.phone }}</td>
              <td>
                <span class="badge" :class="`bg-${message.status === 'new' ? 'danger' : 'success'}`">
                  {{message.status }}</span>
              </td>
              <td>{{ moment(message.created_at).format('DD.MM.YYYY HH:mm') }}</td>
              <td class="text-end">
                <button class="btn btn-sm btn-info me-1" @click="showModal(message)">
                  <i class="fa fa-eye"></i>
                </button>
                <a href="#" class="btn btn-sm btn-danger ml-2" @click.prevent="deleteMessage(message.id)">
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Bootstrap4Pagination :data="messages" @pagination-change-page="getMessages" />
    </div>
  </div>

  <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ modalMessage.subject }}</h5>
          <button type="button" class="btn-close" @click="hideModal"></button>
        </div>
        <div class="modal-body" v-html="modalMessage.content"></div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" @click.prevent="printMessage">
            <i class="fa fa-print"></i> Распечатать
          </button>
          <button type="button" class="btn btn-secondary" @click="hideModal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import Swal from 'sweetalert2'
import { Bootstrap4Pagination } from 'laravel-vue-pagination'
import moment from 'moment'

const modalMessage = ref({})
const modalInstance = ref(null)

const messageStatuses = ref([])

const selectedStatus = ref('all');
const messages = ref({'data': []});
const loading = ref(true);
const getMessages = ($page = 1) => {
  loading.value = true
  fetch(`/api/backend/messages?page=${$page}&status=${selectedStatus.value}`).then(response => response.json()).then(data => {
    messages.value = data.messages
    loading.value = false
  }).catch(error => {
    console.error('Error fetching messages:', error)
  })
}

const getMessageStatuses = () => {
  fetch(`/api/backend/messages/message-statuses`).then(response => response.json()).then(data => {
    messageStatuses.value = data.messageStatuses
  }).catch(error => {
    console.error('Error fetching messages:', error)
  })
}

// Функция для показа модального окна
const showModal = (data) => {
  modalMessage.value = data
  if (modalInstance.value) {
    modalInstance.value.show()
  }
};

// Функция для скрытия модального окна
const hideModal = () => {
  if (modalInstance.value) {
    modalInstance.value.hide();
  }
}

const deleteMessage = (id) => {
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
      fetch(`/api/backend/messages/${id}`, {
        method: 'DELETE'
      }).then(response => {
        if (response.status === 204) {
          messages.value.data = messages.value.data.filter(message => message.id !== id)
          getMessageStatuses()
          Swal.fire({
            icon: 'success',
            title: 'Your file has been deleted',
            showConfirmButton: false,
            timer: 1500
          })
        }
      });
    }
  })
}

const printMessage = () => {
  window.print()
}

const messagesTotalCount = computed(() => {
  return messageStatuses.value.map(status => status.count).reduce((acc, value) => acc + value, 0);
})

onMounted(() => {
  getMessages()
  getMessageStatuses()
  const modalElement = document.getElementById('messageModal')
  modalInstance.value = new bootstrap.Modal(modalElement)
})
</script>

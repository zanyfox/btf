<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ title }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{ title }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#createUserModal">New User</button>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ title }}</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>№</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td><span class="tag tag-success">Approved</span></td>
              <td>{{ user.created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="createUserModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <Form @submit="createUser" :validation-schema="schema">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputName">Name</label>
                <Field type="text" name="name" id="inputName" class="form-control" placeholder="Enter full name" />
              </div>
              <div class="form-group">
                <label for="inputEmail">Email</label>
                <Field type="email" id="inputEmail" name="email" class="form-control" placeholder="Enter email" />
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <Field type="password" id="inputPassword" name="password" class="form-control" placeholder="Enter password" />
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </Form>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup>
  import axios from 'axios'
  import jquery from 'jquery'
  window.$ = window.jQuery = jquery
  import {ref, reactive, onMounted} from 'vue'
  import {Form, Field} from 'vee-validate'
  import * as yup from 'yup'

  const title = 'Users'
  const users = ref([])
  const form = reactive({
    name: '',
    email: '',
    password: '',
  })

  /* const createUser = () => {
    axios.post('/api/users', form).then(response => {
      users.value.unshift(response.data)
      form.name = ''
      form.email = ''
      form.password = ''
      $('#createUserModal').modal('hide')
    })
  } */

  const schema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().required().min(6)
  })


  const createUser = (values) => {
    axios.post('/api/users', values).then(response => {
      users.value.unshift(response.data)
      values.name = ''
      values.email = ''
      values.password = ''
      $('#createUserModal').modal('hide')
    })
  }

  const getUsers = () => {
    axios.get('/api/users').then(response => {
      users.value = response.data
    })
  }

  onMounted(() => {
    getUsers()
  })

</script>
<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><a href="#!">Товары</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card card-table">
        <div class="card-header">
          <h5>Фильтрация товаров</h5>
          <div class="card-header-right">
            <div class="btn-group card-option">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="feather icon-more-horizontal"></i>
              </button>
              <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="GET">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputSearch">Поиск по названию</label>
                <input type="text" name="search" value="" class="form-control" id="inputSearch">
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Категория</label>
                <select name="category" id="inputState" class="form-control">
                  <option value="" disabled selected>Выберите вариант</option>
                  <option value="1" > Bussiness class</option>
                  <option value="7" >&nbsp;&nbsp;&nbsp;&nbsp; Silver leaf</option>
                  <option value="8" >&nbsp;&nbsp;&nbsp;&nbsp; Golden leaf</option>
                  <option value="27" >&nbsp;&nbsp;&nbsp;&nbsp; Blue</option>
                  <option value="2" > Ростовские</option>
                  <option value="15" >&nbsp;&nbsp;&nbsp;&nbsp; Ростовские</option>
                  <option value="3" > Compliment</option>
                  <option value="23" >&nbsp;&nbsp;&nbsp;&nbsp; Compliment 1</option>
                  <option value="24" >&nbsp;&nbsp;&nbsp;&nbsp; Compliment 3</option>
                  <option value="25" >&nbsp;&nbsp;&nbsp;&nbsp; Compliment 5</option>
                  <option value="4" > Dover</option>
                  <option value="20" >&nbsp;&nbsp;&nbsp;&nbsp; Export</option>
                  <option value="5" > Сталинградские</option>
                  <option value="21" >&nbsp;&nbsp;&nbsp;&nbsp; Сталинградские</option>
                  <option value="6" > Bayron</option>
                  <option value="22" >&nbsp;&nbsp;&nbsp;&nbsp; Bayron</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputLang">Бренд</label>
                <select name="brand_id[]" id="inputLang" class="form-control">
                  <option value="" disabled selected>Выберите вариант</option>
                  <option v-for="brand in brands" :value="brand.id" :key="brand.id">{{ brand.name }}</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputLang">Язык</label>
                <select id="inputLang" class="form-control">
                  <option value="" disabled selected>Выберите вариант</option>
                  <option v-for="lang in langs" :value="lang.code" :key="lang.id">{{ lang.name }}</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputPriceFrom">Цена от</label>
                <input type="number" name="price_from" min="0" max="0" value="" class="form-control" id="inputPriceFrom">
              </div>
              <div class="form-group col-md-2">
                <label for="inputPriceTo">Цена до</label>
                <input type="number" name="price_to" min="0" max="0" value="" class="form-control" id="inputPriceTo">
              </div>
              <div class="form-group col-md-2">
                <label for="inputLang">Статус</label>
                <select @change="filterByStatus($event)" id="inputLang" class="form-control">
                  <option value="" disabled selected>Выберите вариант</option>
                  <option value="0">Disabled</option>
                  <option value="1">Active</option>
                </select>
              </div>
              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="featured"  class="custom-control-input" id="inputFeatured">
                  <label class="custom-control-label" for="inputFeatured">Рекомендуемый</label>
                </div>
              </div>
              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="novelty"  class="custom-control-input" id="inputNovelty">
                  <label class="custom-control-label" for="inputNovelty">Новинка</label>
                </div>
              </div>
              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="hit"  class="custom-control-input" id="inputHit">
                  <label class="custom-control-label" for="inputHit">Хит</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn  btn-primary">Фильтровать</button>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h5>Товары</h5>
          <router-link to="/backend/goods/import" data-toggle="tooltip" data-placement="left" title="Импорт товаров" class="btn btn-sm btn-primary float-right"> <i class="feather icon-plus"></i> Импорт товаров
          </router-link>
          <router-link to="/backend/goods/create" data-toggle="tooltip" data-placement="left" title="Создать новый товар" class="btn btn-sm btn-primary mr-2 float-right">
            <i class="feather icon-plus"></i> Новая запись
          </router-link>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>&nbsp;</th>
                  <th>Заголовок</th>
                  <th>Категория</th>
                  <th class="text-nowrap">Кол-во</th>
                  <th>Цена</th>
                  <th>Порядок</th>
                  <th>Дата создания</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="good in goods.data" :key="good.id" class="index-0 iteration-1">
                  <td>{{ good.id }}</td>
                  <td>
                    <img :src="`/uploads/goods/small/${good.picture}`" v-if="good.picture" width="60">
                  </td>
                  <td>
                    <router-link :to="`/backend/goods/${good.id}/edit`">{{ good.name }}</router-link>
                    <small class="d-block">Golden Leaf compact</small>
                    <small class="d-block"></small>
                  </td>
                  <td>
                    <ul class="list-unstyled">
                      <li>Golden leaf</li>
                    </ul>
                  </td>
                  <td class="text-center">{{ good.quantity }}</td>
                  <td>{{ good.price }}</td>
                  <td></td>
                  <td class="text-nowrap">
                    {{ moment(String(good.created_at)).format('DD.MM.YYYY HH:mm') }}
                  </td>
                  <td>
                    <div class="d-flex justify-content-end" style="gap: 3px">
                      <button type="button" @click.prevent="changeStatus(good.id)" title="Поменять статус" class="btn btn-sm" :class="{'btn-success': good.status == 1, 'btn-info': good.status == 0}"><i class="feather icon-eye"></i></button>
                      <router-link :to="`/backend/goods/${good.id}/edit`" title="Редактировать" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></router-link>
                      <button type="button" @click="deleteGood(good.id)" title="Удалить" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- <Preloader :loading="loading" /> -->

</template>
<script setup>
import { onMounted, ref, computed } from 'vue'
import { useSettingsStore } from '@/stores/settings'
import axios from 'axios'
import moment from 'moment'

const goods = ref([])
const loading = ref(false);

const settingsStore = useSettingsStore()
const langs = settingsStore.getLangs

//import Preloader from '../../components/Preloader.vue';

const brands = ref([]);
const appointmentStatus = ref([]);
const getAppointmentStatus = () => {
    axios.get('/api/appointment-status')
        .then((response) => {
            appointmentStatus.value = response.data;
        })
}

const getGoods = (status) => {
  loading.value = true
  fetch('/api/backend/goods').then(response => response.json()).then(data => {
    goods.value = data.goods
    loading.value = false
  })
}

function filterByStatus(event) {
  const status = event.target.value
  console.log(status)
  fetch(`/api/backend/goods?status=${status}`).then(response => response.json()).then(data => {
    goods.value = data.goods
    console.log(data.goods)
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

const deleteGood = (id) => {

  if (!confirm('Вы уверены, что хотите удалить этот товар?')) {
    return;
  }

  fetch(`/api/backend/goods2/${id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      //getGoods()
      goods.value.data = goods.value.data.filter(good => good.id !== id);
    } else {
      alert('Ошибка при удалении товара')
    }
  })

}

const saveSettings = () => {
  const newSettings = [
    { id: 1, name: 'Тема', value: 'тёмная' },
    { id: 2, name: 'Язык', value: 'русский' },
    { id: 3, name: 'Уведомления2', value: 'включены2' }
  ]
  settingsStore.updateSettings(newSettings)
}

onMounted(() => {
  getGoods()
  //getAppointmentStatus()
  saveSettings()
})
</script>

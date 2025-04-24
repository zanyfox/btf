<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><a href="https://btf.su/admin/categories">Категории</a></li>
            <li class="breadcrumb-item"><a href="#!">Создать категорию</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <form @submit.prevent="createCategory">
    <div class="card pb-5">
      <div class="card-header">
        <h5>Создать категорию</h5>
        <router-link to="/backend/categories" class="btn btn-sm btn-primary float-right">
          <i class="feather icon-backward"></i> Назад к списку
        </router-link>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">Основное</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase" data-toggle="tab" href="#seoTab" role="tab" aria-controls="seoTab" aria-selected="false">SEO</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="basicTab" role="tabpanel" aria-labelledby="basicTab">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">Имя</label>
                  <input type="text" v-model.trim="formValues.name" class="form-control" id="inputName" autocomplete="name">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSlug">Слаг</label>
                  <input type="text" v-model.trim="slug" class="form-control" id="inputSlug">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSubtitle">Подзаголовок</label>
                  <input type="text" v-model.trim="subtitle" class="form-control" id="inputSubtitle">
                </div>
                <div class="form-group">
                  <label for="inputExcerpt">Отрывок</label>
                  <textarea name="excerpt" id="inputExcerpt" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Описание</label>
                  <textarea name="description" id="inputDescription" class="form-control hasEditor"></textarea>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputExternalId">Внешний ID</label>
                  <input type="text" name="external_id" class="form-control" id="inputExternalId">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="home" class="custom-control-input" id="inputHome">
                    <label class="custom-control-label" for="inputHome">Показывать на главной</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputParent">Родитель</label>
                  <select name="parent_id" class="form-control" id="inputParent">
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
                <div class="form-group">
                  <label for="inputColor">Цвет</label>
                  <select name="color_id" class="form-control" id="inputColor">
                    <option value="" selected>Выберите вариант</option>
                                        <option value="3">American Yellow</option>
                                        <option value="2">Blood Orange</option>
                                        <option value="1">Dark Cornflower Blue</option>
                                      </select>
                </div>
                <div class="form-group">
                  <label for="inputOrderBy">Порядок</label>
                  <input type="number" name="order_by" value="28" class="form-control" id="inputOrderBy">
                </div>
                <div class="form-group">
                  <label for="inputLang">Язык</label>
                  <select id="inputLang" class="form-control">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option v-for="lang in langs" :value="lang.code" :key="lang.id">{{ lang.name }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <div class="upload-preview">

                  </div>
                  <label for="uploadFile">Изображение</label>
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <i class="feather icon-upload-cloud" style="font-size: 52px; color: #04a9f5;"></i>
                  </div>
                  <input type="hidden" name="picture" id="inputPicture" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputMetaTitle">Мета заголовок</label>
                  <input type="text" name="meta_title" class="form-control" id="inputMetaTitle">
                </div>
                <div class="form-group">
                  <label for="inputMetaKeywords">Ключевые слова</label>
                  <input type="text" name="meta_keywords" class="form-control" id="inputMetaKeywords">
                </div>
                <div class="form-group">
                  <label for="inputMetaDescription">Мета описание</label>
                  <input type="text" name="meta_description" class="form-control" id="inputMetaDescription">
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputMetaRobots">Поисковые роботы</label>
                  <select name="meta_robots" class="form-control" id="inputMetaRobots">
                    <option value="" disabled selected></option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 10; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary ml-5">Создать</button>
      <button type="button" data-url="https://btf.su/admin/categories" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">Отмена</button>
    </div>
  </form>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useSettingsStore } from '@/stores/settings'

const settingsStore = useSettingsStore()
const langs = settingsStore.getLangs

const categories = ref([])
const loading = ref(false);
const formValues = ref({
  name: '',
  slug: '',
  subtitle: '',
  excerpt: '',
  description: '',
  external_id: '',
  meta_title: '',
  meta_keywords: '',
  meta_description: '',
  meta_robots: '',
  parent_id: null,
  color_id: null,
  order_by: 28,
  home: false,
  picture: '',
  lang: 'ru',
  order_by: 28,
  status: true,
  created_at: new Date(),
  updated_at: new Date(),
})


const getCategories = (status) => {
  loading.value = true
  fetch('/api/backend/categories').then(response => response.json()).then(data => {
    categories.value = data.categories
    loading.value = false
  })
}




const createCategory = () => {
  console.log('Создание категории', formValues.value)
  /* fetch('/api/backend/categories', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formValues.value)
  }).then(response => {
    if (response.ok) {
      alert('Категория успешно создана')
      window.location.href = '/backend/categories'
    } else {
      alert('Ошибка при создании категории')
    }
  })
  .catch(error => {
    console.error('Ошибка:', error)
  })
  .finally(() => {
    loading.value = false
  }) */

}

onMounted(() => {
  //getCategories()
})
</script>

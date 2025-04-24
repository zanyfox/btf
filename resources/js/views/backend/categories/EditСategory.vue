<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="https://btf.su/admin"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="https://btf.su/admin/categories">Категории</a></li>
            <li class="breadcrumb-item"><a href="#!">Создать категорию</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <form action="https://btf.su/admin/categories/1" method="POST" enctype="multipart/form-data" id="categoryForm" novalidate>
    <div class="card pb-5">
      <div class="card-header">
        <h5>Редактировать категорию</h5>
        <a href="https://btf.su/admin/categories" data-toggle="tooltip" data-placement="left" title="Назад" class="btn btn-sm btn-primary float-right">
          <i class="feather icon-backward"></i> Назад к списку        </a>
      </div>
      <div class="card-body">

        <div class="threebody-loader">
          <div><i class="threebody-spinner"></i></div>
        </div>

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
                  <input type="text" name="name" value="Bussiness class" class="form-control" id="inputName" autocomplete="name" autofocus>
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSlug">Слаг</label>
                  <input type="text" name="slug" value="bussiness-class" class="form-control" id="inputSlug">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSubtitle">Подзаголовок</label>
                  <input type="text" name="subtitle" value="" class="form-control" id="inputSubtitle">
                </div>
                <div class="form-group">
                  <label for="inputExcerpt">Отрывок</label>
                  <textarea id="inputExcerpt" name="excerpt" class="form-control">Линейка бренда Business Class представлена в 4х-форматах: от элегантных тонких сигарет формата Super Slims Сompact до классических формата King Size.

Super Slims Compact - 2 позиции с моноацетатным фильтром и классическим ароматом.

Super Slims - 2 позиции с моноацетатным фильтром и классическим ароматом.

Slims - 3 позиции с моноацетатным фильтром и классическим ароматом.

King Size - 2 позиции с моноацетатным фильтром и классическим ароматом.</textarea>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Описание</label>
                  <textarea name="description" id="inputDescription" class="form-control hasEditor"></textarea>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputExternalId">Внешний ID</label>
                  <input type="text" name="external_id" class="form-control" value="" id="inputExternalId">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="home"  class="custom-control-input" id="inputHome">
                    <label class="custom-control-label" for="inputHome">Показывать на главной</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputParent">Выбор родителя</label>
                  <select name="parent_id" class="form-control" id="inputParent">
                    <option value="" disabled selected>Выберите родителя</option>

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
                                        <option value="3" >American Yellow</option>
                                        <option value="2" >Blood Orange</option>
                                        <option value="1" selected>Dark Cornflower Blue</option>
                                      </select>
                </div>
                <div class="form-group">
                  <label for="inputOrderBy">Порядок</label>
                  <input type="number" name="order_by" value="1" class="form-control" id="inputOrderBy">
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
                                        <div class="position-relative mb-3">
                      <img class="w-100 img-thumbnail" src="https://btf.su/uploads/categories/thumbs/e8ad2c65376141d1e385c00d07f84c37b9fd86e6.svg">
                      <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {removePicture()}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
                    </div>
                                      </div>
                  <label for="uploadFile">Изображение</label>
                  <input type="hidden" value="" id="inputPictureId">
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary"></div>
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
                  <input type="text" name="meta_title" class="form-control" value="" id="inputMetaTitle">
                </div>
                <div class="form-group">
                  <label for="inputMetaKeywords">Ключевые слова</label>
                  <input type="text" name="meta_keywords" class="form-control" value="" id="inputMetaKeywords">
                </div>
                <div class="form-group">
                  <label for="inputMetaDescription">Мета описание</label>
                  <input type="text" name="meta_description" class="form-control" value="" id="inputMetaDescription">
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputMetaRobots">Поисковые роботы</label>
                  <select name="robots" class="form-control" id="inputMetaRobots">
                    <option value="" disabled selected>Выберите вариант</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 10; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary ml-5">Обновить</button>
      <button type="button" data-url="https://btf.su/admin/categories" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">Отмена</button>
    </div>
  </form>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useSettingsStore } from '@/stores/settings'
import moment from 'moment'

const settingsStore = useSettingsStore()
const langs = settingsStore.getLangs

const categories = ref([])
const loading = ref(false);
const getCategories = (status) => {
  loading.value = true
  fetch('/api/backend/categories').then(response => response.json()).then(data => {
    categories.value = data.categories
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
  confirmation = confirm('Вы уверены, что хотите удалить эту категорию?')
  if (confirmation) {
    fetch(`/api/backend/categories/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(response => {
      if (response.ok) {
        getCategories()
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

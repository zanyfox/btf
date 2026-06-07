<template>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/backend/dashboard"><i class="feather icon-home"></i></router-link></li>
            <li class="breadcrumb-item"><router-link to="/backend/posts">{{ $t('Posts') }}</router-link></li>
            <li class="breadcrumb-item"><a href="#!">{{ $t('Create Post') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <form @submit.prevent="handleSubmit">
    <div class="card pb-5">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ $t('Create Post') }}</h4>
        <router-link to="/backend/posts" class="btn btn-sm btn-primary">
          <i class="feather icon-backward"></i> Назад к списку
        </router-link>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" data-bs-toggle="tab" data-bs-target="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">Основное</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase" data-bs-toggle="tab" data-bs-target="#seoTab" role="tab" aria-controls="seoTab" aria-selected="false">SEO</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="basicTab" role="tabpanel" aria-labelledby="basicTab">
            <div class="row">
              <div class="col col-8">
                <div class="mb-3">
                  <label for="inputName" class="form-label">Имя</label>
                  <input type="text" v-model.trim="formValues.name" class="form-control" id="inputName" autocomplete="name">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="mb-3">
                  <label for="inputSlug" class="form-label">Слаг</label>
                  <input type="text" v-model.trim="formValues.slug" class="form-control" id="inputSlug">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="mb-3">
                  <label for="inputTagline" class="form-label">Слоган</label>
                  <input type="text" v-model.trim="formValues.tagline" class="form-control" id="inputTagline">
                </div>
                <div class="mb-3">
                  <label for="inputExcerpt" class="form-label">Отрывок</label>
                  <textarea v-model.trim="formValues.excerpt" id="inputExcerpt" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                  <label for="inputBody" class="form-label">Описание</label>
                  <SummernoteEditor v-model.trim="formValues.body" id="inputBody" class="form-control" />
                </div>
              </div>
              <div class="col col-4">
                <div class="mb-3">
                  <label for="inputRubric" class="form-label">{{ $t('Rubric') }}</label>
                  <select v-model="formValues.rubric_id" class="form-control" id="inputRubric">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option value="1" v-for="rubric in rubrics" :key="rubric.id">{{ rubric.title }}</option>
                  </select>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input type="checkbox" name="status" checked class="form-check-input" id="inputStatus">
                    <label class="form-check-label" for="inputStatus">Активный статус</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="inputOrderBy" class="form-label">Порядок</label>
                  <input type="number" v-model.trim="formValues.order_by" value="28" class="form-control" id="inputOrderBy">
                </div>
                <div class="mb-3">
                  <label for="inputLang" class="form-label">Язык</label>
                  <select v-model="formValues.lang" id="inputLang" class="form-control">
                    <option value="" disabled selected>Выберите вариант</option>
                    <option v-for="lang in langs" :value="lang.code" :key="lang.id">{{ lang.name }}</option>
                  </select>
                </div>
                <div class="mb-3">
                  <div class="upload-preview"></div>
                  <label for="uploadFile" class="form-label">Превью</label>
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <i class="feather icon-upload-cloud" style="font-size: 52px; color: #04a9f5;"></i>
                    <p>Click or drag files here to upload</p>
                  </div>
                  <input type="hidden" name="picture" id="inputPicture" value="">
                </div>
                <div class="mb-3">
                  <div class="upload-preview"></div>
                  <label for="uploadFile" class="form-label">Изображение</label>
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <i class="feather icon-upload-cloud" style="font-size: 52px; color: #04a9f5;"></i>
                    <p>Click or drag files here to upload</p>
                  </div>
                  <input type="hidden" name="picture" id="inputPicture" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
            <div class="row">
              <div class="col col-8">
                <div class="mb-3">
                  <label for="inputMetaTitle" class="form-label">Мета заголовок</label>
                  <input type="text" v-model.trim="formValues.meta_title" class="form-control" id="inputMetaTitle">
                </div>
                <div class="mb-3">
                  <label for="inputMetaKeywords" class="form-label">Ключевые слова</label>
                  <input type="text" v-model.trim="formValues.meta_keywords" class="form-control" id="inputMetaKeywords">
                </div>
                <div class="mb-3">
                  <label for="inputMetaDescription" class="form-label">Мета описание</label>
                  <input type="text" v-model.trim="formValues.meta_description" class="form-control" id="inputMetaDescription">
                </div>
              </div>
              <div class="col col-4">
                <div class="mb-3">
                  <label for="inputMetaRobots" class="form-label">Поисковые роботы</label>
                  <select v-model.trim="formValues.meta_robots" class="form-control" id="inputMetaRobots">
                    <option value="" disabled selected></option>
                    <option v-for="robot in metarobots" :value="robot" :key="robot">{{ robot.name }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light ms-5" style="padding-left: 260px; z-index: 10; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary me-2">Создать</button>
      <button type="button" @click="confirmNavigation('/backend/posts')" class="btn btn-outline-warning">Отмена</button>
    </div>
  </form>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useSettingsStore } from '@/stores/settings'
import { useRouter } from 'vue-router'
import SummernoteEditor from '@/components/SummernoteEditor.vue';

const router = useRouter()
const settingsStore = useSettingsStore()
const langs = settingsStore.getLangs
const metarobots = settingsStore.getMetaRobots

const errors = ref({})
const isLoading = ref(false);
const formValues = ref({
  name: '',
  slug: '',
  slogan: '',
  excerpt: '',
  body: '',
  rubric_id: '',
  author_id: null,
  lang: 'ru',
  meta_title: '',
  meta_keywords: '',
  meta_description: '',
  meta_robots: '',
  preview: '',
  picture: '',
  order_by: 1,
  status: true
})

const confirmNavigation = (url) => {
  if (confirm('Вы уверены?')) {
    router.push(url)
  }
}

const handleSubmit = () => {
  fetch('/api/backend/posts', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formValues.value)
  }).then(response => response.json()).then(data => {
    //console.log(data)
    if (data.status == 'success') {
      router.push('/backend/posts')
      toastr.success('Item has been created successfully')
    }
  }).catch(error => {
    console.error('Ошибка:', error)
  }).finally(() => {
    isLoading.value = false
  })

}

const rubrics = ref([])
const authors = ref([])

onMounted(async () => {
  const [rubricsData, authoursData] = await Promise.all([
    fetch('/api/backend/rubrics').then(response => response.json()),
    fetch('/api/backend/users').then(response => response.json())
  ])
  rubrics.value = rubricsData.rubrics
  authors.value = authoursData.users
})
</script>

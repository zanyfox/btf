<x-admin-layout>
  <x-slot:title>@lang('admin.EditCategory')</x-slot:title>
  <div class="page-header">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ url('admin/categories') }}">@lang('admin.Categories')</a></li>
      <li class="breadcrumb-item"><a href="#!">@lang('admin.EditCategory')</a></li>
    </ul>
  </div>
  <form action="{{url('admin/categories/' . $category->id)}}" method="POST" enctype="multipart/form-data" id="categoryForm" novalidate>
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.EditCategory')</h5>
        <a href="{{url('admin/categories')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.Back')" class="btn btn-sm btn-primary float-right">
          <i class="feather icon-backward"></i> @lang('admin.BackTolist')
        </a>
      </div>
      <div class="card-body">

        <div class="threebody-loader">
          <div><i class="threebody-spinner"></i></div>
        </div>

        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">@lang('admin.Basic')</a>
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
                  <label for="inputName">@lang('admin.Name')</label>
                  <input type="text" name="name" value="{{$category->name}}" class="form-control" id="inputName" autocomplete="name" autofocus>
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSlug">@lang('admin.Slug')</label>
                  <input type="text" name="slug" value="{{$category->slug}}" class="form-control" id="inputSlug">
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSubtitle">@lang('admin.Subtitle')</label>
                  <input type="text" name="subtitle" value="{{$category->subtitle}}" class="form-control" id="inputSubtitle">
                </div>
                <div class="form-group">
                  <label for="inputExcerpt">@lang('admin.Excerpt')</label>
                  <textarea id="inputExcerpt" name="excerpt" class="form-control">{{$category->excerpt}}</textarea>
                </div>
                <div class="form-group">
                  <label for="inputDescription">@lang('admin.Description')</label>
                  <textarea name="description" id="inputDescription" class="form-control hasEditor">{{$category->description}}</textarea>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputExternalId">@lang('admin.ExternalId')</label>
                  <input type="text" name="external_id" class="form-control" value="{{$category->external_id}}" id="inputExternalId">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked($category->status) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="home" @checked($category->home) class="custom-control-input" id="inputHome">
                    <label class="custom-control-label" for="inputHome">@lang('admin.ShowOnHome')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputParent">@lang('admin.SelectParent')</label>
                  <select name="parent_id" class="form-control" id="inputParent">
                    <option value="" disabled selected>@lang('admin.ChooseParent')</option>
                    {{-- @foreach ($categories as $cat)
                    <option value="{{$cat->id}}" @selected($category->parent_id === $cat->id)>{{$cat->name}}</option>
                    @endforeach --}}
                    @foreach ($categories as $cat)
                      @include('admin.partials.category-select', ['category' => $cat, 'level' => 0, 'current' => $category])
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputColor">@lang('admin.Color')</label>
                  <select name="color_id" class="form-control" id="inputColor">
                    <option value="" selected>@lang('admin.ChooseOption')</option>
                    @foreach ($colors as $color)
                    <option value="{{$color->id}}" @selected($category->color_id === $color->id)>{{$color->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputOrderBy">@lang('admin.OrderBy')</label>
                  <input type="number" name="order_by" value="{{$category->order_by}}" class="form-control" id="inputOrderBy">
                </div>

                <div class="form-group">
                  <div class="upload-preview">
                    @if($category->picture)
                    <div class="position-relative mb-3">
                      <img class="w-100 img-thumbnail" src="{{asset('uploads/categories/thumbs/' . $category->picture)}}">
                      <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {removePicture()}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
                    </div>
                    @endif
                  </div>
                  <label for="uploadFile">@lang('admin.Picture')</label>
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
                  <label for="inputMetaTitle">@lang('admin.MetaTitle')</label>
                  <input type="text" name="meta_title" class="form-control" value="{{$category->meta_title}}" id="inputMetaTitle">
                </div>
                <div class="form-group">
                  <label for="inputMetaKeywords">@lang('admin.MetaKeywords')</label>
                  <input type="text" name="meta_keywords" class="form-control" value="{{$category->meta_keywords}}" id="inputMetaKeywords">
                </div>
                <div class="form-group">
                  <label for="inputMetaDescription">@lang('admin.MetaDescription')</label>
                  <input type="text" name="meta_description" class="form-control" value="{{$category->meta_description}}" id="inputMetaDescription">
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputMetaRobots">@lang('admin.MetaRobots')</label>
                  <select name="robots" class="form-control" id="inputMetaRobots">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 10; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
      <button type="button" data-url="{{ url('admin/categories') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
    </div>
  </form>
  @push('scripts')
  <script>

    function removePicture() {
      fetch('/admin/categories/{{$category->id}}/remove-picture').then(response => response.json()).then(data => {
        if(data.status == 'success') {
          document.querySelector('.upload-preview').innerHTML = ''
        }
      }).catch(err => console.error(err.message))
    }

    const inputPicture = document.getElementById('inputPicture')

    Dropzone.autoDiscover = false
    const uploadFile = new Dropzone("#uploadFile", {
      init: function() {
        this.element.innerHTML = `<div class="dz-message needsclick">
          <h5 class="text-primary mt-5">@lang('admin.DropFilesHereOrClickToUpload')</h5>
        </div>`
          this.on('addedFile', function(file) {
            if(this.files.length > 1) {
              this.removeFile(this.files[0])
            }
          })
        },
        url: '/admin/upload',
        maxFiles: 1,
        paramName: 'file',
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function (file, response) {
          file.previewElement.classList.add('dz-success')
          document.querySelector('.upload-preview').innerHTML = `<div class="position-relative mb-3">
            <img class="w-100 img-thumbnail" src="${file.dataURL}">
            <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {this.parentElement.remove(); document.getElementById('inputPicture').value = ''}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
          </div>`
          if( response.status == 'success' ) {
            //document.querySelector('#inputPicture').value = file.dataURL
            document.querySelector('#inputPicture').value = response.tempFilename
          }
        },
        complete: function (file) {
          this.removeFile(file)
        },
        error: function (file, response) {
          file.previewElement.classList.add('dz-error')
        }
    })

    // Submit Form

    const inputName = document.getElementById('inputName')
    const inputSlug = document.getElementById('inputSlug')
    const inputSubtitle = document.getElementById('inputSubtitle')
    const inputExcerpt = document.getElementById('inputExcerpt')
    const inputDescription = document.getElementById('inputDescription')
    const inputHome = document.getElementById('inputHome')
    const inputStatus = document.getElementById('inputStatus')
    const inputExternalId = document.getElementById('inputExternalId')
    const inputParent = document.getElementById('inputParent')
    const inputOrderBy = document.getElementById('inputOrderBy')
    const inputLang = document.getElementById('inputLang')
    const inputMetaTitle = document.getElementById('inputMetaTitle')
    const inputMetaKeywords = document.getElementById('inputMetaKeywords')
    const inputMetaDescription = document.getElementById('inputMetaDescription')
    const inputMetaRobots = document.getElementById('inputMetaRobots')

    const categoryForm = document.getElementById('categoryForm')
    const url = categoryForm.getAttribute('action')
    const submitBtn = categoryForm.querySelector('button[type="submit"]')

    categoryForm.addEventListener('submit', function(event) {
      event.preventDefault()

      submitBtn.setAttribute('disabled', true)
      document.querySelector('.threebody-loader').style.display = 'flex'

      let values = {
        name: inputName.value,
        slug: inputSlug.value,
        subtitle: inputSubtitle.value,
        excerpt: inputExcerpt.value,
        description: inputDescription.value,
        picture: inputPicture.value,
        home: inputHome.checked,
        status: inputStatus.checked,
        external_id: inputExternalId.value,
        parent_id: inputParent.value,
        color_id: inputColor.value,
        order_by: inputOrderBy.value,
        meta_title: inputMetaTitle.value,
        meta_keywords: inputMetaKeywords.value,
        meta_description: inputMetaDescription.value,
        meta_robots: inputMetaRobots.value
      }

      fetch(url, {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(values)
      }).then(response => response.json()).then(data => {

        console.log(data);
        
        submitBtn.removeAttribute('disabled')
        document.querySelector('.threebody-loader').style.display = 'none'

        if(data.status == 'success') {
          window.location.href = '/admin/categories'
        } else {
          let errors = data.errors
          if(errors['name']) {
            inputName.classList.add('is-invalid')
            inputName.nextElementSibling.textContent = errors['name']
          } else {
            inputName.classList.remove('is-invalid')
            inputName.nextElementSibling.textContent = ''
          }

          if(errors['slug']) {
            inputSlug.classList.add('is-invalid')
            inputSlug.nextElementSibling.textContent = errors['slug']
          } else {
            inputSlug.classList.remove('is-invalid')
            inputSlug.nextElementSibling.textContent = ''
          }
        }
      }).catch(error => console.error(error.message))
    })
  </script>
  @endpush
</x-admin-layout>
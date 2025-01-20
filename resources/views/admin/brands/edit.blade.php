<x-admin-layout>
  <x-slot:title>@lang('admin.EditBrand')</x-slot:title>
  <div class="page-header">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
      <li class="breadcrumb-item"><a href="/admin/brands">{{__('admin.Brands')}}</a></li>
      <li class="breadcrumb-item"><a href="#!">{{__('admin.EditBrand')}}</a></li>
    </ul>
  </div>
  <form action="{{url('admin/brands/' . $brand->id)}}" method="POST" id="brandForm" novalidate>
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-header">
        <h5>{{__('admin.EditBrand')}}</h5>
      </div>
      <div class="card-body">
        <div class="threebody-loader">
          <div><i class="threebody-spinner"></i></div>
        </div>
        <div class="row">
          <div class="col col-md-8">
            <div class="form-group">
              <label for="inputName">{{__('admin.Name')}}</label>
              <input type="text" name="name" value="{{$brand->name}}" class="form-control" id="inputName" placeholder="{{__('admin.InsertName')}}" autofocus>
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputSlug">{{__('admin.Slug')}}</label>
              <input type="text" name="slug" value="{{$brand->slug}}" class="form-control" id="inputSlug" placeholder="{{__('admin.InsertSlug')}}">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputDescription">@lang('admin.Description')</label>
              <textarea name="description" id="inputDescription" class="form-control hasEditor">{{$brand->description}}</textarea>
            </div>
          </div>
          <div class="col col-md-4">
            <div class="form-group">
              <label for="inputOrderBy">@lang('admin.OrderBy')</label>
              <input type="number" name="order_by" value="{{$brand->order_by}}" class="form-control" id="inputOrderBy">
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="status" @checked($brand->status) class="custom-control-input" id="inputStatus">
                <label class="custom-control-label" for="inputStatus">{{__('admin.ActiveStatus')}}</label>
              </div>
            </div>
            
            <div class="form-group">
              <div class="upload-preview">
                @if($brand->picture)
                <div class="position-relative mb-3">
                  <img class="w-100" src="{{asset('uploads/brands/' . $brand->picture)}}">
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
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 10; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
      <button type="button" data-url="{{ url('admin/brands') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
    </div>
  </form>
  @push('scripts')
  <script>

    function removePicture() {
      fetch('/admin/brands/{{$brand->id}}/remove-picture').then(response => response.json()).then(data => {
        if(data.status == 'success') {
          document.querySelector('.upload-preview').innerHTML = ''
        }
      }).catch(err => console.error(err.message))
    }

    /* Dropzone */
    let uploadFile = new Dropzone('#uploadFile', {
      url: '/admin/upload',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      maxFiles: 1,
      dictMaxFilesExceeded: "Достигнут лимит загрузки файлов, разрешено 1",
      acceptedFiles: 'image/*',
      dictInvalidFileType: 'Не разрешены к загрузке файлов',
      paramName: 'file',
      maxFilesize: 2,
      dictFileTooBig: "Максимальный размер файла 2 MB",
      init: function() {
        this.element.innerHTML = `<div class="dz-message needsclick">
          <h5 class="text-primary mt-5">@lang('admin.DropFilesHereOrClickToUpload')</h5>
        </div>`
      },
      success: function(file, response) {
        file.previewElement.classList.add('dz-success')
        document.querySelector('.upload-preview').innerHTML = `<div class="position-relative mb-3">
            <img class="w-100" src="${file.dataURL}">
            <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {this.parentElement.remove(); document.getElementById('inputPicture').value = '';}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
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
    const inputDescription = document.getElementById('inputDescription')
    const inputOrderBy = document.getElementById('inputOrderBy')
    const inputStatus = document.getElementById('inputStatus')
    const inputPicture = document.getElementById('inputPicture')

    const brandForm = document.getElementById('brandForm')
    brandForm.onsubmit = function(event) {
      event.preventDefault()

      const url = brandForm.getAttribute('action')
      const submitBtn = brandForm.querySelector('button[type="submit"]')
      submitBtn.setAttribute('disabled', true)
      document.querySelector('.threebody-loader').style.display = 'flex'

      fetch(url, {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          name: inputName.value,
          slug: inputSlug.value,
          description: inputDescription.value,
          order_by: inputOrderBy.value,
          status: inputStatus.checked,
          picture: inputPicture.value
        })
      }).then(response => response.json()).then(data => {

        submitBtn.removeAttribute('disabled')
        document.querySelector('.threebody-loader').style.display = 'none'

        if(data.status == 'success') {
          uploadFile.removeAllFiles()
          window.location.href = '/admin/brands'
        } else {
          let errors = data.errors
          console.log(errors)
          if(errors['name']) {
            inputName.nextElementSibling.textContent = errors['name']
          } else {
            inputName.nextElementSibling.textContent = ''
          }
          if(errors['slug']) {
            inputSlug.nextElementSibling.textContent = errors['slug']
          } else {
            inputSlug.nextElementSibling.textContent = ''
          }
        }
      }).catch(error => console.error(error.message))

    }
  </script>
  @endpush
</x-admin-layout>

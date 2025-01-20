<x-admin-layout>
  <x-slot name="title">@lang('admin.CreateUser')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">@lang('admin.Users')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateUser')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/users')}}" method="POST" name="userForm" id="userForm" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.NewUser')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">@lang('admin.Name')</label>
                  <input type="text" name="name" class="form-control" id="inputName" autofocus>
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSurname">@lang('admin.Surname')</label>
                  <input type="text" name="surname" class="form-control" id="inputSurname">
                </div>
                <h5 class="mt-4">Контактные данные</h5>
                <hr>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="email" value="" class="form-control" id="inputEmail">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPhone">@lang('admin.Phone')</label>
                    <input type="tel" name="phone" class="form-control" id="inputPhone">
                    <div class="d-block"></div>
                  </div>
                </div>
                <h5 class="mt-5">Задать пароль</h5>
                <hr>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputPassword">@lang('admin.Password')</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">@lang('admin.ConfirmPassword')</label>
                    <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword">
                  </div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputRole">@lang('admin.Roles')</label>
                  {{-- <select name="role_id" class="form-control" id="inputRole"> --}}
                  <select name="roles[]" multiple class="form-control" id="inputRoles">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                    @foreach($roles as $role)
                    <option value="{{ $role }}">{{ $role}}</option>
                    @endforeach
                  </select>
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked="checked" class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="marketingoptin" class="custom-control-input" id="inputMarketingoptin">
                    <label class="custom-control-label" for="inputMarketingoptin">@lang('admin.MarketingOptIn')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="uploadFile">@lang('admin.Image')</label>
                  <input type="hidden" value="" id="inputImageId">
                  <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                    <div class="dz-message needsclick">
                      <h5 class="text-primary mt-5">@lang('admin.DropFilesHereOrClickToUpload')</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
        <button type="button" data-url="{{ url('admin/users') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>

  const inputImageId = document.getElementById('inputImageId')

  Dropzone.autoDiscover = false
  const uploadFile = new Dropzone("#uploadFile", {
    init: function() {
      this.on('addedFile', function(file) {
        if(this.files.length > 1) {
          this.removeFile(this.files[0])
        }
      })
    },
    url: '/admin/upload',
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: 'image/jpeg,image/png,image/gif',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    success: function (file, response) {
      inputImageId.value = response.image_id
      file.previewElement.classList.add('dz-success')
    },
    error: function (file, response) {
      file.previewElement.classList.add('dz-error')
    }
  })

  const userForm = document.querySelector('#userForm')
  const btnSubmit = document.querySelector('#userForm button[type="submit"]')

  const inputName = document.querySelector('#inputName')
  const inputEmail = document.querySelector('#inputEmail')
  const inputPhone = document.querySelector('#inputPhone')
  const inputPassword = document.querySelector('#inputPassword')
  const inputRoles = document.querySelector('#inputRoles')

  

  userForm.addEventListener('submit', function(event) {
    event.preventDefault()
    btnSubmit.setAttribute('disabled',true)

    console.log(new URLSearchParams(new FormData(userForm)).toString());

    fetch('/admin/users', {
      method: 'POST',
      headers: {
        'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: new URLSearchParams(new FormData(userForm)).toString()
    }).then(res => res.json()).then(data => {

      btnSubmit.removeAttribute('disabled')

      console.log(data);
      

      if(data.status == 'fail') {
        const {errors} = data

        if(errors.name) {
          inputName.classList.add('is-ivalid')
          inputName.nextElementSibling.classList.add('invalid-feedback')
          inputName.nextElementSibling.textContent = errors.name
        } else {
          inputName.classList.remove('is-ivalid')
          inputName.nextElementSibling.classList.remove('invalid-feedback')
          inputName.nextElementSibling.textContent = ''
        }

        if(errors.email) {
          inputEmail.classList.add('is-ivalid')
          inputEmail.nextElementSibling.classList.add('invalid-feedback')
          inputEmail.nextElementSibling.textContent = errors.email
        } else {
          inputEmail.classList.remove('is-ivalid')
          inputEmail.nextElementSibling.classList.remove('invalid-feedback')
          inputEmail.nextElementSibling.textContent = ''
        }

        if(errors.phone) {
          inputPhone.classList.add('is-ivalid')
          inputPhone.nextElementSibling.classList.add('invalid-feedback')
          inputPhone.nextElementSibling.textContent = errors.phone
        } else {
          inputPhone.classList.remove('is-ivalid')
          inputPhone.nextElementSibling.classList.remove('invalid-feedback')
          inputPhone.nextElementSibling.textContent = ''
        }

        if(errors.password) {
          inputPassword.classList.add('is-ivalid')
          inputPassword.nextElementSibling.classList.add('invalid-feedback')
          inputPassword.nextElementSibling.textContent = errors.password
        } else {
          inputPassword.classList.remove('is-ivalid')
          inputPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputPassword.nextElementSibling.textContent = ''
        }

        if(errors.roles) {
          inputRoles.classList.add('is-ivalid')
          inputRoles.nextElementSibling.classList.add('invalid-feedback')
          inputRoles.nextElementSibling.textContent = errors.roles
        } else {
          inputRoles.classList.remove('is-ivalid')
          inputRoles.nextElementSibling.classList.remove('invalid-feedback')
          inputRoles.nextElementSibling.textContent = ''
        }

      }

      if(data.status == 'success') {
        window.location.href = '/admin/users'
      }
    }).catch(err => console.error(err.message))
  })
  </script>
  @endpush
</x-admin-layout>

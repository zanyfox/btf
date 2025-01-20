<x-admin-layout>
  <x-slot name="title">@lang('admin.EditUser')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">@lang('admin.Users')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditUser')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/users/' . $user->id)}}" method="POST" id="userForm" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditUser')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">@lang('admin.Name')</label>
                  <input type="text" name="name" class="form-control" value="{{$user->name}}" id="inputName" autofocus>
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputSurname">@lang('admin.Surname')</label>
                  <input type="text" name="surname" class="form-control" value="{{$user->surname}}" id="inputSurname">
                </div>
                <h5 class="mt-5">Контактные данные</h5>
                <hr>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}" id="inputEmail">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPhone">@lang('admin.Phone')</label>
                    <input type="tel" name="phone" class="form-control" value="{{$user->phone}}" id="inputPhone">
                    <div class="d-block"></div>
                  </div>
                </div>
                <h5 class="mt-5">@lang('admin.ChangePassword')</h5>
                <hr>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputOldPassword">@lang('admin.OldPassword')</label>
                    <input type="password" name="old_password" class="form-control" id="inputOldPassword">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputNewPassword">@lang('admin.NewPassword')</label>
                    <input type="password" name="new_password" class="form-control" id="inputNewPassword">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputConfirmPassword">@lang('admin.ConfirmPassword')</label>
                    <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword">
                    <div class="d-block"></div>
                  </div>
                  <p class="alert alert-info w-100 text-center">@lang('admin.ToChangePasswordYouHaveToEnterAValueOtherwiseLeaveBlank')</p>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputRoles">@lang('admin.Roles')</label>
                  <select name="roles[]" multiple class="form-control" id="inputRoles">
                    <option value="" disabled>@lang('admin.SelectRole')</option>
                    @foreach($roles as $role)
                    <option value="{{ $role }}" @selected( in_array($role, $userRoles) )>{{ $role }}</option>
                    @endforeach
                  </select>
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked($user->status) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="marketingoptin" class="custom-control-input" id="inputMarketingoptin">
                    <label class="custom-control-label" for="inputMarketingoptin">{{__('admin.MarketingOptIn')}}</label>
                  </div>
                </div>
                <div class="fileUpload">
                  <h6>Изображение</h6>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{__('admin.Upload')}}</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="inputGroupFileImage">
                      <label class="custom-file-label" for="inputGroupFileImage">{{__('admin.ChooseFile')}}</label>
                    </div>
                  </div>
                  @error('image')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
        <button type="button" data-url="{{ url('admin/users') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>
  const userForm = document.querySelector('#userForm')
  const btnSubmit = document.querySelector('#userForm button[type="submit"]')

  const inputName = document.querySelector('#inputName')
  const inputEmail = document.querySelector('#inputEmail')
  const inputPhone = document.querySelector('#inputPhone')

  const inputOldPassword = document.querySelector('#inputOldPassword')
  const inputNewPassword = document.querySelector('#inputNewPassword')
  const inputConfirmPassword = document.querySelector('#inputConfirmPassword')

  const inputRoles = document.querySelector('#inputRoles')

  userForm.addEventListener('submit', function(event) {
    event.preventDefault()
    btnSubmit.setAttribute('disabled',true)
    fetch('/admin/users/{{$user->id}}', {
      method: 'PUT',
      headers: {
        'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: new URLSearchParams(Array.from(new FormData(userForm))).toString()
    }).then(res => res.json()).then(data => {
      btnSubmit.removeAttribute('disabled')

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

        if(errors.old_password) {
          inputOldPassword.classList.add('is-ivalid')
          inputOldPassword.nextElementSibling.classList.add('invalid-feedback')
          inputOldPassword.nextElementSibling.textContent = errors.old_password
        } else {
          inputOldPassword.classList.remove('is-ivalid')
          inputOldPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputOldPassword.nextElementSibling.textContent = ''
        }

        if(errors.new_password) {
          inputNewPassword.classList.add('is-ivalid')
          inputNewPassword.nextElementSibling.classList.add('invalid-feedback')
          inputNewPassword.nextElementSibling.textContent = errors.new_password
        } else {
          inputNewPassword.classList.remove('is-ivalid')
          inputNewPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputNewPassword.nextElementSibling.textContent = ''
        }

        if(errors.confirm_password) {
          inputConfirmPassword.classList.add('is-ivalid')
          inputConfirmPassword.nextElementSibling.classList.add('invalid-feedback')
          inputConfirmPassword.nextElementSibling.textContent = errors.confirm_password
        } else {
          inputConfirmPassword.classList.remove('is-ivalid')
          inputConfirmPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputConfirmPassword.nextElementSibling.textContent = ''
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

@extends('layouts.account')

@section('content')
<section class="content-header">
  <x-flash-message />
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>@lang('Profile')</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">@lang('Dashboard')</a></li>
          <li class="breadcrumb-item active">@lang('Profile')</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">@lang('PersonalInformation')</h3>
  </div>
  <form action="{{ route('account.updateProfile') }}" method="POST" name="profileForm" id="profileForm">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="inputName">@lang('Name')</label>
        <input type="text" value="{{ $user->name }}" class="form-control" id="inputName" placeholder="@lang('EnterName')">
        <div></div>
      </div>
      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="@lang('EnterEmail')">
        <div></div>
      </div>
      <div class="form-group">
        <label for="inputPhone">@lang('Phone')</label>
        <input type="tel" value="{{ $user->phone }}" class="form-control" id="inputPhone" placeholder="@lang('EnterPhone')">
        <div></div>
      </div>
      <div class="form-group">
        <label for="inputAddress">@lang('Address')</label>
        <textarea class="form-control" id="inputAddress" placeholder="@lang('Enter Address')">{{ $user->address }}</textarea>
        <div></div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">@lang('UpdateProfile')</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>

  const inputName = document.querySelector('#inputName')
  const inputEmail = document.querySelector('#inputEmail')
  const inputPhone = document.querySelector('#inputPhone')
  const inputAddress = document.querySelector('#inputAddress')

  document.querySelector('#profileForm').addEventListener('submit', function(event) {
    event.preventDefault()
    fetch(this.action, {
      method: 'PUT',
      headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        name: inputName.value,
        email: inputEmail.value,
        phone: inputPhone.value,
        address: inputAddress.value,
      })
    }).then(res => res.json()).then(data => {
      if(data.status == 'success') {

        inputName.classList.remove('is-invalid')
        inputName.nextElementSibling.classList.remove('invalid-feedback')
        inputName.nextElementSibling.textContent = ''

        inputEmail.classList.remove('is-invalid')
        inputEmail.nextElementSibling.classList.remove('invalid-feedback')
        inputEmail.nextElementSibling.textContent = ''

        inputPhone.classList.remove('is-invalid')
        inputPhone.nextElementSibling.classList.remove('invalid-feedback')
        inputPhone.nextElementSibling.textContent = ''

        window.location.href = "{{ route('account.profile') }}"

      } else {
        let errors = data.errors

        if(errors.name) {
          inputName.classList.add('is-invalid')
          inputName.nextElementSibling.classList.add('invalid-feedback')
          inputName.nextElementSibling.textContent = errors.name
        } else {
          inputName.classList.remove('is-invalid')
          inputName.nextElementSibling.classList.remove('invalid-feedback')
          inputName.nextElementSibling.textContent = ''
        }

        if(errors.email) {
          inputEmail.classList.add('is-invalid')
          inputEmail.nextElementSibling.classList.add('invalid-feedback')
          inputEmail.nextElementSibling.textContent = errors.email
        } else {
          inputEmail.classList.remove('is-invalid')
          inputEmail.nextElementSibling.classList.remove('invalid-feedback')
          inputEmail.nextElementSibling.textContent = ''
        }

        if(errors.phone) {
          inputPhone.classList.add('is-invalid')
          inputPhone.nextElementSibling.classList.add('invalid-feedback')
          inputPhone.nextElementSibling.textContent = errors.phone
        } else {
          inputPhone.classList.remove('is-invalid')
          inputPhone.nextElementSibling.classList.remove('invalid-feedback')
          inputPhone.nextElementSibling.textContent = ''
        }

      }
    }).catch(err => console.error(err.message))
  })
</script>
@endsection
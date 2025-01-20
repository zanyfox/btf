@extends('layouts.account')

@section('content')
<section class="content-header">
  <x-flash-message />
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Change Password</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Change Password</h3>
  </div>
  <form action="{{ route('account.changePassword') }}" method="POST" name="changePasswordForm" id="changePasswordForm">
    <div class="card-body">
      <div class="form-group">
        <label for="inputOldPassword">Old Password</label>
        <input type="password" name="old_password" class="form-control" id="inputOldPassword" placeholder="Old Password">
        <div></div>
      </div>
      <div class="form-group">
        <label for="inputNewPassword">New Password</label>
        <input type="password" name="new_password" class="form-control" id="inputNewPassword" placeholder="New Password">
        <div></div>
      </div>
      <div class="form-group">
        <label for="inputConfirmPassword">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Passwor">
        <div></div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>

  const changePasswordForm = document.querySelector('#changePasswordForm')

  const inputOldPassword = document.querySelector('#inputOldPassword')
  const inputNewPassword = document.querySelector('#inputNewPassword')
  const inputConfirmPassword = document.querySelector('#inputConfirmPassword')

  const submitBtn = changePasswordForm.querySelector('button[type="submit"]')

  document.querySelector('#changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault()
    submitBtn.setAttribute('disabled', true)
    fetch(this.action, {
      method: 'POST',
      headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        old_password: inputOldPassword.value,
        new_password: inputNewPassword.value,
        confirm_password: inputConfirmPassword.value
      })
    }).then(res => res.json()).then(data => {

      console.log(data);
      submitBtn.removeAttribute('disabled')

      if(data.status == 'success') {

        window.location.href = "{{ route('account.changePassword') }}"

      } else {

        let errors = data.errors

        if(errors.old_password) {
          inputOldPassword.classList.add('is-invalid')
          inputOldPassword.nextElementSibling.classList.add('invalid-feedback')
          inputOldPassword.nextElementSibling.textContent = errors.old_password
        } else {
          inputOldPassword.classList.remove('is-invalid')
          inputOldPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputOldPassword.nextElementSibling.textContent = ''
        }

        if(errors.new_password) {
          inputNewPassword.classList.add('is-invalid')
          inputNewPassword.nextElementSibling.classList.add('invalid-feedback')
          inputNewPassword.nextElementSibling.textContent = errors.new_password
        } else {
          inputNewPassword.classList.remove('is-invalid')
          inputNewPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputNewPassword.nextElementSibling.textContent = ''
        }

        if(errors.confirm_password) {
          inputConfirmPassword.classList.add('is-invalid')
          inputConfirmPassword.nextElementSibling.classList.add('invalid-feedback')
          inputConfirmPassword.nextElementSibling.textContent = errors.confirm_password
        } else {
          inputConfirmPassword.classList.remove('is-invalid')
          inputConfirmPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputConfirmPassword.nextElementSibling.textContent = ''
        }

      }
    }).catch(err => console.error(err.message))
  })
</script>
@endsection
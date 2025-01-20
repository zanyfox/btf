@extends('layouts.app')

@section('title', __('Registration'))

@section('content')
<style>
  .auth {
    width: 100%;
    max-width: 560px;
    margin: 0 auto;
  }
  .auth h4 {text-align: center; margin: 20px 0;}
  .auth .form-group {
    margin-bottom: 20px;
  }
  .auth .btn,
  .auth .form-control {padding: 12px 20px;}
  .auth hr {margin: 20px 0;}
</style>
<div class="auth">
  <h4>@lang('RegisterNow')</h4>
  {{-- <x-jet-validation-errors class="mb-4" /> --}}
  <form method="POST" action="{{ route('register') }}" name="registrationForm" id="registrationForm" role="form" novalidate>
    @csrf
    <div class="form-group mb-3">
      <input type="text" name="name" id="inputName" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" placeholder="@lang('FirstName')" value="{{old('name')}}" autofocus autocomplete="name">
      {{-- @if($request->has('name'))
      <div class="d-block">{{$request->input('name')}}</div>
      @endif --}}

      {{-- @if($request->has(['name','email']))
      <div class="d-block">{{$request->input('name')}}</div>
      <div class="d-block">{{$request->input('email')}}</div>
      @endif --}}

      {{-- @if($request->hasAny(['name','email']))
      <div class="d-block">{{$request->input('name')}}</div>
      <div class="d-block">{{$request->input('email')}}</div>
      @endif --}}

      {{-- @if($request->filled('name'))
      <div class="d-block">{{$request->input('name')}}</div>
      @endif --}}

      {{-- @if($request->missing('name'))
      <div class="d-block">{{$request->input('name')}}</div>
      @endif --}}

      

      {{-- @if($errors->has('name'))
      <div class="invalid-feedback d-block">{{$errors->first('name')}}</div>
      @endif --}}
      <div class="d-block"></div>
    </div>
    <div class="form-group mb-3">
      <input type="email" name="email" id="inputEmail" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="@lang('EmailAddress')" value="{{old('email')}}">
      {{-- @if($errors->has('email'))
      <div class="invalid-feedback d-block">{{$errors->first('email')}}</div>
      @endif --}}
      <small class="d-block" role="alert"></small>
    </div>
    <div class="form-group mb-3">
      <input type="tel" name="phone" id="inputPhone" class="form-control imask" placeholder="@lang('PhoneNumber')">
      {{-- @error('password_confirmation')<small class="invalid-feedback d-block" role="alert">Некорректный номер телефона{{$message}}</small>@enderror --}}
      <small class="d-block" role="alert"></small>
    </div>
    <div class="form-group mb-4">
      <input type="password" name="password" id="inputPassword" class="form-control  {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="@lang('Password')" autocomplete="off">
      {{-- @if($errors->has('password'))
      <small class="invalid-feedback d-block" role="alert">{{$errors->first('password')}}</small>
      @endif --}}
      <small class="d-block" role="alert"></small>
    </div>
    <div class="form-group mb-4">
      <input type="password" name="password_confirmation" id="inputConfirmPassword" class="form-control" placeholder="@lang('ConfirmPassword')" autocomplete="off">
      {{-- @error('password_confirmation')
      <div class="invalid-feedback d-block">{{$message}}</div>
      @enderror --}}
      <small class="d-block" role="alert"></small>
    </div>
    {{-- <div class="custom-control custom-checkbox  text-left mb-4 mt-2">
      <input type="checkbox" name="marketingoptin" class="custom-control-input" id="customCheck1">
      <label class="custom-control-label" for="customCheck1">Send me the <a href="#!"> Newsletter</a> weekly.</label>
    </div> --}}
    <button type="submit" class="btn btn-primary btn-block mb-4">@lang('Register')</button>
  </form>
  <hr>
  <p class="mb-2">
    @lang('AlreadyHaveAnAccount?') 
    <a href="{{ route('login') }}">@lang('LoginNow')</a> 
    <a href="{{url('auth/reset')}}">@lang('ForgotPassword?')</a>
  </p>
</div>
@endsection

@push('scripts')
<script>

  const inputName = document.querySelector('#inputName')
  const inputEmail = document.querySelector('#inputEmail')
  const inputPhone = document.querySelector('#inputPhone')
  const inputPassword = document.querySelector('#inputPassword')
  const inputConfirmPassword = document.querySelector('#inputConfirmPassword')

  const registrationForm = document.querySelector('#registrationForm')

  registrationForm.addEventListener('submit', function(event) {
    event.preventDefault()

    registrationForm.querySelector('button[type="submit"]').setAttribute('disabled', true)

    fetch(this.action, {
      method: 'POST',
      headers: {
        'Content-type': 'application/json; charset=UTF-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        name: inputName.value,
        email: inputEmail.value,
        phone: inputPhone.value,
        password: inputPassword.value,
        password_confirmation: inputConfirmPassword.value,
      })
    }).then(res => res.json()).then(data => {

      console.log(data)
      
      if(data.status == 'fail') {
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

        if(errors.phone) {
          inputPhone.classList.add('is-invalid')
          inputPhone.nextElementSibling.classList.add('invalid-feedback')
          inputPhone.nextElementSibling.textContent = errors.phone
        } else {
          inputPhone.classList.remove('is-invalid')
          inputPhone.nextElementSibling.classList.remove('invalid-feedback')
          inputPhone.nextElementSibling.textContent = ''
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

        if(errors.password) {
          inputPassword.classList.add('is-invalid')
          inputPassword.nextElementSibling.classList.add('invalid-feedback')
          inputPassword.nextElementSibling.textContent = errors.password
        } else {
          inputPassword.classList.remove('is-invalid')
          inputPassword.nextElementSibling.classList.remove('invalid-feedback')
          inputPassword.nextElementSibling.textContent = ''
        }
        
      } else {

        inputName.classList.remove('is-invalid')
        inputName.nextElementSibling.classList.remove('invalid-feedback')
        inputName.nextElementSibling.textContent = ''
        inputEmail.classList.remove('is-invalid')
        inputEmail.nextElementSibling.classList.remove('invalid-feedback')
        inputEmail.nextElementSibling.textContent = ''
        inputPassword.classList.remove('is-invalid')
        inputPassword.nextElementSibling.classList.remove('invalid-feedback')
        inputPassword.nextElementSibling.textContent = ''

        window.location.href = "{{route('login')}}"

      }

      registrationForm.querySelector('button[type="submit"]').removeAttribute('disabled')

    }).catch(err => console.error(err.message))
  })
</script>
@endpush

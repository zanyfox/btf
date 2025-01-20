@extends('layouts.app')

@section('title', __('Authorization'))

@section('content')
<style>
  .auth {
    width: 100%;
    max-width: 560px;
    margin: 200px auto;
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
  <h4>@lang('Signin')</h4>
  @if (Session::has('success'))
    <p class="mb-3 text-success">{{ Session::get('success') }}</p>
  @endif
  @if (Session::has('fail'))
    <p class="mb-3 text-danger">{{ Session::get('fail') }}</p>
  @endif
  <form method="post" action="{{ route('login') }}" role="form" aria-label="Login">
    @csrf
    <div class="form-group mb-3">
      <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="Email" placeholder="@lang('InsertEmail')" autofocus>
      @error('email')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
    </div>
    <div class="form-group mb-4">
      <input type="password" name="password" value="{{old('password')}}" class="form-control" id="Password" placeholder="@lang('InsertPassword')" autocomplete="off">
    </div>
    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
      <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
      <label class="custom-control-label" for="customCheck1">@lang('SaveCredentials')</label>
    </div>
    <button type="submit" class="btn btn-block btn-primary mb-4">@lang('Signin')</button>
  </form>
  {{-- <hr>
  @if (Route::has('password.request'))
  <p class="mb-2 text-muted">@lang('ForgotPassword?') <a href="{{ route('password.request') }}" class="f-w-400">@lang('Reset')</a></p>
  @endif
  <p class="mb-0 text-muted">@lang('DontHaveAnAccount?') <a href="{{route('register')}}" class="f-w-400">@lang('Signup')</a></p> --}}
</div>
@endsection

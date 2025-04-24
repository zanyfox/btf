@extends('backend.layouts.auth')
@section('content')
<div id="app">
  <router-view></router-view>
</div>
{{-- <div class="card borderless">
  <div class="align-items-center ">
      <div class="card-body">
        <h4 class="mb-3 f-w-400">{{__('admin.Authorization')}}</h4>
        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">{{ session('status') }}</div>
        @endif
        <hr>
        <form method="post" action="" class="login-form" role="form">
          @csrf
          <div class="form-group mb-3">
            <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" autofocus>
            @error('email')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
          </div>
          <div class="form-group mb-4">
            <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="{{ __('admin.Password') }}" autocomplete="off">
            @error('password')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
          </div>
          <div class="custom-control custom-checkbox text-left mb-4 mt-2">
            <input type="checkbox" name="remember" class="custom-control-input" id="customCheckSaveCredentials">
            <label class="custom-control-label" for="customCheckSaveCredentials">{{ __('admin.SaveCredentials') }}</label>
          </div>
          <button type="submit" class="btn btn-block btn-primary">{{ __('admin.Signin') }}</button>
        </form>
      </div>
  </div>
</div> --}}
@endsection

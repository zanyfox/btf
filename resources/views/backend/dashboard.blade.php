@extends('backend.layouts.app')

@section('content')
<div id="app">
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  @include('backend.partials.navbar')
  @include('backend.partials.header')
  <div class="pc-container">
    <div class="pc-content">
      <router-view></router-view>
    </div>
  </div>
</div>
@endsection

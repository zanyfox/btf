@extends('layouts/app')

@section('title', $service->metatitle ? $service->metatitle : $service->name )
@section('keywords', $service->keywords )
@section('description', $service->description )

@php
$custom = [];
if( !empty($service->custom) ) {
  foreach(json_decode($service->custom) as $item) {
    if( isset($item->alias) ) {
      $custom[$item->alias] = $item;
    }
  }
}
@endphp

@section('content')
<section class="mb-5 grandchild-service grandchild-service-{{$service->slug}}">
  <div class="container">
    <nav aria-label="breadcrumb" class="my-5">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
        <li class="breadcrumb-item"><a href="{{ url($parentService->slug) }}">{{ $parentService->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
      </ol>
    </nav>
    <h1 class="page-header mb-80">{{ $service->name }}</h1>
    <article class="text mb-80">
      {!! $service->body !!}
    </article>
    @isset($custom['text-1'])
    <div class="text text-1 mb-80">
      <h4>{{ $custom['text-1']->title }}</h4>
      {!! $custom['text-1']->body !!}
    </div>
    @endisset

    <div class="modern-residential_img position-relative">
      <div class="main_menu pt-0 pb-0">
        <img class="img-fluid w-100" src="{{ asset('assets/img/fire_protection_img_title.png') }}">
      </div>
      <img class="img-fluid pro_All_Hands_Left_hand" src="{{ asset('assets/img/13_Pro_All_Hands_Left_hand.png') }}">
      <div class="text_image_modern_residential" id="icon_camera_information">
        <span class="icon-close_modern_residential" onclick="icon_camera_close()"></span>
        <p>Умная камера позволяет вести видеонаблюдение в режиме реального времени, а также хранит записи движений в
            облачном хранилище 7 дней.</p>
      </div>
      <img class="icon_camera_fire_protection icon_camera_cursor" src="{{ asset('assets/img/icon_camera.svg') }}"
            onclick="icon_camera_click()"
            title="Умная камера" alt="Умная камера">
      <img class="vector_camera_fire_protection" src="{{ asset('assets/img/fire_protection_vector_camera.svg') }}">
    </div>
    @isset($custom['text-2'])
    <div class="text text-2 mb-80">
      <h4>{{ $custom['text-2']->title }}</h4>
      {!! $custom['text-2']->body !!}
    </div>
    @endisset
    <div class="row g-md-5 mb-80">
      <div class="col-xxl-6 col-md-6 mb-40 mb-md-0">
        @isset($custom['text-3'])
        <div class="text text-3">
          <h4>{{ $custom['text-3']->title }}</h4>
          {!! $custom['text-3']->body !!}
        </div>
        @endisset
      </div>
      <div class="col-xxl-6 col-md-6">
        @isset($custom['text-4'])
        <div class="text text-4">
          <h4>{{ $custom['text-4']->title }}</h4>
          {!! $custom['text-4']->body !!}
        </div>
        @endisset
      </div>
      @isset($custom['text-5'])
      <div class="text text-5 ">
        <h4>{{ $custom['text-5']->title }}</h4>
        {!! $custom['text-5']->body !!}
      </div>
      @endisset
    </div>
    @isset($custom['text-6'])
    <div class="text text-6 mb-80">
      <h4>{{ $custom['text-6']->title }}</h4>
      {!! $custom['text-6']->body !!}
    </div>
    @endisset
  </div>
</section>
@include('partials.gray-lead')
@endsection

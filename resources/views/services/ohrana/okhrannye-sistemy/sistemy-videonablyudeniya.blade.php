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
    <article class="text mb-100">
      {!! $service->body !!}
    </article>
      <div class="row modern-residential_img">
          <div class="col-xxl-12 position-relative">
              <div class="main_menu pt-0 pb-0">
                  <img class="img-fluid w-100" src="{{ asset('assets/img/video_surveillance_img_title.png') }}">
              </div>
              <img class="img-fluid monitor_of_parking_video_serveillance" src="{{ asset('assets/img/monitor_of_parking.svg') }}">
              <div class="text_image_modern_residential" id="icon_camera_information">
                  <span class="icon-close_modern_residential" onclick="icon_camera_close()"></span>
                  <p>Умная камера позволяет вести видеонаблюдение в режиме реального времени, а также хранит записи движений в
                      облачном хранилище 7 дней.</p>
              </div>
              <img class="icon_camera_video_serveillance_1 icon_camera_cursor" src="{{ asset('assets/img/icon_camera.svg') }}"
                    onclick="icon_camera_click()"
                    title="Умная камера" alt="Умная камера">
              <img class="vector_camera_video_serveillance_1" src="{{ asset('assets/img/vector_camera_video_serveillance_1.svg') }}">
              <img class="icon_camera_video_serveillance_2 icon_camera_cursor" src="{{ asset('assets/img/icon_camera.svg') }}"
                    onclick="icon_camera_click()"
                    title="Умная камера" alt="Умная камера">
              <img class="vector_camera_video_serveillance_2" src="{{ asset('assets/img/vector_camera_video_serveillance_2.svg') }}">
          </div>
      </div>

      @isset($custom['text-1'])
      <div class="text text-1 mb-80">
        <h4>{{ $custom['text-1']->title }}</h4>
        {!! $custom['text-1']->body !!}
      </div>
      @endisset

      <div class="row g-5 mb-80">
        <div class="col-xxl-6 col-md-6 mb-40 mb-md-0">
          @isset($custom['text-2'])
          <div class="text text-2">
            <h4>{{ $custom['text-2']->title }}</h4>
            {!! $custom['text-2']->body !!}
          </div>
          @endisset
        </div>
        <div class="col-xxl-6 col-md-6">
          @isset($custom['text-3'])
          <div class="text text-3">
            <h4>{{ $custom['text-3']->title }}</h4>
            {!! $custom['text-3']->body !!}
          </div>
          @endisset
        </div>
      </div>
  </div>
</section>
@include('partials.gray-lead')
@endsection

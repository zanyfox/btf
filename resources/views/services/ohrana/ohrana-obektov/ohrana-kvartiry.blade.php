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
<section class="grandchild-service grandchild-service-{{$service->slug}}">
  <div class="container">
    <nav aria-label="breadcrumb" class="my-5">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
        <li class="breadcrumb-item"><a href="{{ url($parentService->slug) }}">{{ $parentService->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
      </ol>
    </nav>

    <h1>{{  $service->name }}</h1>

    <div class="text service-text">
      {!! $service->body !!}
    </div>
    <div class="row modern-residential_img">
      <div class="col-xxl-12 position-relative">
        <div class="main_menu">
          <img class="img-fluid w-100" src="{{ asset('assets/img/3d-rendering-wooden-house.png') }}">
        </div>
        <img class="img-fluid pro_All_Hands_Left_hand" src="{{ asset('assets/img/13_Pro_All_Hands_Left_hand.png') }}">
        <div class="text_image_modern_residential" id="icon_camera_information">
          <span class="icon-close_modern_residential" onclick="icon_camera_close()"></span>
          <p>Умная камера позволяет вести видеонаблюдение в режиме реального времени, а также хранит записи движений в
            облачном хранилище 7 дней.</p>
        </div>
        <img class="icon_camera icon_camera_cursor" src="{{ asset('assets/img/icon_camera.svg') }}" onclick="icon_camera_click()"
            title="Умная камера" alt="Умная камера">
        <img class="vector_camera" src="{{ asset('assets/img/vector_camera.svg') }}">
      </div>
    </div>

    @isset($custom['text-1'])
    <div class="text mb-80">
      <h4>{{ $custom['text-1']->title }}</h4>
      {!! $custom['text-1']->body !!}
    </div>
    @endisset

    @isset($custom['text-2'])
    <div class="text">
      <h4>{{ $custom['text-2']->title }}</h4>
      {!! $custom['text-2']->body !!}
    </div>
    @endisset

  </div>

  @include('partials.gray-lead')

  @if(count($siblings) > 0)
  <div class="container mb-100">
    <h4 class="page-subheader mb-5">цены на услуги охраны объектов:</h4>
    <div class="row">
      <div class="col-12">
        <div class="another-services-list">
          @foreach ($siblings as $sibling)
          <div class="row py-3 align-items-center">
            <div class="col-xxl-8 col-6">
              <span class="check_box_img"></span>
              <p class="mb-0">{{ $sibling->name }}</p>
            </div>
            <div class="col-xxl-4 col-6 text-end">
              <button type="button" class="btn btn-warning">от {{ $sibling->price }} руб./месяц</button>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif
</section>

@endsection

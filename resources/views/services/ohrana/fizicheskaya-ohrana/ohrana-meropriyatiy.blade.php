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
<section>
  <div class="container-max ohrana-meropriyatiy">
    <div class="container">
        <div class="row">
          <div class="col-xl-6 pr-100 mb-5">
            <nav aria-label="breadcrumb" class="my-xl-5">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
                <li class="breadcrumb-item"><a href="{{ url($parentService->slug) }}">{{ $parentService->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
              </ol>
            </nav>
            <h1 class="page-header mb-80">{{ $service->name }}</h1>
            <article>
              {!! $service->body !!}
            </article>
          </div>
        </div>
    </div>
    <div class="text-center d-block d-xl-none">
      <img src="{{ asset('assets/img/security_measures_img_title.png') }}" class="img-fluid" alt="">
    </div>
    </div>
    <div class="event_security_bg_red">
      <div class="container p_0_pixles">
        <div class="main_menu pt-0 pb-0 ps-0 ">
          <div class="row">
            <div class="col-xl-6 mobile_disable_1200">
              <img class="img-fluid h-100" src="{{ asset('assets/img/event_security_title.png') }}">
            </div>
            <div class="col-xl-6">
              <div class="pt-5 mb-80">
                @isset($custom['text-1'])
                <div class="text text-1 text-white">
                  <h4>{{ $custom['text-1']->title }}</h4>
                  {!! $custom['text-1']->body !!}
                </div>
                @endisset
              </div>
              <div class="mb-80">
                @isset($custom['text-2'])
                <div class="text text-2 text-white">
                  <h4>{{ $custom['text-2']->title }}</h4>
                  {!! $custom['text-2']->body !!}
                </div>
                @endisset
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mobile_enable_1200">
        <div class="col-12">
          <div class=" text-center">
            <img class="img-fluid" src="{{ asset('assets/img/event_security_title.png') }}">
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(count($siblings) > 0)
  <div class="container mt-5 mb-100">
    <h4 class="page-subheader mb-5">цены на услуги физической охраны:</h4>
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
  @include('partials.gray-lead')
</section>
@endsection

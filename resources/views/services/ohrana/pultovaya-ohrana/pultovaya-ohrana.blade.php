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
<div class="container">

    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
      <p id="mainCarouselTitle" class="h3 mb-30">{{ $service->name }}</p>
      <div class="row mb-60 align-items-center">
        <div class="col-xxl-8 col-lg-12">
          {!! $service->body !!}
        </div>
        <div class="col-xxl-4 col-lg-0 align-content-center text-end">
          <button type="button" class="btn submit_application" data-bs-toggle="modal" data-bs-target="#feedbackModal">ОСТАВИТЬ ЗАЯВКУ</button>
        </div>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-title="{{ $service->name }}" data-subtitle="{{ $service->tagline }}">
          <picture>
            <source media="(max-width: 768px)" srcset="{{asset('assets/img/remote_security_title_header_mobile.png')}}">
            <img src="{{asset('assets/img/remote_security_title_header.png')}}" class="w-100" loading="eager" decoding="sync" fetchpriority="high" alt="">
          </picture>
        </div>
      </div>
    </div>

  <div class="row mb-100">
  <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
              </ol>
            </nav>
    <div class="col-lg-5 pe-lg-5">
      @isset($custom['text-1'])
      <div class="service-content">
        <h4>{{ $custom['text-1']->title }}</h4>
        {!! $custom['text-1']->body !!}
      </div>
      @endisset
    </div>
    <div class="col-lg-7 ps-lg-5">
    @include('partials.numbers')
    </div>
  </div>

  @if(count($childs) > 0)
  <div class="servicesPreviewList mb-100">
    <div class="row g-5 justify-content-between">
      @foreach ($childs as $child)
      <div class="col-xxl-4">
        <div class="button_image">
          <a href="{{ url('pultovaya-ohrana', $child->slug ) }}" class="blur">
            <p>{{ $child->name }}</p>
            <span>ПОДРОБНЕЕ</span>
          </a>
          <img src="{{ Storage::url($child->cover) }}" alt="{{ $child->name }}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  <section class="another-services mb-100">
    <h4 class="page-subheader mb-5">Цены на услуги пультовой охраны:</h4>
    <div class="another-services-list">
      @foreach ($childs as $child)
      <div class="row py-3 align-items-center">
        <div class="col-xxl-8 col-6">
          <span class="check_box_img"></span>
          <p class="mb-0">{{ $child->name }}</p>
        </div>
        <div class="col-xxl-4 col-6 text-end">
          <button type="button" class="btn btn-warning">от {{ $child->price }} руб</button>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  @isset($custom['text-2'])
  <div class="text text-2 mb-100">
    <h4 class="page-subheader mb-4">{{ $custom['text-2']->title }}</h4>
    {!! $custom['text-2']->body !!}
  </div>
  @endisset
  
</div>
<div class="footer_physicalSecurity bg-red">
	<div class="container">
		<div class="row">
			<div class="col-xxl-6">
        @isset($custom['text-3'])
        <div class="text text-3">
          <h4 class="mb-xxl-5 mb-4">{{ $custom['text-3']->title }}</h4>
          {!! $custom['text-3']->body !!}
        </div>
        @endisset
			</div>
			<div class="col-xxl-6">
				@isset($custom['text-4'])
        <div class="text text-4">
          <h4 class="mb-xxl-5 mb-4">{{ $custom['text-4']->title }}</h4>
          {!! $custom['text-4']->body !!}
        </div>
        @endisset
			</div>
		</div>
	</div>
</div>
@endsection

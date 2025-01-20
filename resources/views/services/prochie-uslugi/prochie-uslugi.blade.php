@extends('layouts/app')

@section('title', $service->metatitle ?? $service->name)
@section('keywords', $service->keywords)
@section('description', $service->description)

@section('content')
<div class="container">
  <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <p id="mainCarouselTitle" class="h3 mb-5">{{ $service->name }}</p>
    <div class="row mb-60">
      <div class="col-xxl-8 col-lg-12">
        <p>{{ $service->tagline }}</p>
      </div>
      <div class="col-xxl-4 col-lg-0 align-content-center text-end">
        <button type="button" class="btn submit_application" data-bs-toggle="modal" data-bs-target="#feedbackModal">ОСТАВИТЬ ЗАЯВКУ</button>
      </div>
    </div>
    <picture>
      <source media="(max-width: 768px)" srcset="{{ asset('assets/img/security_systems_title_header_mobile.png') }}">
      <img src="{{ asset('assets/img/other_service_img_title.png') }}" class="w-100" loading="eager" decoding="sync" fetchpriority="high" alt="">
    </picture>
  </div><!-- /#mainCarousel -->

  

  <div class="row mb-100">
  	<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
              </ol>
            </nav>
    <div class="col-lg-5 pe-lg-5">
      <article>
      {!! $service->body !!}
      </article>
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
            <a href="{{ url('prochie-uslugi', $child->slug ) }}" class="blur">
              <p>{{ $child->name }}</p>
              <span>ПОДРОБНЕЕ</span>
            </a>
            <img src="{{ Storage::url($child->cover) }}" alt="{{ $child->name }}">
          </div>
        </div>
        @endforeach
    </div>
  </div>
  <div class="container">
    <h4 class="page-subheader mb-5">ЦЕНЫ НА прочие УСЛУГИ гк «Патриот»</h4>
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
  </div>
  @endif
</div>

<div class="lead-banner">
  <div class="container">
    @include('partials.lead', ['title' => 'Нестандартная ситуация или требуется профессиональная консультация?', 'subtitle' => 'Наши эксперты в кратчайшие сроки приедут на встречу для оценки ситуации. 
Звоните по номеру  +7 (4012) 76-30-30 или'])
  </div>
</div>

@endsection




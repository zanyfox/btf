@extends('layouts/app')

@section('title', $service->name )
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
<section class="child-service child-service-{{$service->slug}}">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 pe-5">

        <nav aria-label="breadcrumb" class="my-5">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Main')</a></li>
            <li class="breadcrumb-item"><a href="{{ url('prochie-uslugi') }}">Прочие услуги</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
          </ol>
        </nav>

        <h1>{{ $service->name }}</h1>
        <div class="text">
          {!! $service->body !!}
        </div>
      </div>
      <div class="col-xl-6 d-none d-xl-block">
        @if(file_exists( public_path('assets/img/services/other/' . $service->slug . '-01.png')))
        <img class="img-fluid h-100" src="{{ asset('assets/img/services/other/' . $service->slug . '-01.png') }}" alt="">
        @endif
      </div>
    </div>
  </div>
  <div class="d-block d-xl-none text-center">
    @if(file_exists( public_path('assets/img/services/other/' . $service->slug . '-01.png')))
    <img class="img-fluid" src="{{ asset('assets/img/services/other/' . $service->slug . '-01.png') }}" alt="">
    @endif
  </div>
  <div class="my_container_bg_grey bg-grey">
    <div class="container ps-0 pe-0">
      <div class="row align-items-center">
        <div class="col-6 d-none d-xl-block">
          @if(file_exists( public_path('assets/img/services/other/' . $service->slug . '-02.png')))
          <img class="img-fluid" src="{{ asset('assets/img/services/other/' . $service->slug . '-02.png') }}">
          @endif
        </div>
        <div class="col-12 col-md-6">
          @isset($custom['text-2'])
          <div class="text-2 p-3">
            {!! $custom['text-2']->body !!}
          </div>
          @endisset
        </div>
      </div>
    </div>
  </div>
  @if(file_exists( public_path('assets/img/services/other/' . $service->slug . '-02.png')))
  <img class="img-fluid d-block d-xl-none" src="{{ asset('assets/img/services/other/' . $service->slug . '-02.png') }}">
  @endif
  <div class="container">
    @isset($custom['text-3'])
    <div class="text-3">
    {!! $custom['text-3']->body !!}
    </div>
    @endisset
  </div>
  @if(count($siblings) > 0)
  <div class="container">
    <h4 class="page-subheader mb-5">ЦЕНЫ НА прочие УСЛУГИ гк «Патриот»</h4>
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
              <button type="button" class="btn btn-warning">от {{ $sibling->price }} руб</button>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif
</section>


<div class="lead-banner">
  <div class="container">
    @include('partials.lead', ['title' => 'Нестандартная ситуация или требуется профессиональная консультация?', 'subtitle' => 'Наши эксперты в кратчайшие сроки приедут на встречу для оценки ситуации. 
Звоните по номеру  +7 (4012) 76-30-30 или'])
  </div>
</div>

@endsection

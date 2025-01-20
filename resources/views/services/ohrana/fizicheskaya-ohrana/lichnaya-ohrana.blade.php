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
    <div class="container p_0_pixles">
      <div class="main_menu mb-80 pt-0 pe-0">
        <div class="row">
          <div class="col-xl-6">
            <nav aria-label="breadcrumb" class="my-5">
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
          <div class="col-xl-6 mobile_disable_1200">
            <img class="img-fluid h-100" src="{{ asset('assets/img/private_security_img_title.png') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="mobile_enable_1200 text-center mb-80">
      <img class="img-fluid" src="{{ asset('assets/img/private_security_img_title.png') }}">
    </div>
    <div class="container p_0_pixles">
      <div class="main_menu">
        <div class="mb-80">
          @isset($custom['text-1'])
          <div class="text text-1">
            <h4>{{ $custom['text-1']->title }}</h4>
            {!! $custom['text-1']->body !!}
          </div>
          @endisset
        </div>
        <div class="row mb-80">
          @isset($custom['text-2'])
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-4 mb-3">
              <img class="img-fluid" src="{{ asset('assets/img/accompaniment_img.svg') }}">
              <h4 class="text-uppercase text-dark fs-5 fw-500">{{ $custom['text-2']->title }}</h4>
            </div>
            {!! $custom['text-2']->body !!}
          </div>
          @endisset
          @isset($custom['text-3'])
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-4 mb-3">
              <img class="img-fluid" src="{{ asset('assets/img/monitoring_img.svg') }}">
              <h4 class="text-uppercase text-dark fs-5 fw-500">{{ $custom['text-3']->title }}</h4>
            </div>
            {!! $custom['text-3']->body !!}
          </div>
          @endisset
          @isset($custom['text-4'])
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-4 mb-3">
              <img class="img-fluid" src="{{ asset('assets/img/elaboration_of_measures_img.svg') }}">
              <h4 class="text-uppercase text-dark fs-5 fw-500">{{ $custom['text-4']->title }}</h4>
            </div>
            {!! $custom['text-4']->body !!}
          </div>
          @endisset
        </div>
        <h3 class="page-header text-dark mb-80">КАЧЕСТВА ТЕЛОХРАНИТЕЛЕЙ ГК<br> "ПАТРИОТ"</h3>
        <div class="row mb-40">
          <div class="col-xxl-8 col-12 ">
            <div class="professionalism_bg p-md-5 p-3 pt-5">
              <div class="row">
                <div class="col-xxl-7 col-12">
                  <p class="professionalism_title">профессионализм</p>
                  <p class="pt-xxl-5 pt-2">Наши сотрудники находятся в отличной физической форме, им от 30 до 45 лет.
                    Они прошли специальную подготовку и имеют разрешение на ношение оружия и спецсредств. Каждые 3
                    месяца телохранители проходят испытания, чтобы подтвердить лицензию. Раз в квартал посещают
                    профессиональные стрельбы для поддержания практического навыка. Боевыми искусствами владеют все без
                    исключения. Тренировки и спарринг проходят в специально оборудованных залах на территории наших
                    компаний.</p>
                </div>
                <div class="col-5 mobile_disable">
                  <img class="img-fluid professionalism_img" src="{{ asset('assets/img/professionalism_img.png') }}">
                </div>
              </div>
              
              <div class="row mobile_enable">
                <div style="height: 260px">
                  <div class="col-12">
                    <img class="img-fluid professionalism_img" src="{{ asset('assets/img/professionalism_img.png') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 mobile_disable">
            <div class="unobtrusiveness_bg ms-4 h-100 p-5">
              <p class="unobtrusiveness_title mb-5">ненавязчивость</p>
              <p>Наши телохранители умеют быть незаметными, дабы не угнетать подопечного своим присутствием.</p>
            </div>
          </div>
        </div>
        <div class="row mt-3 mobile_enable mb-40">
          <div class="col-12 unobtrusiveness_mobile">
            <div class="unobtrusiveness_bg h-100 p-3 pt-5">
              <p class="unobtrusiveness_title mb-3">ненавязчивость</p>
              <p>Наши телохранители умеют быть незаметными, дабы не угнетать подопечного своим присутствием.</p>
            </div>
          </div>
        </div>
        <div class="row mb-80">
          <div class="col-4 mobile_disable">
            <div class="unobtrusiveness_bg h-100 p-5">
              <p class="unobtrusiveness_title mb-5">владение языками</p>
              <p>У нас вы можете нанять англоговорящего охранника.</p>
            </div>
          </div>
          <div class="col-xxl-8 col-12 ">
            <div class="professionalism_bg ms-md-4 ms-0 p-md-5 p-3 pt-5">
              <div class="row">
                <div class="col-xxl-6 col-12">
                  <p class="professionalism_title">развитые аналитические способности и интуиция</p>
                  <p class="pt-xxl-5 pt-2 intuition_block">Личный охранник обязан быть психологом, уметь считывать людей
                    и ситуацию. Он дисциплинирован, всегда начеку и просчитывает действия окружающих и свои на много
                    шагов вперед.</p>
                </div>
                <div class="col-6 mobile_disable">
                  <img class="img-fluid intuition_img" src="{{ asset('assets/img/intuition_img.png') }}">
                </div>
              </div>
              <div class="row mobile_enable">
                <div style="height: 260px">
                  <div class="col-12">
                    <img class="img-fluid professionalism_img" src="{{ asset('assets/img/intuition_img.png') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3 mobile_enable mb-40">
          <div class="col-12 unobtrusiveness_mobile">
            <div class="unobtrusiveness_bg h-100 p-3 pt-5">
              <p class="unobtrusiveness_title mb-3">владение языками</p>
              <p>У нас вы можете нанять англоговорящего охранника.</p>
            </div>
          </div>
        </div>
        @isset($custom['text-9'])
        <div class="text">
          <h4>{{ $custom['text-9']->title }}</h4>
          {!! $custom['text-9']->body !!}
        </div>
        @endisset
      </div>
    </div>
  </section>
  
  @include('partials.gray-lead')

  @if(count($siblings) > 0)
  <div class="container mb-100">
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
@endsection

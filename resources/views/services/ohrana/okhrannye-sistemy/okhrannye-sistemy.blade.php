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
              <source media="(max-width: 768px)" srcset="{{asset('assets/img/security_systems_title_header_mobile.png')}}">
              <img src="{{asset('assets/img/security_systems_title_header.png')}}" class="w-100" loading="eager" decoding="sync" fetchpriority="high" alt="">
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
        <div class="text text-1">
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
      <div class="row justify-content-between">
        @foreach ($childs as $child)
        <div class="col-xxl-4">
          <div class="button_image">
            <a href="{{ url('okhrannye-sistemy', $child->slug ) }}" class="blur">
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
    
    <div class="main_menu">
      <div class="row mb-80">
        <div class="col-xxl-6 col-md-6 mt-xxl-5 mt-0">
          @isset($custom['text-2'])
          <div class="text text-2">
            <h4>{{ $custom['text-2']->title }}</h4>
            {!! $custom['text-2']->body !!}
          </div>
          @endisset
        </div>
        <div class="col-xxl-6 col-md-6 mt-xxl-5 mt-0">
          @isset($custom['text-3'])
          <div class="text text-3">
            <h4>{{ $custom['text-3']->title }}</h4>
            {!! $custom['text-3']->body !!}
          </div>
          @endisset
        </div>

      </div>
      <div class="mt-4 mb-100">
        @isset($custom['text-4'])
        <div class="text text-4">
          <h4>{{ $custom['text-4']->title }}</h4>
          {!! $custom['text-4']->body !!}
        </div>
        @endisset
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 card_types_of_physical_security">
          <div class="d-flex gap-lg-5 gap-3 mb-3 align-items-center">
            <div><img class="img-fluid" src="{{asset('assets/img/application_img.svg')}}" alt=""></div>
            <h4>заявка</h4>
          </div>
          <p>Вы обращаетесь в ГК «Патриот» и формулируете требования. Сложность задачи не важна. Вам может
            требоваться сигнализация для квартиры или комплексная защита для промышленного объекта. Рассматриваем
            все обращения.</p>
        </div>
        <div class="col-lg-4 col-md-6 card_types_of_physical_security">
          <div class="d-flex gap-lg-5 gap-3 mb-3 align-items-center">
            <div><img class="img-fluid" src="{{asset('assets/img/audit_img.svg')}}"></div>
            <h4>аудит</h4>
          </div>
          <p>Мы тщательно обследуем объект. По результатам выявляем слабые места в существующей защите. Предлагаем
            оптимальные решения для охраны объекта.</p>
        </div>
        <div class="col-lg-4 col-md-6 card_types_of_physical_security">
          <div class="d-flex gap-lg-5 gap-3 mb-3 align-items-center">
            <div><img class="img-fluid" src="{{asset('assets/img/monitoring_img_icon.svg')}}" alt=""></div>
            <h4>мониторинг</h4>
          </div>
          <p>Диспетчеры в круглосуточном режиме следят за ситуацией на объекте. Они оперативно реагируют на
            неисправность оборудования и возникающие угрозы.</p>
        </div>
        <div class="col-lg-4 col-md-6 card_types_of_physical_security">
          <div class="d-flex gap-lg-5 gap-3 mb-3 align-items-center">
            <div><img class="img-fluid" src="{{asset('assets/img/response_img.svg')}}"></div>
            <h4>реагирование</h4>
          </div>
          <p>При срабатывании сигнала тревоги на объект немедленно выезжает группа быстрого реагирования. В
            соответствии с заранее проработанным планом ГБР нейтрализуют угрозу.</p>
        </div>
        <div class="col-lg-4 col-md-6 card_types_of_physical_security">
          <div class="d-flex gap-lg-5 gap-3 mb-3 align-items-center">
            <div><img class="img-fluid" src="{{asset('assets/img/support_img.svg')}}"></div>
            <h4>поддержка</h4>
          </div>
          <p>В любой момент вы можете получить консультацию профессионалов. При необходимости специалисты
            модернизируют, настраивают и ремонтируют установленные системы.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-feedback-form">
    <div class="container">
      <div class="feedback_form">
        <div class="row">
          <div class="col-md-5">
            <h4 class="mb-40">Аудит объекта</h4>
            <p class="text_feedback_form">Перед постановкой объекта под охрану, специалисты нашей компании произведут
              аудит</p>
            <div class="mb-3">
              <input type="text" placeholder="Ваше имя" class="form-control">
            </div>
            <div class="mb-3">
              <input type="tel" placeholder="Телефон" class="form-control imask">
            </div>
            <div class="mb-3">
              <input type="email" placeholder="E-mail" class="form-control">
            </div>
            <label class="feedback_label mb-60">
              <span class="file_upload_icon"></span>
              <p class="file_upload_text mb-0">Загрузить файл для оценки стоимости</p>
              <input type="file" class="file_upload">
            </label>
            <button class="submit_your_application_red">оставить заявку</button>
            <p>Нажимая на кнопку «Оставить заявку» вы соглашаетесь с <a href="#">политикой обработки персональных
              данных.</a></p>
          </div>
          <div class="col-md-7 background_greyposition-relative">
            <img src="{{asset('assets/img/feedback_form_img.png')}}" class="feedback_form_img">
          </div>
        </div>
        <span class="feedback_form_bg_img_up"></span>
        <span class="feedback_form_bg_img_down"></span>
      </div>
    </div>
  </div>
</section>
{{-- <div class="background_grey background_grey_mobile_security_system"></div> --}}
@endsection

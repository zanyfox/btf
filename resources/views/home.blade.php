@extends('layouts.app')

@section('title', $page->metatitle ?? $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('content')

@php
$custom = [];
if( !empty($page->custom) ) {
  foreach(json_decode($page->custom) as $item) {
    if( isset($item->alias) ) {
      $custom[$item->alias] = $item;
    }
  }
}
@endphp

<section class="company-history">
  <img class="line-img" src="{{ asset('assets/images/big-line.svg') }}" alt="">
  <svg class="line-img media-line__img" width="310" height="29" viewBox="0 0 310 29" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <line y1="13.6421" x2="223.431" y2="13.6421" stroke="#AFB0B0" />
    <rect x="234.139" y="14.1421" width="9" height="9" transform="rotate(-45 234.139 14.1421)" fill="#AFB0B0"
      stroke="#AFB0B0" />
    <rect x="258.281" y="14.1421" width="19" height="19" transform="rotate(-45 258.281 14.1421)" fill="#AFB0B0"
      stroke="#AFB0B0" />
    <rect x="296.565" y="14.1421" width="9" height="9" transform="rotate(-45 296.565 14.1421)" fill="#AFB0B0"
      stroke="#AFB0B0" />
  </svg>
  <img class="company-history__bg" src="{{asset('assets/images/company-history-bg.png')}}" alt="">
  <div class="company-history__content">
    {!! $page->text !!}
    @if($page->subtitle)
    <h3 class="sub-title">{{ $page->subtitle }}</h3>
    @endif
  </div>
  <img class="company-history__img" src="{{asset('assets/images/company-history-img.png')}}" alt="">
</section>

@include('partials.goods-list', ['goods' => $goods])

<section class="info-section">
  <div class="container">
    <div class="row align-items-stretch">
      <div class="col-xl-7">
        @isset($custom['production'])
        <a class="info-card product-card" href="{{ route('catalog') }}">
          <img class="card-bg" src="{{asset('assets/images/card-bg-1.png')}}" alt="">
          <div class="info-card__content">
            <div class="info-card__header d-flex align-items-center ">
              <h3>{{ $custom['production']->title }}</h3>
              <img src="{{ asset('assets/images/line-img.svg') }}" alt="">
            </div>
            {!! $custom['production']->body !!}
            <h3 class="sub-title">«Традиции вкуса в каждом дыме»</h3>
            <span class="white-btn">
              <span>В КАТАЛОГ</span>
              <svg width="31" height="16" viewBox="0 0 31 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M30.7071 8.70711C31.0976 8.31658 31.0976 7.68342 30.7071 7.29289L24.3431 0.928932C23.9526 0.538408 23.3195 0.538408 22.9289 0.928932C22.5384 1.31946 22.5384 1.95262 22.9289 2.34315L28.5858 8L22.9289 13.6569C22.5384 14.0474 22.5384 14.6805 22.9289 15.0711C23.3195 15.4616 23.9526 15.4616 24.3431 15.0711L30.7071 8.70711ZM0 9H30V7H0V9Z"
                  fill="white" />
              </svg>
            </span>
          </div>
        </a>
        @endisset
      </div>
      <div class="col-xl-5">
        <div class="row">
          <div class="col-xl-12 col-md-6">
            @isset($custom['about'])
            <a href="{{ route('about') }}" class="info-card about-card">
              <img class="card-bg" src="{{asset('assets/images/card-bg-2.png')}}" alt="">
              <div class="info-card__content">
                <h3>{{ $custom['about']->title }}</h3>
                {!! $custom['about']->body !!}
              </div>
            </a>
            @endisset
          </div>
          <div class="col-xl-12 col-md-6">
            @isset($custom['distributors'])
            <a href="{{ url('distributors') }}" class="info-card about-card">
              <img class="card-bg" src="{{asset('assets/images/card-bg-3.png')}}" alt="">
              <div class="info-card__content">
                <h3>{{ $custom['distributors']->title }}</h3>
                {!! $custom['distributors']->body !!}
              </div>
            </a>
            @endisset
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

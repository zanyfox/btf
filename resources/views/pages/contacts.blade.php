@extends('layouts.app')

@section('title', $page->metatitle ?? $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('content')
<section class="contact">
  <div class="contact-content">
    <div class="title-box">
      <h2 class="title-text">{{ $page->title }}</h2>
      <h3 class="title-text__bg text-capitalize">{{ $page->slug }}</h3>
    </div>
    <div class="contact-info">
      @if(isset($settings['address']))
      <div>
        <span class="label">@lang('admin.Address')</span>
        <p>{{ $settings['address'] }}</p>
      </div>
      @endif
      <div>
        <span class="label">@lang('admin.Phone')</span>
        @if(isset($settings['phone']))
        <div class="d-flex align-items-center gap-2">
          <a href="tel:{{ $settings['phone'] }}">{{ Helper::region_phone_format($settings['phone']) }}</a>
		  {{--<span>приемная</span>--}}
        </div>
        @endif
		{{--
        @if(isset($settings['phone2']))
        <div class="d-flex align-items-center gap-2">
          <a href="tel:{{ $settings['phone2'] }}">{{ Helper::region_phone_format($settings['phone2']) }}</a><span>отдел кадров</span>
        </div>
        @endif
        @if(isset($settings['mobile']))
        @php
          $mobile = new \Propaganistas\LaravelPhone\PhoneNumber($settings['mobile'], 'RU');
        @endphp
        <a href="tel:{{ $mobile }}">{{ Helper::phone_format($mobile) }}</a>
        @endif
		--}}
      </div>
      @if(isset($settings['email']))
      <div>
        <span class="label">E-mail</span>
        <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
      </div>
      @endif
      @if(isset($settings['schedule']))
      <div>
        <span class="label">Режим работы</span>
        <p>{!! $settings['schedule'] !!}</p>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection

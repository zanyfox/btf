@extends('layouts/app')

@section('title', __('app.ThanksPage'))
@section('keywords', '')
@section('description', '')

@section('content')
<section id="payment-result">
  <div class="container">
    <div class="wrapper-payment-result">

      {{-- @if(Session::has('success'))
      <p>{{ Session::get('success') }}</p>
      @endif --}}

      <img src="{{ asset('assets/img/icons/check-green.svg') }}" width="70" height="70" alt="">
      <h1 style="color: #F6481E;">{{__('app.ThankYouForYourOrder')}}!</h1>
      <p>{{__('app.YourOrderIdIs')}}: <b>{{$orderId}}</b><br>
        Наши менеджеры свяжутся с вами в самое<br> ближайшее время для уточнения заказа!</p>
      <a href="{{ URL('/') }}" class="btn btn-primary-outline">{{__('app.GoBackToTheMainPage')}}</a>
    </div>
  </div>
</section>
@endsection

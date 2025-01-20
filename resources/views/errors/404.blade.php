@extends('layouts.app')

@section('title', __('Error404'))

@section('content')
<div class="container">
  <h1 class="text-center"></h1>
</div>
<section id="payment-result">
  <div class="container">
    <div class="wrapper-payment-result">
      <img src="{{ asset('assets/img/icons/warning-red.svg') }}" width="70" height="70" alt="">
      <h1>{{__('Error404')}}</h1>
      <h3 class="text-orange">{{__('PageNotFound')}}</h3>
      <p>{{__('ThePageYouAreTryingToFindIsNotAvailable')}}</p>
      <a href="{{route('home')}}" class="btn btn-primary">{{__('GoBackToTheMainPage')}}</a>
    </div>
  </div>
</section>
@endsection

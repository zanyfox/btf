@extends('layouts/app')

@section('title', __('app.ThanksPage'))
@section('keywords', '')
@section('description', '')

@section('content')
{{-- <div class="container">
  <ul class="breadcrumb">
    <li><a href="/">главная</a></li>
    <li><span>Корзина</span></li>
  </ul>
</div> --}}
<section id="payment-result">
  <div class="container">
    <div class="wrapper-payment-result">
      <img src="{{asset('assets/img/icons/check-green.svg')}}" width="70" height="70" alt="">
      <h1>Оплата прошла успешно!</h1>
      <p>Благодарим за заказ!<br>
        Наши менеджеры свяжутся с вами в течении рабочего дня для уточнения заказа!</p>
      <a href="{{url('/')}}" class="btn btn-primary">Вернуться на главную</a>
    </div>
  </div>
</section>
@endsection

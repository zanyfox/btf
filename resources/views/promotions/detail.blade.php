@extends('layouts/app')

@section('title', $promotion->metatitle ?? $promotion->name)
@section('keywords', $promotion->keywords)
@section('description', $promotion->description)

@section('content')

<section id="sale">
  <div class="greyblue-rectangle"></div>
  <div class="sale-wrapper content pb-0">
    <div class="container">
      {{ Breadcrumbs::render('post', $promotion) }}
      {{-- <ul class="breadcrumb">
        <li><a href="/">главная</a></li>
        <li><a href="/{{$promotion->rubric->slug}}">Акции{{$promotion->rubric->name}}</a></li>
        <li><span>Скидка 15% в день рождения!</span></li>
      </ul> --}}
      <div class="sale-content">
        <div class="sale-box">
          <p class="label">Празднуйте с нами!</p>
          <h1>Скидка 15% в день рождения!</h1>
          <div class="sale-overflow">
            {!!$promotion->body!!}
            {{-- <img src="{{asset('storage/' . $promotion->image)}}" alt="{{$promotion->name}}"> --}}
          </div>
        </div>
        <ul class="pager">

          @if($previous)
          <li><a href="/promotions/{{ $previous->slug }}" title="Предыдущая акция"></a></li>
          @else
          <li><span></span></li>
          @endif

          @if($next)
          <li><a href="/promotions/{{ $next->slug }}" title="Следующая акция"></a></li>
          @else
          <li><span></span></li>
          @endif

        </ul>
      </div>
    </div>
  </div>
  <div class="grid-container">
    <div class="grid-item"></div>
    <div class="grid-item" style="background-image: url({{asset('storage/' . $promotion->picture)}})"></div>
  </div>
</section>
@endsection

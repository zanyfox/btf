@extends('layouts.app')

@section('title', $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('content')
{{-- <!-- intro start -->
<section class="intro">
  <img class="intro-bg" src="{{ asset('assets/images/katalog-bg.png') }}" alt="">
  <div class="intro-content">
    <div class="intro-content__info">Tobacco</div>
    <h1 class="intro-content__title">{{ $page->title }}</h1>
  </div>
</section>
<!-- intro end --> --}}

<!-- business-class -->
@foreach($categories as $category)
<section class="business-class">
  <div class="container">
    @if($category->picture)
    <img src="{{ url('uploads/categories/' . $category->picture) }}" alt="{{ $category->__('name') }}">
    @endif
    <h2 class="title-text">{{ $category->__('name') }}</h2>
    <p>{{ $category->__('excerpt') }}</p>
  </div>
</section>
<!-- business-class -->

<!-- business-class__products -->
<section class="business-class__products">
  <div class="container">

    @foreach($category->children as $child)

    <div class="business-class__products-block">
      <div class="title-box bg-title__box">
        <h2 class="title-text__bg" @isset($child->color->code) style="color: {{ $child->color->code }}"  @endisset>{{ $child->__('name') }}</h2>
        <h2 class="title-text">{{ $child->parent->__('name') }}</h2>
      </div>

      <div class="business-class__products-swiper">
        <button class="business-class__swiper-next">
          <img src="{{ asset('assets/images/next-icon.svg') }}" alt="">
        </button>
        <button class="business-class__swiper-prev">
          <img src="{{ asset('assets/images/next-icon.svg') }}" alt="">
        </button>
        <div class="swiper business-class__swiper">
          <div class="swiper-wrapper">
            @foreach($child->goods as $good)
            <div class="swiper-slide">
              <div class="swiper-slide-before" @isset($child->color->code) style="background-color: {{ $child->color->code }};"  @endisset></div>
              <div class="product-card">
                <div>
                  <div class="product-img__box" style="height: auto;">
					@if($good->pictures->first())
					  <a href="{{ url('uploads/goods/small/' . $good->pictures->first()->path) }}" data-fancybox="{{$child->slug}}" data-caption="{{ $good->name }}">
					    <img class="product-img" src="{{ url('uploads/goods/small/' . $good->pictures->first()->path) }}" style="max-width: -webkit-fill-available;" alt="{{ $good->name }}">
					  </a>
					@endif
                  </div>
                  <div class="product-title__box">
                    <h4 class="product-name" @isset($child->color->code) style="color: {{ $child->color->code }}" @endisset>{{ $good->__('name') }}</h4>
                    @isset($good->type->name)
                    <span class="product-type">{{ $good->type->name }}</span>
                    @endisset
                  </div>
                </div>
                @php
                $goodFeatures = DB::select('SELECT *, fg.value AS fgvalue FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=? ORDER BY f.order_by ASC', [$good->id]);
                //print_r($goodFeatures);die;
                @endphp
                <table class="product-table">
                  @for($i = 0; $i < count($goodFeatures); $i++)
                  <tr>
                    <td class="label">{{ $goodFeatures[$i]->name }}</td>
                    <td>{{ $goodFeatures[$i]->value }} {{ $goodFeatures[$i]->unit }}</td>
                  </tr>
                  @endfor
                </table>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>
@endforeach
@endsection

@extends('layouts.app')

@section('title', $page->title ?? null)
@section('keywords', $page->keywords ?? null)
@section('description', $page->description ?? null)

@section('content')
<section class="menu-page">
  <div class="container">
    <div class="content pb-0">
      <ul class="breadcrumb">
        <li><a href="/">главная</a></li>
        <li><span>{{ $page->title ?? __('Wishlist') }}</span></li>
      </ul>
      <h1>{{ $page->title ?? __('Wishlist') }}</h1>
    </div>
  </div>
  <div class="container">
    @if($goods)
    <div class="tab-wrapper">
      <div class="tab-content show">
        <div class="cards-container">
          @foreach ($goods as $good)

          @php
          $rowId = null;
          $qty = 0;
          $goodRows = Cart::content()->where('id', $good->id);
          foreach ($goodRows as $row) {
            $rowId = $row->rowId;
            $qty = $row->qty;
          }
          @endphp

          <div class="card @if($rowId)in-cart @endif" id="shopCard{{$good->id}}">
            @php
            //$goodImage = $good->images->first();
            @endphp
            <div class="card-header">
              <button type="button" onclick="removeFromWishlist({{ $good->id }})" title="{{__('RemoveFromWishlist')}}">
                Delete<i class="icon icon-trash"></i>
              </button>
              <a href="javascript:void(0)" class="card-image btnOpenDetails" data-id="{{ $good->id }}">
                @isset($good->images[0]->path)
                <img src="{{asset('uploads/goods/small/' . $good->images[0]->path)}}" alt="{{ $good->title }}">
                @else
                <img src="https://placehold.co/387x326/EEE/002157?font=montserrat&text=Regano" alt="{{ $good->title }}">
                @endisset
              </a>
            </div>
            <div class="card-content">
              <a href="javascript:void(0)" class="card-body btnOpenDetails" data-id="{{ $good->id }}">
                <h5>{{ $good->categories()->first()->name }}</h5>
                <div class="card-title">
                  <h4>{{ $good->title }}</h4>
                  @php
                  $goodWeight = $good->features->where('slug','weight')->first();
                  $goodFeatures = DB::select('SELECT * FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=? AND f.slug=?', [$good->id,'weight']);
                  @endphp
                  @isset($goodFeatures[0]->value)
                  <small>{{$goodFeatures[0]->value}}</small>
                  @endisset
                </div>
                <p>{{ Str::limit($good->excerpt, 60, $end='...') }}</p>
              </a>
              <div class="card-footer">
                <p class="wrapper-price"><span>{{ $good->price }}</span><small>р.</small></p>
                <div class="card-cart-controls">
                  @if($good->track_qty == 'Y')
                    @if($good->quantity > 0)
                    @else
                    @endif
                  @endif
                  @if($good->available)
                  <div class="wrapper-quantity-input wrapper-quantity-input-{{ $good->id }}"  style="display: @if($rowId) block @else none @endif;">
                    <button class="btn-quantity-input" data-dir="down" onclick="changeQty()">-</button>
                    <input type="number" value="{{$qty}}" class="quantity-input number-spinner" data-rowid="{{ $rowId }}" min="1" max="99">
                    <button class="btn-quantity-input" data-dir="up" onclick="changeQty()">+</button>
                  </div>
                  <div class="wrapper-addtocart-button wrapper-addtocart-button-{{ $good->id }}" style="display: @if($rowId) none @else block @endif;">
                    <button type="button" class="btn-link" onclick="addToCart({{ $good->id }})">
                      <i class="icon icon-cart"></i>
                    </button>
                  </div>
                  @else
                  <button type="button" class="btn-white" disabled>{{__('OutOfStock')}}</button>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
@endsection

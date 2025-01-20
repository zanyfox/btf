@php
  use Propaganistas\LaravelPhone\PhoneNumber;
  $phone = new PhoneNumber($settings['phone'], 'RU');
@endphp

<header class="header">
  <x-application-logo :sitename="$sitename" />
  <button class="menu-btn">
    <span></span>
    <span></span>
    <span></span>
  </button>
  @if($pages->isNotEmpty())
  <nav class="nav">
    <ul>
      <li>
        <a class="header-link @if(request()->routeIs('catalog')) active @endif" href="{{ URL::route('catalog') }}">Каталог</a>
      </li>
      <li>
        <a class="header-link @if(request()->routeIs('about')) active @endif" href="{{ URL::route('about') }}">О компании</a>
      </li>
    </ul>
    <a class="header-logo" href="{{route('home')}}">
      <img src="{{asset('assets/images/company-logo.svg')}}" alt="{{ $sitename }}">
    </a>
    <ul>
      <li>
        <a class="header-link @if(Request::is('distributors')) active @endif" href="{{ url('distributors') }}">Дистрибьюторы</a>
      </li>
      <li>
        <a class="header-link @if(request()->routeIs('contacts')) active @endif" href="{{ URL::route('contacts') }}">Контакты</a>
      </li>
    </ul>
  </nav>
  @endif
</header>
{{-- 
<header>
  @php
   $cartCount = \Gloudemans\Shoppingcart\Facades\Cart::count() > 0 ? \Gloudemans\Shoppingcart\Facades\Cart::count() : 0; 
  @endphp
  <div class="container hidden-desktop">
    <div class="flex-container">
      
      
      <nav>
        <ul>
          
            @if($page->slug != 'home')
              @if($page->slug == 'restaraunt-menu')
              <li><a href="{{ url('table-reservation') }}" target="_blank">@lang('TableReservation')</a></li>
              @endif
              <li @if(request()->is($page->slug . '*'))class="active"@endif>
                <a href="{{url($page->slug)}}" title="{{ $page->title }}" @if($page->slug == 'menu-delivery')class="btn-shine"@endif>{{ $page->title }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      </nav>
      
      <div class="header-contacts">
        @if(isset($settings['phone']) && !empty($settings['phone']))
        <a href="tel:{{$settings['phone']}}">{{ $phone->formatInternational() }}</a>
        @endif
        @includeWhen(false, 'partials.select-lang')
      </div>
      <a href="javascript:void(0)" class="cart-link btnOpenCart">
        <span>{{ $cartCount }}</span>
      </a>
    </div>
  </div>
  <div class="container visible-desktop">
    <div class="flex-container">
      <div class="sidebar_toggler">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <a href="{{URL::to('/')}}" class="logo">
        <img src="{{asset('assets/img/logo-mobile.svg')}}" width="100" height="72" alt="{{ $sitename }}">
      </a>
      <div class="header-cart-wrapper">
        @if(isset($settings['phone']) && !empty($settings['phone']))
        <a href="tel:{{$settings['phone']}}"><i class="icon-phone-calling"></i></a>
        @endif
        <a href="#" class="cart-link btnOpenCart">
          <span>{{ $cartCount }}</span>
        </a>
      </div>
    </div>
  </div>
</header> --}}
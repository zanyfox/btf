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

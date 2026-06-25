<nav class="pcoded-navbar theme-horizontal2 menupos-fixed">
  <div class="navbar-wrapper">
    <div class="navbar-content scroll-div">
      <div>
        <div class="main-menu-header">
          {{-- <img class="img-radius" src="images/user/avatar-2.jpg" alt="User-Profile-Image"> --}}
          <div class="user-details">
            <?= \Spatie\Html\Elements\Element::withTag('span')->text(Auth::user()->name) ?>
            <div id="more-details">{{ Str::ucfirst(config('app.name')) }} <i class="fa fa-chevron-down m-l-5"></i></div>
          </div>
        </div>
        <div class="collapse" id="nav-user-link">
          <ul class="list-unstyled">
            <li class="list-group-item"><a href="/admin/users/{{ Auth::user()->id }}"><i class="feather icon-user m-r-5"></i>@lang('admin.ViewProfile')</a></li>
            <li class="list-group-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link" onclick="event.preventDefault(); this.closest('form').submit();">
                  <i class="feather icon-log-out m-r-5"></i>@lang('admin.Logout')
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>

      <ul class="nav pcoded-inner-navbar">
        <li class="nav-item">
          <a href="{{url('admin')}}" class="nav-link">
            <?= \Spatie\Html\Elements\Element::withTag('span')->class('pcoded-micon')->html('<i class="feather icon-home"></i>') ?>
            <?= \Spatie\Html\Elements\Element::withTag('span')->class('pcoded-mtext')->text(__('admin.Dashboard')) ?>
          </a>
        </li>

        <li class="nav-item @if(request()->routeIs('admin/settings')) active @endif"><a href="{{url('admin/settings')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings m-r-5"></i></span><span class="pcoded-mtext">@lang('admin.Settings')</span></a></li>

        @if(Auth::user()->hasRole('super-admin'))
          <li class="nav-item @if(Request::is('admin/users*')) active @endif"><a href="{{url('admin/users')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">{{ __('admin.Users') }}</span></a></li>
        @endif

        <li class="nav-item pcoded-menu-caption">
          <label>Контент</label>
        </li>
        <li class="nav-item @if(Request::is('admin/pages*')) active @endif">
          <a href="{{url('admin/pages')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">@lang('admin.Pages')</span></a>
        </li>
        {{-- <li class="nav-item @if(Request::is('admin/rubrics*')) active @endif">
          <a href="{{url('admin/rubrics')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-heart"></i></span><span class="pcoded-mtext">@lang('admin.Rubrics')</span></a>
        </li>
        <li class="nav-item @if(Request::is('admin/posts*')) active @endif">
          <a href="{{url('admin/posts')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-heart"></i></span><span class="pcoded-mtext">@lang('admin.Promotions')</span></a>
        </li> --}}
        <li class="nav-item @if(Request::is('admin/mainslider*')) active @endif">
          <a href="{{url('admin/mainslider')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-image"></i></span><span class="pcoded-mtext">@lang('admin.MainSlider')</span></a>
        </li>
        {{-- <li class="nav-item @if(Route::currentRouteNamed('admin.galleries.*')) active @endif">
          <a href="{{url('admin/galleries')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-image"></i></span><span class="pcoded-mtext">@lang('admin.Galleries')</span></a>
        </li> --}}
        {{-- <li class="nav-item @if(Request::is('admin/brands*')) active @endif">
          <a href="{{url('admin/brands')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">{{ __('admin.Brands') }}</span></a>
        </li> --}}
        <li class="nav-item @if(Request::is('admin/partners*')) active @endif">
          <a href="{{url('admin/partners')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">@lang('admin.Partners')</span></a>
        </li>

        @can('view colors')
        <li class="nav-item @if(Request::routeIs('admin/colors')) active @endif">
          <a href="{{url('admin/colors')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">{{ __('admin.Colors') }}</span></a>
        </li>
        @endcan
        <li class="nav-item @if(Request::routeIs('admin/types')) active @endif">
          <a href="{{url('admin/types')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">{{ __('admin.Types') }}</span></a>
        </li>
        @can('view merchants')
        {{-- <li class="nav-item @if(Request::routeIs('admin/merchants')) active @endif">
          <a href="{{url('admin/merchants')}}" class="nav-link"><span class="pcoded-micon">
            <i class="feather icon-users"></i></span><span class="pcoded-mtext">{{ __('admin.Merchants') }}</span>
          </a>
        </li> --}}
        @endcan
        {{-- <li class="nav-item @if(Request::is('admin/reviews*')) active @endif">
          <a href="{{url('admin/reviews')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-message-circle"></i></span><span class="pcoded-mtext">{{ __('admin.Reviews') }}</span></a>
        </li> --}}
        <li class="nav-item @if(Request::is('admin/features')) active @endif">
          <a href="{{url('admin/features')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">@lang('admin.Features')</span></a>
        </li>
        <li class="nav-item pcoded-menu-caption">
          <label>Каталог товаров</label>
        </li>

        <li class="nav-item @if(Request::is('admin/categories*')) active @endif">
          <a href="{{url('admin/categories')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">{{ __('admin.Categories') }}</span></a>
        </li>
        <li class="nav-item pcoded-hasmenu @if(Request::is('admin/goods*')) active @endif">
          <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">{{ __('admin.Goods') }}</span></a>
          <ul class="pcoded-submenu">
            <li><a href="{{url('admin/goods')}}">Все товары</a></li>
            @php
            $categories = \App\Models\Category::where('parent_id', null)->get();
            @endphp
            @include('admin.partials.category', ['categories' => $categories])
            {{-- @foreach($categories as $category)
            <li @if(Request::input('category') == $category->id)class="active"@endif><a href="{{url('admin/goods?category=' . $category->id )}}">{{ $category->name }}</a></li>
            @endforeach --}}
          </ul>
        </li>

        @hasrole(['super-admin', 'admin'])
        {{-- <li class="nav-item pcoded-menu-caption">
          <label>Интернет-магазин</label>
        </li>
        <li class="nav-item @if(Request::is('admin/orders*')) active @endif"><a href="{{url('admin/orders')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">{{ __('admin.Orders') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/payments*')) active @endif"><a href="{{url('admin/payments')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">{{ __('admin.Payments') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/coupons*')) active @endif"><a href="{{route('admin.coupons.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">@lang('admin.Coupons')</span></a></li>
        <li class="nav-item @if(Request::is('admin/discounts*')) active @endif"><a href="{{url('admin/discounts')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-percent"></i></span><span class="pcoded-mtext">{{ __('admin.Discounts') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/delivery-methods*')) active @endif"><a href="{{url('admin/delivery-methods')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.DeliveryMethods') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/payment-methods*')) active @endif"><a href="{{url('admin/payment-methods')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.PaymentMethods') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/calendar')) active @endif"><a href="{{url('admin/calendar')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-calendar m-r-5"></i></span><span class="pcoded-mtext">Режим работы корзины</span></a></li> --}}
        @endhasrole


        {{-- <li class="nav-item pcoded-hasmenu @if(Request::is('admin/logs*')) active @endif">
          <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.Logs') }}</span></a>
          <ul class="pcoded-submenu">
            <li @if(Request::is('admin/logs/activity'))class="active"@endif><a href="{{url('admin/logs/activity')}}">Логи активности</a></li>
            <li @if(Request::is('admin/logs/products'))class="active"@endif><a href="{{url('admin/logs/products')}}">Импорт товаров</a></li>
            <li @if(Request::is('admin/logs/groups'))class="active"@endif><a href="{{url('admin/logs/groups')}}">Импорт разделов</a></li>
            <li @if(Request::is('admin/logs/orders'))class="active"@endif><a href="{{url('admin/logs/orders')}}">Экспорт заказов в iiko</a></li>
          </ul>
        </li> --}}

      </ul>

      @role('admin')
      {{-- <div class="card text-center">
        <div class="card-block pt-5">
          <div class="d-flex justify-content-between">
            <span>Новые заказы</span>
            <span>0</span>
          </div>
          <div class="progress mb-3">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <span>В процессе</span>
            <span>0</span>
          </div>
          <div class="progress mb-3">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <span>Завершенные</span>
            <span>0</span>
          </div>
          <div class="progress">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div> --}}
      @endrole

    </div>
  </div>
</nav>

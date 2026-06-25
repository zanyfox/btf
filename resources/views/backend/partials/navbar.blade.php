<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <router-link to="/backend/dashboard" class="b-brand text-primary w-100 justify-content-center">
        <img src="{{asset('assets/images/company-logo.svg')}}" width="70" class="img-fluid logo-lg" alt="{{ Str::ucfirst(config('app.name')) }}" />
      </router>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item">
          <router-link to="/backend/dashboard" class="pc-link">
            <?= \Spatie\Html\Elements\Element::withTag('span')->class('pc-micon')->html('<i data-feather="home"></i>') ?>
            <?= \Spatie\Html\Elements\Element::withTag('span')->class('pc-mtext')->text(__('admin.Dashboard')) ?>
          </router-link>
        </li>
        {{-- @if(Auth::user()->hasRole('super-admin')) --}}
        {{-- @endif --}}
        @can('isAdmin')
        <li class="pc-item">
          <router-link to="/backend/users" class="pc-link">
            <span class="pc-micon"><i data-feather="users"></i></span>
            <span class="pc-mtext">{{ __('admin.Users') }}</span>
          </router-link>
        </li>
        <li class="pc-item">
          <router-link to="/backend/settings" class="pc-link">
            <span class="pc-micon"><i data-feather="settings"></i></span>
            <span class="pc-mtext">@lang('admin.Settings')</span>
          </router-link>
        </li>
        @endcan
        <li class="pc-item pc-caption">
          <label>Контент</label>
          <i data-feather="monitor"></i>
        </li>
        <li class="pc-item">
          <router-link to="/backend/pages" class="pc-link">
            <span class="pc-micon"><i data-feather="file"></i></span>
            <span class="pc-mtext">@lang('admin.Pages')</span>
          </router-link>
        </li>
        @role('editor|admin|super-admin')
        <li class="pc-item">
          <router-link to="/backend/rubrics" class="pc-link">
            <span class="pc-micon"><i data-feather="heart"></i></span>
            <span class="pc-mtext">@lang('admin.Rubrics')</span>
          </router-link>
        </li>
        @endrole
        @can('edit posts')
        <li class="pc-item">
          <router-link to="/backend/posts" class="pc-link">
            <span class="pc-micon"><i data-feather="heart"></i></span>
            <span class="pc-mtext">@lang('admin.Posts')</span>
          </router-link>
        </li>
        @endcan
        <li class="pc-item">
          <router-link to="/backend/mainslider" class="pc-link">
            <span class="pc-micon"><i data-feather="image"></i></span>
            <span class="pc-mtext">@lang('admin.MainSlider')</span>
          </router-link>
        </li>
        <li class="pc-item">
          <router-link to="/backend/colors" class="pc-link">
            <span class="pc-micon"><i data-feather="sun"></i></span>
            <span class="pc-mtext">{{ __('admin.Colors') }}</span>
          </router-link>
        </li>
        <li class="pc-item">
          <router-link to="/backend/types" class="pc-link">
            <span class="pc-micon"><i data-feather="tag"></i></span>
            <span class="pc-mtext">{{ __('admin.Types') }}</span>
          </router-link>
        </li>
        <li class="pc-item">
          <router-link to="/backend/features" class="pc-link">
            <span class="pc-micon"><i data-feather="layers"></i></span>
            <span class="pc-mtext">@lang('admin.Features')</span>
          </router-link>
        </li>
        <li class="pc-item pc-caption">
          <label>Каталог товаров</label>
          <i data-feather="sidebar"></i>
        </li>
        <li class="pc-item">
          <router-link to="/backend/categories" class="pc-link">
            <span class="pc-micon"><i data-feather="sidebar"></i></span>
            <span class="pc-mtext">{{ __('admin.Categories') }}</span>
          </router-link>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i data-feather="align-right"></i>
            </span>
            <span class="pc-mtext">Menu levels2</span><span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
          </a>
          <ul class="pc-submenu">
            @php
            $categories = \App\Models\Category::where('parent_id', null)->get();
            @endphp
            @include('backend.partials.category', ['categories' => $categories])
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>

<nav class="pcoded-navbar theme-horizontal2 menupos-fixed hidden" style="display: none">
  <div class="navbar-wrapper">
    <div class="navbar-content scroll-div">
      <div>
        <div class="main-menu-header">
          {{-- <img class="img-radius" src="images/user/avatar-2.jpg" alt="User-Profile-Image"> --}}
          <div class="user-details">
            <?= \Spatie\Html\Elements\Element::withTag('span')->text(Auth::user()->name) ?>
            <div id="more-details"> <i class="fa fa-chevron-down m-l-5"></i></div>
          </div>
        </div>
        <div class="collapse" id="nav-user-link">
          <ul class="list-unstyled">
            <li class="list-group-item"><a href="/admin/users/{{-- {{ Auth::user()->id }} --}}"><i class="feather icon-user m-r-5"></i>@lang('admin.ViewProfile')</a></li>
          </ul>
        </div>
      </div>

      <ul class="nav pcoded-inner-navbar">
        {{-- <li class="nav-item @if(Route::currentRouteNamed('admin.galleries.*')) active @endif">
          <a href="{{url('backend/galleries')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-image"></i></span><span class="pcoded-mtext">@lang('admin.Galleries')</span></a>
        </li> --}}
        {{-- <li class="nav-item @if(Request::is('backend/brands*')) active @endif">
          <a href="{{url('backend/brands')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">{{ __('admin.Brands') }}</span></a>
        </li> --}}
        <li class="nav-item @if(Request::is('backend/partners*')) active @endif">
          <a href="{{url('backend/partners')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">@lang('admin.Partners')</span></a>
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


        <li class="nav-item pcoded-hasmenu @if(Request::is('backend/goods*')) active @endif">
          <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">{{ __('admin.Goods') }}</span></a>
          <ul class="pcoded-submenu">
            <li><a href="{{url('backend/goods')}}">Все товары</a></li>
            @php
            $categories = \App\Models\Category::where('parent_id', null)->get();
            @endphp
            @include('admin.partials.category', ['categories' => $categories])
            {{-- @foreach($categories as $category)
            <li @if(Request::input('category') == $category->id)class="active"@endif><a href="{{url('backend/goods?category=' . $category->id )}}">{{ $category->name }}</a></li>
            @endforeach --}}
          </ul>
        </li>

        @hasrole(['super-admin', 'admin'])
        {{-- <li class="nav-item pcoded-menu-caption">
          <label>Интернет-магазин</label>
        </li>
        <li class="nav-item @if(Request::is('backend/orders*')) active @endif"><a href="{{url('backend/orders')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">{{ __('admin.Orders') }}</span></a></li>
        <li class="nav-item @if(Request::is('backend/payments*')) active @endif"><a href="{{url('backend/payments')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">{{ __('admin.Payments') }}</span></a></li>
        <li class="nav-item @if(Request::is('backend/coupons*')) active @endif"><a href="{{route('admin.coupons.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">@lang('admin.Coupons')</span></a></li>
        <li class="nav-item @if(Request::is('admin/discounts*')) active @endif"><a href="{{url('admin/discounts')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-percent"></i></span><span class="pcoded-mtext">{{ __('admin.Discounts') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/delivery-methods*')) active @endif"><a href="{{url('admin/delivery-methods')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.DeliveryMethods') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/payment-methods*')) active @endif"><a href="{{url('admin/payment-methods')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.PaymentMethods') }}</span></a></li>
        <li class="nav-item @if(Request::is('admin/calendar')) active @endif"><a href="{{url('admin/calendar')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-calendar m-r-5"></i></span><span class="pcoded-mtext">Режим работы корзины</span></a></li> --}}
        @endhasrole


        {{-- <li class="nav-item pcoded-hasmenu @if(Request::is('backend/logs*')) active @endif">
          <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-info"></i></span><span class="pcoded-mtext">{{ __('admin.Logs') }}</span></a>
          <ul class="pcoded-submenu">
            <li @if(Request::is('backend/logs/activity'))class="active"@endif><a href="{{url('backend/logs/activity')}}">Логи активности</a></li>
            <li @if(Request::is('backend/logs/products'))class="active"@endif><a href="{{url('backend/logs/products')}}">Импорт товаров</a></li>
            <li @if(Request::is('backend/logs/groups'))class="active"@endif><a href="{{url('backend/logs/groups')}}">Импорт разделов</a></li>
            <li @if(Request::is('backend/logs/orders'))class="active"@endif><a href="{{url('backend/logs/orders')}}">Экспорт заказов в iiko</a></li>
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

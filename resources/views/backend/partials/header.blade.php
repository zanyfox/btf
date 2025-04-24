<header class="pc-header">
  <div class="header-wrapper">
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i data-feather="menu"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i data-feather="menu"></i>
          </a>
        </li>
        <li class="dropdown pc-h-item">
          <a
            class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
            <i data-feather="search"></i>
          </a>
          <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3 py-2">
              <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
            </form>
          </div>
        </li>
      </ul>
    </div>
    <div class="ms-auto">
      @php
      $newMessages = \App\Models\Message::where('status','new')->take(7)->get();
      //$newMessages = [];
      @endphp
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item">
          <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
            <i data-feather="bell"></i>
            <span class="badge bg-success pc-h-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header d-flex align-items-center justify-content-between">
              <h5 class="m-0">Notifications</h5>
              <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
            </div>
            <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
              @foreach($newMessages as $message)

              <div class="card mb-0">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img class="img-radius avtar rounded-0" src="/assets/backend/images/user/avatar-2.jpg" alt="Generic placeholder image" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <span class="float-end text-sm text-muted">{{ $message->created_at->diffForHumans() }}</span>
                      <h5 class="text-body mb-2">{{ $message->name }}</h5>
                      <a href="{{ url('admin/messages/'.$message->id) }}" class="media p-2">
                        <div class="media-body p-0">
                          <p>{{ $message->email }}</p>
                          <button class="btn btn-sm btn-outline-secondary me-2">Decline</button>
                          <button class="btn btn-sm btn-primary">Accept</button>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="text-center py-2">
              <a href="#!" class="link-danger">Clear all Notifications</a>
            </div>
          </div>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
          <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            data-bs-auto-close="outside"
            aria-expanded="false"
          >
            <i data-feather="user"></i>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-0 overflow-hidden">
            <div class="dropdown-header d-flex align-items-center justify-content-between bg-primary">
              <div class="d-flex my-2">
                <div class="flex-shrink-0">
                  <img src="/assets/backend/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35" />
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="text-white mb-1">Carson Darrin 🖖</h6>
                  <span class="text-white text-opacity-75">carson.darrin@company.io</span>
                </div>
              </div>
            </div>
            <div class="dropdown-body">
              <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                <a href="#" class="dropdown-item">
                  <span>
                    <svg class="pc-icon text-muted me-2">
                      <use xlink:href="#custom-setting-outline"></use>
                    </svg>
                    <span>Settings</span>
                  </span>
                </a>
                <a href="#" class="dropdown-item">
                  <span>
                    <svg class="pc-icon text-muted me-2">
                      <use xlink:href="#custom-share-bold"></use>
                    </svg>
                    <span>Share</span>
                  </span>
                </a>
                <a href="#" class="dropdown-item">
                  <span>
                    <svg class="pc-icon text-muted me-2">
                      <use xlink:href="#custom-lock-outline"></use>
                    </svg>
                    <span>Change Password</span>
                  </span>
                </a>
                <div class="d-grid my-2">
                  <button class="btn btn-primary">
                    <svg class="pc-icon me-2">
                      <use xlink:href="#custom-logout-1-outline"></use></svg>Logout
                  </button>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>

{{--
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
  <div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="{{ url('/admin') }}" class="b-brand">
      <img src="" class="logo" width="50" alt="">
      <img src="/assets/admin/images/logo-icon.png" alt="" class="logo-thumb">
    </a>
    <a href="#!" class="mob-toggler">
      <i class="feather icon-more-vertical"></i>
    </a>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
        {{ html()->form('GET', '/admin/goods')->class('search-bar')->open() }}
          {{ html()->text('search')->value(Request::get('search'))->class('form-control border-0 shadow-none')->placeholder('Поиск по каталогу товаров') }}
          <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        {{ html()->form()->close() }}
      </li>
      <li class="nav-item">
        <div class="dropdown">
          <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
            Dropdown
          </a>
          <div class="dropdown-menu profile-notification ">
            <ul class="pro-body">
              <li><a href="user-profile.html" class="dropdown-item"><i class="fas fa-circle"></i> Profile</a></li>
              <li><a href="email_inbox.html" class="dropdown-item"><i class="fas fa-circle"></i> My Messages</a></li>
              <li><a href="auth-signin.html" class="dropdown-item"><i class="fas fa-circle"></i> Lock Screen</a></li>
            </ul>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <div class="dropdown mega-menu">
          <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
            Mega
          </a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li>
        <a href="{{url('/admin/clear-cache')}}" title="Очистка кэша">
          <i class="icon feather icon-refresh-cw"></i>
        </a>
      </li>
      <li>
        <a href="{{url('/admin/storage-link')}}" title="Перезаписать пути к изображениям">
          <i class="icon feather icon-link-2"></i>
        </a>
      </li>
      <li>
        <a href="{{url('/')}}" title="Перейти на сайт" target="_blank">
          <i class="icon feather icon-crosshair"></i>
        </a>
      </li>


      <li>
        <div class="dropdown">
          <a class="dropdown-toggle" href="#" data-toggle="dropdown">
            <i class="icon feather icon-bell"></i>
            <span class="badge badge-pill badge-danger">{{ count($newMessages) }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right notification">
            <div class="noti-head">
              <h6 class="d-inline-block m-b-0">Новые сообщения</h6>
            </div>
            <ul class="noti-body">

            </ul>
            <div class="noti-footer">
              <a href="{{ url('admin/messages') }}">смотреть все</a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="dropdown drp-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="feather icon-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-notification">
            <div class="pro-head">
              <img src="images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
              <span>{{ Auth::guard('admin')->user()->name }}</span>
              <a href="{{ route('admin.logout') }}" class="dud-logout" title="Logout">
                <i class="feather icon-log-out"></i>
              </a>
            </div>
            <ul class="pro-body">
              <li><a href="{{ url('/admin/users/' . Auth::guard('admin')->user()->id . '/edit') }}" class="dropdown-item"><i class="feather icon-user"></i> {{__('admin.Profile')}}</a></li>
              <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
              <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</header> --}}

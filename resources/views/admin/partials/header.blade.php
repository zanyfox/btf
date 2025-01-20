<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
  <div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="{{ url('/admin') }}" class="b-brand">
      <img src="{{asset('assets/images/company-logo.svg')}}" class="logo" width="50" alt="">
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
      {{-- <li class="nav-item">
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
      </li> --}}
      {{-- <li class="nav-item">
        <div class="dropdown mega-menu">
          <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
            Mega
          </a>
          <div class="dropdown-menu profile-notification ">
            <div class="row no-gutters">
              <div class="col">
                <h6 class="mega-title">UI Element</h6>
                <ul class="pro-body">
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Alert</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Button</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Modal</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Tabs & pills</a></li>
                </ul>
              </div>
              <div class="col">
                <h6 class="mega-title">Forms</h6>
                <ul class="pro-body">
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Elements</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Validation</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Masking</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Wizard</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Picker</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Select</a></li>
                </ul>
              </div>
              <div class="col">
                <h6 class="mega-title">Application</h6>
                <ul class="pro-body">
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-mail"></i> Email</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-clipboard"></i> Task</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-check-square"></i> To-Do</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-image"></i> Gallery</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-help-circle"></i> Helpdesk</a></li>
                </ul>
              </div>
              <div class="col">
                <h6 class="mega-title">Extension</h6>
                <ul class="pro-body">
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-file-plus"></i> Editor</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-file-minus"></i> Invoice</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-calendar"></i> Full calendar</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-upload-cloud"></i> File upload</a></li>
                  <li><a href="#!" class="dropdown-item"><i class="feather icon-scissors"></i> Image cropper</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </li> --}}
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

      @php
      $newMessages = \App\Models\Message::where('status','new')->take(7)->get();
      //$newMessages = [];
      @endphp
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
              @foreach($newMessages as $message)
              <li class="notification p-2">
                <a href="{{ url('admin/messages/'.$message->id) }}" class="media p-2">
                  <div class="media-body p-0">
                    <p><strong>{{ $message->name }}</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>{{ $message->created_at->diffForHumans() }}</span></p>
                    <p>{{ $message->phone }}</p>
                    <p>{{ $message->email }}</p>
                    {{-- <div>{!! $message->content !!}</div> --}}
                  </div>
                </a>
              </li>
              @endforeach
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
              {{-- <img src="images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image"> --}}
              <span>{{-- {{ Auth::guard('admin')->user()->name }} --}}</span>
              <a href="{{ route('admin.logout') }}" class="dud-logout" title="Logout">
                <i class="feather icon-log-out"></i>
              </a>
            </div>
            <ul class="pro-body">
              {{-- <li><a href="{{ url('/admin/users/' . Auth::guard('admin')->user()->id . '/edit') }}" class="dropdown-item"><i class="feather icon-user"></i> {{__('admin.Profile')}}</a></li> --}}
              {{-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
              <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li> --}}
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</header>
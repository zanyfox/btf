<aside id="sidebar">
  <div class="sidebar_content sidebar_head">
    <button type="button" class="close close_sidebar">&times;</button>
  </div>
  <div class="sidebar_content sidebar_body">
    @if($pages->isNotEmpty())
    <nav class="side_navlinks">
      <ul>
        @foreach( $pages as $page )
          @if($page->slug != 'home')
            @if($page->slug == 'restaraunt-menu')
            <li><a href="/table-reservation" target="_blank">@lang('TableReservation')</a></li>
            @endif
            <li @if(request()->is($page->slug . '*'))class="active"@endif>
              <a href="{{url($page->slug)}}" title="{{ $page->title }}" @if($page->slug == 'menu-delivery')class="btn-shine"@endif>{{ $page->title }}</a>
            </li>
          @endif
        @endforeach
        <li><a href="{{url('premium-bonus')}}">Бонусная программа</a></li>
      </ul>
    </nav>
    @endif
  </div>

  <div class="sidebar_content sidebar_foot">
    <a href="{{URL::to('/')}}" class="sidebar-logo">
      <img src="{{asset('assets/img/logo.svg')}}" width="55" height="40" alt="{{$settings['sitename']}}">
    </a>
    <p class="text-orange">Ежедневно</p>
    <p>11:00 — 22:00</p>
    @if(isset($settings['phone']) && !empty($settings['phone']))
    <p><a href="tel:{{$settings['phone']}}">{{$settings['phone']}}</a></p>
    @endif
    @include('partials.social-media', ['class' => 'sidebar-social-media'])
  </div>
</aside>
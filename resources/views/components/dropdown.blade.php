<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $slot }} <i class="fas fa-caret-down"></i></a>
<ul class="dropdown-menu dropdown-menu-right client-links " aria-labelledby="dropdownMenuLink">
  @guest
    @if(Route::has('login'))
    <li><x-dropdown-link href="{{route('login')}}">{{__('app.Sign In')}}</x-dropdown-link></li>
    @endif
    @if(Route::has('register'))
    <li><x-dropdown-link href="{{route('register')}}">{{__('app.Sign Up')}}</x-dropdown-link></li>
    @endif
    <li><x-dropdown-link href="{{url('auth/reset')}}">{{__('app.Forgot Password?')}}</x-dropdown-link></li>
  @else
    <li>
      <x-dropdown-link href="{{url('clientarea/details')}}">{{__('app.Account Details')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('account/users')}}">{{__('app.User Management')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('account/paymentmethods')}}">{{__('app.Payment Methods')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('account/contacts')}}">{{__('app.Contacts')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('clientarea/emails')}}">{{__('app.Email History')}}</x-dropdown-link>
    </li>
    <div class="dropdown-divider"></div>
    <li>
      <x-dropdown-link href="{{url('user/profile')}}">{{__('app.Your Profile')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('user/password')}}">{{__('app.Change Password')}}</x-dropdown-link>
    </li>
    <li>
      <x-dropdown-link href="{{url('user/security')}}">{{__('app.Security Settings')}}</x-dropdown-link>
    </li>
    @if(Auth::user()->is_admin)
    <li>
      <x-dropdown-link href="{{route('admin.index')}}" :active="request()->routeIs('admin.index')">{{__('app.Admin Panel')}}</x-dropdown-link>
    </li>
    @endif
    <div class="dropdown-divider"></div>
    <li>
      <form action="{{url('logout')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-link">{{__('app.Logout')}}</button>
      </form>
      {{-- <x-dropdown-link href="{{url('logout')}}">{{__('app.Logout')}}</x-dropdown-link> --}}
    </li>
  @endguest
</ul>

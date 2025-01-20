@extends('layouts.account')

@section('title', __('PersonalArea'))

@section('content')
<section class="content-header">
  <x-flash-message />
  <div class="container">
    <div class="account-page content pb-0">
      @include('partials.breadcrumbs', ['links' => [['title' => __('Main'),'slug' => route('home')], ['title' => __('app.PersonalArea'),'slug' => 'account']]])

      <h1>{{ __('PersonalArea') }}</h1>

      @if(session()->has('success'))
      <p class="alert alert-success">{{ session()->get('success') }}</p>
      @endif

      @if(session()->has('fail'))
      <p class="alert alert-fail">{{ session()->get('fail') }}</p>
      @endif

      <div class="flex-container">
        {{-- <div class="flex-item">
          <div class="premium-panel">
            <div class="premium-panel-item">
              <h4>0 <small>бонусов</small></h4>
            </div>
            <div class="premium-panel-item">
              <h4>5% <small>знакомства</small></h4>
            </div>
            <div class="premium-panel-item">
              <h4>10000 Р.<small>до следующего ранга</small></h4>
            </div>
          </div>
          <a href="{{ url('premium-bonus')}}" target="_block">@lang('app.BonusProgram')</a>
        </div> --}}
        <div class="flex-item">

          {{-- <ul class="nav nav-tabs" role="tablist">
            <li><a href="/account" role="tab" aria-selected="true">@lang('app.Profile')</a></li>
            <li><a href="/account/orders" role="tab">@lang('app.OrderHistory')</a></li>
            <li><a href="/account/addresses" role="tab">@lang('app.DeliveryAddresses')</a></li>
            <li><span id="btnAccountLogout">@lang('app.Logout')</span></li>
          </ul> --}}
          
          <div id="tabProfile" role="tabpanel">
            <form action="{{ route('account.updateProfile') }}" method="POST" name="profileForm" id="profileForm">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="inputProfileName">@lang('app.FirstName')</label>
                  <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputProfileName" placeholder="@lang('app.InsertFirstName')*">
                  <div></div>
                </div>
                <div class="form-group">
                  <label for="inputProfileSurname">@lang('app.LastName')</label>
                  <input type="text" name="surname" value="{{ $user->name }}" class="form-control" id="inputProfileSurname" placeholder="@lang('app.InsertLastName')">
                  <div></div>
                </div>
                <div class="form-group">
                  <label for="inputProfilePhone">@lang('app.Phone')</label>
                  <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control" id="inputProfilePhone" placeholder="@lang('app.EnterPhone')">
                  <div></div>
                </div>
                <div class="form-group">
                  <label for="inputProfileBirthday">@lang('app.DateOfBirth')</label>
                  <input type="date" name="birthday" value="" class="form-control" id="inputProfileBirthday">
                  <div></div>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputProfileEmail" placeholder="@lang('app.EnterEmail')">
                  <div></div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">@lang('app.Save')</button>
              </div>
            </form>
          </div>
          <div id="tabHistory" role="tabpanel" hidden></div>
          <div id="tabAddress" role="tabpanel" hidden>
            <button type="button" class="btn" id="btnAddDeliveryAddress">@lang('app.Add')</button>
            <div class="content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div id="createCustomerAddressModal" class="modal customer-address-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div class="modal-content">
        <h3>Добавить адрес доставки</h3>
        <form action="#" method="POST" id="createCustomerAddressForm">
          <div class="form-group">
            <label for="inputCreateCustomerAddressName">Название</label>
            <input type="text" class="form-control" id="inputCreateCustomerAddressName">
          </div>
          <div class="form-group">
            <label for="inputCreateCustomerAddressCity">@lang('app.City')</label>
            <input type="text" name="city" class="form-control" value="Светлогорск" id="inputCreateCustomerAddressCity">
          </div>
          <div class="form-group">
            <label for="inputCreateCustomerAddressStreet">@lang('app.Street')</label>
            <select class="form-control" data-trigger id="inputCreateCustomerAddressStreet"></select>
          </div>
          <div class="flex-container">
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressHouse">@lang('app.House')</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressHouse">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressBuilding">Корпус</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressBuilding">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressEntrance">Подъезд</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressEntrance">
              </div>
            </div>
          </div>
          <div class="flex-container">
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressFlat">Квартира</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressFlat">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressFloor">Этаж</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressFloor">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputCreateCustomerAddressDoorphone">Код двери</label>
                <input type="text" class="form-control" id="inputCreateCustomerAddressDoorphone">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary w-100">Сохранить</button>
        </form>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="editCustomerAddressModal" class="modal customer-address-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="customer-address-modal-description" class="modal-content">
        <h3>Добавить адрес доставки</h3>
        <form action="#" method="POST" id="editCustomerAddressForm">
          <input type="hidden" name="id" value="" id="inputEditCustomerAddressId">
          <div class="form-group">
            <label for="inputEditCustomerAddressName">Название</label>
            <input type="text" class="form-control" id="inputEditCustomerAddressName">
          </div>
          <div class="form-group">
            <label for="inputEditCustomerAddressCity">@lang('app.City')</label>
            <input type="text" name="city" class="form-control" id="inputEditCustomerAddressCity">
          </div>
          <div class="form-group">
            <label for="inputEditCustomerAddressStreet">@lang('app.Street')</label>
            <select class="form-control" data-trigger id="inputEditCustomerAddressStreet"></select>
          </div>
          <div class="flex-container">
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressHouse">@lang('app.House')</label>
                <input type="text" class="form-control" id="inputEditCustomerAddressHouse">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressBuilding">@lang('app.Building')</label>
                <input type="text" class="form-control" id="inputEditCustomerAddressBuilding">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressEntrance">@lang('app.Entrance')label>
                <input type="text" class="form-control" id="inputEditCustomerAddressEntrance">
              </div>
            </div>
          </div>
          <div class="flex-container">
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressFlat">Квартира</label>
                <input type="text" class="form-control" id="inputEditCustomerAddressFlat">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressFloor">Этаж</label>
                <input type="text" class="form-control" id="inputEditCustomerAddressFloor">
              </div>
            </div>
            <div class="flex-item">
              <div class="form-group">
                <label for="inputEditCustomerAddressDoorphone">Код двери</label>
                <input type="text" class="form-control" id="inputEditCustomerAddressDoorphone">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary w-100">Сохранить</button>
        </form>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>


@endsection

<link rel="stylesheet" href="{{ asset('js/tabby/tabby-ui.min.css') }}">
<script src="{{ asset('js/tabby/tabby.polyfills.min.js') }}"></script>
{{-- <script type="module" src="{{ asset('js/mathUtil.js') }}"></script> --}}
<script type="module" src="{{ asset('js/account.js') }}"></script>
@push('scripts')
<script></script>
@endpush
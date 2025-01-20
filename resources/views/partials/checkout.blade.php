<div class="checkout">
  <div class="checkout-content">
    <div class="checkout-header">
      <div class="container">
        <a href="javascript:void(0)" class="close-checkout btnCloseCheckout"><i class="icon icon-arrow-left"></i> {{__('BackToCart')}}</a>
        <h1>{{trans('Checkout')}}</h1>
      </div>
    </div>
    <div class="checkout-body">
      <div class="container">
        <form method="POST" name="order-form" id="orderForm">
          <div class="grid-container">
            <div class="grid-item">
              <div class="checkout-map">
                <div id="checkoutMap" style="height: 325px;"></div>
              </div>
              <div class="checkout-form-block">
                <h3>{{__('PleaseFillTheFollowingFields')}}</h3>
                <div class="form-flex flex-columns-2" id="basicInformation">
                  <div class="form-group">
                    <input type="text" name="checkout_name" id="checkoutInputName" class="form-control" value="{{ auth()->check() ? auth()->user()->name : '' }}" placeholder="{{__('YourName')}}">
                    <small class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <input type="tel" name="checkout_phone" id="checkoutInputPhone" class="form-control imask" value="{{ auth()->check() ? auth()->user()->phone : '' }}" placeholder="+7 000 000 00 00">
                    <small class="text-danger"></small>
                  </div>
                </div>
                @php
                $deliveryMethods = \App\Models\DeliveryMethod::where('status',true)->get();
                @endphp
                @if($deliveryMethods->isNotEmpty())
                <div class="form-flex flex-columns-2">
                  @foreach($deliveryMethods as $deliveryMethod)
                  <div class="form-group">
                    <div class="form_radio_btn">
                      <input type="radio" id="deliveryType{{ $deliveryMethod->code }}" name="delivery_type" value="{{ $deliveryMethod->code }}" data-externalid="{{ $deliveryMethod->external_id }}" @if($loop->index == 0)checked="checked"@endif>
                      <label for="deliveryType{{ $deliveryMethod->code }}">{{ $deliveryMethod->name }} @if($deliveryMethod->code == 'DeliveryPickUp')<span class="hidden-mobile"> из ресторана</span>@endif</label>
                    </div>
                  </div>
                  @endforeach
                </div>
                @endif
                <div id="addressFields" style="display: @if( count($deliveryMethods) < 2 ) none @else block @endif;">
                  <div class="form-flex flex-columns-2 flex-columns-mobile-1">
                    <div class="form-group">
                      <label for="checkoutInputCity">{{__('City')}}</label>
                      <input type="text" name="checkout_city" value="Светлогорск" id="checkoutInputCity" readonly data-externalid="a65dacbc-acfa-4ec7-9435-e9300a063aff" class="form-control">
                      {{-- <select name="checkout_city" id="checkoutInputCity" readonly class="form-control"></select> --}}
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputStreet">{{__('Street')}}</label>
                      <select class="form-control" data-trigger name="checkout_street" id="checkoutInputStreet" placeholder="Выбрать улицу"></select>
                      <small class="text-danger"></small>
                    </div>
                  </div>
                  <div class="form-flex flex-columns-5">
                    <div class="form-group">
                      <label for="checkoutInputHouse">{{__('HouseNumber')}}</label>
                      <input type="text" name="checkout_house" id="checkoutInputHouse" maxlength="10" class="form-control">
                      <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputBuilding">{{__('Building')}}</label>
                      <input type="text" name="checkout_building" id="checkoutInputBuilding" maxlength="10" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputEntrance">{{__('Entrance')}}</label>
                      <input type="text" name="checkout_entrance" id="checkoutInputEntrance" maxlength="10" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputFloor">{{__('Floor')}}</label>
                      <input type="text" name="checkout_floor" id="checkoutInputFloor" maxlength="10" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputFlat">{{__('Flat')}}</label>
                      <input type="text" name="checkout_flat" id="checkoutInputFlat" maxlength="10" class="form-control">
                    </div>
                  </div>
                </div>
                <div id="selfDeliveryAddress" style="display: @if( count($deliveryMethods) < 2 ) block @else none @endif;">
                  @if(isset($settings['address']) && !empty($settings['address']))
                  <p>{{__('YourOrderWillBeDeliveredHere')}}: {{$settings['address']}}</p>
                  @endif
                </div>
                <div class="form-flex flex-columns-2">
                  <div class="form-group">
                    <div class="form_radio_btn">
                      <input type="radio" id="deliveryTimeOnway" name="delivery_time" value="onway" checked="checked">
                      <label for="deliveryTimeOnway">{{__('DeliveryTimeOnway')}}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form_radio_btn">
                      <input type="radio" id="deliveryTimeOntime" name="delivery_time" value="ontime">
                      <label for="deliveryTimeOntime">{{__('DeliveryTimeOntime')}}</label>
                    </div>
                  </div>
                </div>
                <div id="timeFields" style="display: none;">
                  <div class="form-flex flex-columns-2 flex-columns-mobile-1">
                    <div class="form-group">
                      <label for="checkoutInputDate">{{__('Date')}}</label>
                      <input type="date" name="checkout_date" id="checkoutInputDate" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                      <label for="checkoutInputTime">{{__('Time')}}</label>
                      <input type="time" name="checkout_time" id="checkoutInputTime" class="form-control" value="{{\Carbon\Carbon::now()->add('1 hour')->format('H:i')}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="checkout-form-block payments-form-block">
                @php
                $paymentMethods = \App\Models\PaymentMethod::where('status',true)->orderBy('sort','ASC')->get();
                @endphp
                @if($paymentMethods->isNotEmpty())
                <h3>{{__('SelectPaymentMode')}}</h3>
                <div class="form-flex flex-columns-4">
                  @foreach($paymentMethods as $paymentMethod)
                    @if( $paymentMethod->code == 'ONLN' )
                    <div class="form-group form_radio_btn">
                      <input type="radio" id="paymentMethod{{ $paymentMethod->code }}" name="payment_method" value="{{ $paymentMethod->code }}">
                      <label for="paymentMethod{{ $paymentMethod->code }}">
                      <img src="{{ asset('assets/img/icon-mir.svg') }}" width="70" style="margin-top: 10px; margin-bottom: 10px;" alt="Online Payment Mode">
                        <span>{{ $paymentMethod->name }}</span>
                      </label>
                    </div>
                    @elseif( $paymentMethod->code == 'SBP' )
                    <div class="form-group form_radio_btn">
                      <input type="radio" id="paymentMethod{{ $paymentMethod->code }}" name="payment_method" value="{{ $paymentMethod->code }}">
                      <label for="paymentMethod{{ $paymentMethod->code }}">
                        <img src="{{ asset('assets/img/icons/sbp.svg') }}" class="hidden-checked" width="70" alt="{{ $paymentMethod->description }}">
                        <img src="{{ asset('assets/img/icons/sbp-white.svg') }}" class="visible-checked" width="70" alt="{{ $paymentMethod->description }}">
                        <span>{{ $paymentMethod->name }}</span>
                      </label>
                    </div>
                    @else
                    <div class="form-group form_radio_btn">
                      <input type="radio" id="paymentMethod{{ $paymentMethod->code }}" name="payment_method" value="{{ $paymentMethod->code }}" @if($loop->index == 0)checked="checked"@endif>
                      <label for="paymentMethod{{ $paymentMethod->code }}">
                        @if( $paymentMethod->code == 'CASH' )
                        <img src="{{ asset('assets/img/icon-rubl.svg') }}" class="hidden-checked" alt="Cash On Delivery">
                        <img src="{{ asset('assets/img/icon-rubl-white.svg') }}" class="visible-checked" alt="">
                        @endif
                        @if( $paymentMethod->code == 'CARD' )
                        <img src="{{ asset('assets/img/icons/card-send.svg') }}" width="40" class="hidden-checked" alt="Card On Delivery">
                        <img src="{{ asset('assets/img/icons/card-send-white.svg') }}" width="40" class="visible-checked" alt="">
                        @endif
                        <span>{{ $paymentMethod->name }}</span>
                      </label>
                    </div>
                    @endif
                  @endforeach
                </div>
                @endif
                <div class="form-group" id="moneyChange">
                  <label for="inputCheckoutMoneychange">{{__('RequiredPickup')}}:</label>
                  <input type="text" name="checkout_moneychange" class="form-control" id="inputCheckoutMoneychange">
                </div>
                <div class="form-group">
                  <label>{{__('PlaceCutlery?')}}</label>
                  <div class="form_toggle">
                    <div class="form_toggle-item item-1">
                      <input id="inputCutleryOff" type="radio" name="cutlery" value="off" checked>
                      <label for="inputCutleryOff">{{__('No')}}</label>
                    </div>
                    <div class="form_toggle-item item-2">
                      <input id="inputCutleryOn" type="radio" name="cutlery" value="on">
                      <label for="inputCutleryOn">{{__('Yes')}}</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="checkoutInputEmail">{{__('InsertEmailAndWeWillSendYouCheck')}}</label>
                  <input type="email" name="checkout_email" id="checkoutInputEmail" value="{{ Auth::check() ? Auth::user()->email : '' }}" class="form-control">
                  <small class="text-danger"></small>
                </div>
                <div class="form-group">
                  <label for="checkoutInputNotes">{{__('OrderComment')}}</label>
                  <textarea name="checkout_notes" class="form-control" id="checkoutInputNotes"></textarea>
                </div>
                <div class="form-group">
                  <div class="form-group-append">
                    <input type="text" name="checkout_couponcode" id="checkoutInputCouponcode" class="form-control inputCoupon" placeholder="Введите промокод">
                    <button type="button" class="btn btn-cancel btnRemoveCoupon" @if(!Session::has('discount')) style="display: none;" @endif>@lang('Cancel')</button>
                  </div>
                  <span class="text-danger invalid-feedback couponcodeMessage"></span>
                </div>
              </div>
            </div>
            <div class="grid-item">
              <div class="checkout-summary">
                <h3>{{__('CheckOrder')}}</h3>
                <div id="checkoutSummary"></div>
                <small class="d-block text-danger text-orange" style="text-align: center; display: block; margin-bottom: 10px;" id="checkoutValidation"></small>
                <div class="checkout-summary-btns">
                  <button type="button" class="btn btn-primary-outline btnCloseCheckout">{{__('Change')}}<span class="hidden-mobile"> заказ</span></button>
                  <button type="submit" class="btn btn-primary" disabled2 title="{{__('PlaceOrder')}}">{{__('Place')}}</button>
                </div>
                <p>Продолжая, вы даете свое согласие на <a href="/privacy-policyregano.pdf" target="_blank">обработку Ваших персональных данных</a> и принимаете условия <a href="/regano.pdf" target="_blank">Пользовательского соглашения</a>.</p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- @if() Тест @endif --}}

{{-- <script src="https://api-maps.yandex.ru/2.1/?apikey=388a2222-79af-4a68-9aee-366c805c4825&lang=ru_RU"></script>
<script>
  var myMap = new ymaps.Map('checkoutMap', {
    center: ['54.947113', '20.159578'],
    zoom: 13,
    controls: ['zoomControl'],
  }, {
    searchControlProvider: 'yandex#search'
  }),
  MyIconContentLayout = ymaps.templateLayoutFactory.createClass('<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>')
  ymaps.geocode('Калининградская область, г. Светлогорск, Морской бульвар, 19').then(function (res) {
    baloon = res.geoObjects.get(0).geometry.getCoordinates();
    myPlacemark = new ymaps.Placemark([baloon[0], baloon[1]], {
      balloonContent: '<span><b>""</b></span><br><span></span>'
    }, {
      iconLayout: 'default#imageWithContent',
      iconImageHref: 'favicon.svg',
      iconImageSize: [40, 40],
      //iconImageOffset: [-35, -85],
      iconContentOffset: [15, 15],
      iconContentLayout: MyIconContentLayout
    })
    myMap.geoObjects.add(myPlacemark)
  })
  myMap.behaviors.disable('scrollZoom')

</script> --}}
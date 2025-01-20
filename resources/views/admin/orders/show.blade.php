@section('title', __('admin.OrderPreview'))
<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/orders')}}">@lang('admin.Orders')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditOrder')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <x-flash-message />
  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.Order') #{{$order->id}}<br><small class="text-danger">{{$order->created_at->format('d.m.Y H:i')}}</small> @if($order->external_id)<small class="text-danger">| #{{$order->external_id}}</small>@endif</h5>
      <div class="float-right">
        <a href="{{url('admin/orders/view-invoice/' . $order->id)}}" target="_blank" class="btn btn-sm btn-default"><i class="feather icon-eye"></i> @lang('admin.ViewInvoice')</a>
        <a href="{{url('admin/orders/download-invoice/' . $order->id)}}" class="btn btn-sm btn-default"><i class="feather icon-download"></i> @lang('admin.DownloadInvoice')</a>
        <a href="{{url('admin/orders/send-invoice/' . $order->id)}}" class="btn btn-sm btn-default"><i class="feather icon-mail"></i> @lang('admin.SendInvoice')</a>
        <select name="status" class="form-control form-control-sm d-inline" id="changeOrderStatus" style="width: auto!important;">
          @foreach (\App\Enums\OrderStatus::cases() as $status)
          <option value="{{$status->value}}" @selected($order->status->value === $status->value)>{{__('admin.' . $status->name)}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="customerSurname">Фамилия</label>
            <input type="text" id="customerSurname" name="customer[surname]" value="{{ $order->surname }}" class="form-control">
          </div>
          <div class="form-group">
            <label for="customerName">@lang('admin.Name') <span class="text-danger">*</span></label>
            <input type="text" id="customerName" name="customer_name" value="{{ $order->name }}" class="form-control">
          </div>
          <div class="form-group">
            <label for="customerPatronymic">Отчество</label>
            <input type="text" id="customerPatronymic" name="customer[patronymic]" value="{{ $order->patronymic }}" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="customerEmail">Email</label>
            <div class="uk-form-controls">
              <input type="text" id="customerEmail" name="customer[email]" value="{{ $order->email }}" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="customerPhone">@lang('admin.Phone')</label>
            <input type="text" id="customerPhone" name="customer[phone]" value="{{ $order->phone }}" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.OrderList') <sup class="text-danger">{{ $order->items->count() }}</sup></h5>
      {{-- <button type="button" class="btn btn-sm btn-primary float-right"><i class="feather icon-plus"></i> Добавить товар</button> --}}
    </div>
    <div class="card-body">
      <div class="table-overflow">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Товар</th>
              <th>Внешний ID</th>
              <th>@lang('admin.Price')</th>
              <th>@lang('admin.Qty')</th>
              <th class="text-right">@lang('admin.Sum')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $item)
            <tr>
              <td>
                <a href="{{ url('/admin/goods?search=' . $item->external_id) }}" target="_blank">{{ $item->name }}</a>
                @php
                $itemModifiers = DB::table('item_modifiers')->select('goods.name','goods.price')->leftJoin('goods', 'goods.id','=','item_modifiers.modifier_id')->where('item_modifiers.item_id', $item->id)->get();
                @endphp
                @if($itemModifiers->isNotEmpty())
                <ul>
                  @foreach($itemModifiers as $itemModifier)
                  <li>{{ $itemModifier->name }}, стоимость: {{ $itemModifier->price }}</li>
                  @endforeach
                </ul>
                @endif
              </td>
              <td>{{ $item->external_id }}</td>
              <td>{{ number_format($item->price, 0, '.', ' ') }}</td>
              <td>{{ $item->quantity }}</td>
              <td class="text-right">{{ number_format($item->total, 0, '.', ' ') }} {{ $order->currency->symbol }} {{-- {{ $item->pivot->quantity }} --}}  {{-- {{ $item->getPriceForQuantity($item->quantity) }} --}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <hr>
        <div class="float-right text-right">
          <ul class="list-unstyled">
            <li><span class="text-muted">@lang('admin.Subtotal'):</span> <span class="text-danger"><span id="resumeItemsPrice">{{ number_format($order->subtotal, 0, '.', ' ') }}</span> {{ $order->currency->symbol }} <i class="uk-icon-rub"></i></span></li>
            <li><span class="text-muted">@lang('admin.Discount') {{ (!empty($order->discount_code)) ? '(' . $order->discount_code . ')' : '' }} :</span> {{ $order->discount_amount }} <i class="uk-icon-rub text-muted"></i></li>
            <li><span class="text-muted">@lang('admin.ShippingFee'):</span> <span>{{ $order->shipping }}</span> <i class="uk-icon-rub text-muted"></i></li>
          </ul>
          <p class="uk-text-large">@lang('admin.Total'): <span class="text-danger"><span>{{ number_format($order->grand_total, 0, '.', ' ') }}</span> <i class="uk-icon-rub"></i></span> {{-- {{ $order->getFullPrice() }} --}}</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col col-md-8">

      {{-- <div class="card">
        <div class="card-header">
          <h5>Склад</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
            <select class="form-control">
              <option>- Не указан -</option>
              <option>Основной склад</option>
            </select>
          </div>
          <div class="form-group">
            <div class="uk-form-controls">
              <div class="uk-form-icon">
                <div class="uk-icon-calendar"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="uk-form-controls">
              <div class="uk-badge">Не отгружен</div>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- <div class="card">
        <div class="card-header">
          <h5>Габариты и вес</h5>
        </div>
        <div class="card-body">
          <div class="alert alert-danger">Не удалось расчитать вес: не у всех товаров в составе указан вес.</div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="deliveryWeight">Вес, г</label>
                <input type="number" id="deliveryWeight" name="weight" value="500" class="form-control" placeholder="Вес">
              </div>
            </div>
            <div class="col-md-3">
              <label for="deliveryLength">Длина, мм</label>
              <input type="number" id="deliveryLength" name="length" value="150" class="form-control" placeholder="Длина">
            </div>
            <div class="col-md-3">
              <label for="deliveryWidth">Ширина, мм</label>
              <input type="number" id="deliveryWidth" name="width" value="100" class="form-control" placeholder="Ширина">
            </div>
            <div class="col-md-3">
              <label class="uk-form-label" for="deliveryHeight">Высота, мм</label>
              <input type="number" id="deliveryHeight" name="height" value="150" class="form-control" placeholder="Высота">
            </div>
          </div>
        </div>
      </div> --}}
      <div class="card">
        <div class="card-header">
          <h5>Доставка</h5>
        </div>
        <div class="card-body">
          @if($customerAddress)
          <div class="form-group">
            <label for="deliveriesList">Способ доставки</label>
            <div class="uk-form-controls">
              <select id="deliveriesList" name="delivery[code]" class="form-control">
                <option value="0" selected>-Укажите способ доставки-</option>
                @foreach($deliveryMethods as $deliveryMethod)
                <option value="{{ $deliveryMethod->id }}" @if($deliveryMethod->id == $customerAddress->type_id) selected @endif >{{ $deliveryMethod->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          {{-- <div class="form-group">
            <label for="deliveryTrackNumber">Номер отправления</label>
            <input type="text" id="deliveryTrackNumber" name="delivery[track_number]" class="form-control">
            <p class="text-muted">Для отслеживания статуса отправления укажите номер отправления</p>
          </div> --}}
          {{-- <div class="form-group">
            <label for="postCode">Почтовый индекс</label>
            <div class="row">
              <div class="col-md-3">
                <input type="text" id="postCode" name="delivery[zipcode]" class="form-control">
              </div>
              <div class="col-md-4">
                <a href="javascript:void(0);" class="btnDefinePostCode" style="text-decoration: none; border-bottom: 1px dotted;">Определить почтовый индекс по адресу</a>
              </div>
            </div>
          </div> --}}
          {{-- <div class="form-group">
            <label for="deliveryCountry">Страна</label>
            <input type="text" id="deliveryCountry" name="delivery[country]" value="{{ $order->countryName }}" class="form-control" autocomplete="off"">
          </div>
          <div class="form-group">
            <label for="deliveryRegion">Регион</label>
            <input type="text" id="deliveryRegion" name="delivery[region]" value="{{ $order->country }}" class="form-control" autocomplete="off">
          </div> --}}
          <div class="form-group">
            <label for="deliveryCity">Город</label>
            <input type="text" id="deliveryCity" name="delivery[city]" value="{{ $customerAddress->city }}" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="deliveryStreet">Улица</label>
            <input type="text" id="deliveryStreet" name="delivery[street]" value="{{ $customerAddress->street_name }}" class="form-control">
          </div>
          <div class="form-group">
            <div class="uk-form-controls">
              <div class="row">
                <div class="col-md-4">
                  <label for="deliveryBuilding">Дом</label>
                  <input type="text" id="deliveryBuilding" name="delivery[house]" value="{{ $customerAddress->house }}" class="form-control">
                </div>
                <div class="col-md-4">
                  <label for="deliveryFlat">Квартира</label>
                  <input type="text" id="deliveryFlat" name="delivery[flat]" value="{{ $customerAddress->flat }}" class="form-control addclear">
                </div>
                <div class="col-md-4">
                  <label for="deliveryHousing">Строение/Корпус</label>
                  <input type="text" id="deliveryHousing" name="delivery[housing]" value="{{ $customerAddress->building }}" class="form-control addclear">
                </div>
                <div class="col-md-4">
                  <label for="deliveryBlock">Подъезд</label>
                  <input type="text" id="deliveryBlock" name="delivery[entrance]" value="{{ $customerAddress->entrance }}" class="form-control addclear">
                </div>
                <div class="col-md-4">
                  <label for="deliveryFloor">Этаж</label>
                  <input type="text" id="deliveryFloor" name="delivery[floor]" value="{{ $customerAddress->floor }}" class="form-control addclear">
                </div>
              </div>
            </div>
          </div>
              
          <div class="form-group">
            <label for="deliveryNote">Дополнительная информация</label>
            <textarea id="deliveryNote" name="delivery[note]" cols="50" rows="4" class="form-control">{{ $customerAddress->notes }}</textarea>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="inputDeliveryDate">{{ __('admin.DeliveryDate') }}</label>
              <div class="input-group">
                <input type="date" name="delivery[date]" value="{{$customerAddress->delivery_date}}" id="inputDeliveryDate" class="form-control" autocomplete="off">
              </div>
            </div>    
            <div class="form-group col-md-4">
              <label for="inputDeliveryTime">{{ __('admin.DeliveryTime') }}</label>
              <div class="input-group">
                <input type="time" name="delivery[time]" value="{{$customerAddress->delivery_time}}" id="inputDeliveryTime" class="form-control">
              </div>
            </div>
            {{-- <div class="form-group col-md-4">
              <label for="shippedDate">{{ __('admin.ShippedDate') }}</label>
              <div class="input-group">
                <input type="date" name="delivery[date]" value="{{\Carbon\Carbon::parse($order->shipped_at)->format('Y-m-d')}}" id="shippedDate" class="form-control" autocomplete="off">
              </div>
            </div>    
            <div class="form-group col-md-4">
              <label for="shippedTime">{{ __('admin.ShippedTime') }}</label>
              <div class="input-group">
                <input type="time" id="shippedTimeFrom" name="delivery[time_from]" class="form-control" style="width: 100px;" data-uk-timepicker="data-uk-timepicker" min="00:00" max="23:59" pattern="[0-9]{2}:[0-9]{2}">
              </div>
            </div> --}}
            {{-- <div class="form-group col-md-4">
              <label for="shippedTime">{{ __('admin.ShippedTime') }}</label>
              <div class="input-group">
                <input type="time" id="shippedTimeFrom" name="delivery[time_from]" class="form-control" style="width: 100px;" data-uk-timepicker="data-uk-timepicker" min="00:00" max="23:59" pattern="[0-9]{2}:[0-9]{2}">
              </div>
            </div> --}}
          </div>
                  
          {{-- <div class="form-group">
            <label for="deliveryCost">Стоимость <span class="text-danger">*</span></label>
            <input type="number" id="deliveryCost" name="delivery[cost]" class="form-control">
            <p class="text-muted">Рассчитывать автоматически</p>
          </div>
          <div class="form-group">
            <label class="uk-form-label" for="deliveryNetcost">Себестоимость <span class="uk-text-danger">*</span></label>
            <div class="uk-form-controls">
              <input type="number" id="deliveryNetcost" name="delivery[netcost]" class="addclear">
              <p class="uk-text-muted">Рассчитывать автоматически</p>
            </div>
          </div>
          <div class="form-group">
            <label class="uk-form-label" for="deliveryLogistComment">Комментарий логиста</label>
            <textarea id="deliveryLogistComment" name="delivery[logist_comment]" cols="50" rows="10" class="form-control"></textarea>
          </div> --}}
          {{-- <div class="form-group">
            <label class="uk-form-label" for="deliveryShippingDate">Дата отгрузки (для накладной)</label>
            <div class="uk-form-controls">
              <div class="uk-form-icon">
                <div class="uk-icon-calendar"></div>
                <input type="text" id="deliveryShippingDate" name="delivery[shipping_date]" class="datepicker" autocomplete="off">
              </div>
            </div>
          </div> --}}
          {{-- <div class="form-group">
            <label class="uk-form-label" for="deliveryInvoiceNumber">Номер накладной</label>
            <div class="uk-form-controls">
              <input type="text" id="deliveryInvoiceNumber" name="delivery[invoice_number]" class="form-control addclear">
            </div>
          </div> --}}
          @endif  
        </div>
      </div>
      @isset($payment->type_id)
      <div class="card">
        <div class="card-header">
          <h5>Оплата</h5>
        </div>
        <div class="card-body">
          
          <div class="form-group">
            <label for="paymentType">Способ оплаты</label>
            <select id="paymentType" name="payment[type]" class="form-control" readonly disabled>
              <option value="0" selected="selected">-Укажите способ оплаты-</option>
              @foreach($paymentMethods as $paymentMethod)
              <option value="{{ $paymentMethod->id }}" @selected($paymentMethod->id == $payment->type_id)>{{ $paymentMethod->name }}</option>
              @endforeach
            </select>
          </div>
          
          {{-- <div class="form-group">
            <label class="uk-form-label" for="paymentStatus">Статус оплаты</label>
            <div class="uk-form-controls">
              <select id="paymentStatus" name="payment[status]" class="form-control select2">
                <option value="" selected>-Не указан-</option>
                <option value="not-paid">Не оплачен</option>
                <option value="paid">Оплачен</option>
              </select>                        
            </div>
          </div> --}}
          {{-- <div class="form-group">
            <label class="uk-form-label" for="paymentPaidAt">Дата оплаты</label>
            <div class="uk-form-controls">
              <div class="uk-form-icon">
                <div class="uk-icon-calendar"></div>
                  <input type="text" id="paymentPaidAt" name="payment[paid_at]" class="form-control" autocomplete="off">
                </div>
              </div>
          </div> --}}
          <div class="form-group">
            <label class="uk-form-label" for="paymentAmount">Сумма</label>                        
            <input type="number" name="payment[amount]" value="{{$payment->sum}}" id="paymentAmount" class="form-control" readonly>                            
            {{-- <p class="text-muted">Сумма прописью: <span class="text-primary"></span></p> --}}
          </div>
          {{-- <div class="form-group">
            <label class="uk-form-label" for="paymentComment">Комментарий</label>
            <textarea id="paymentComment" name="payment[comment]" cols="50" rows="4" class="form-control"></textarea>                        
          </div> --}}
        </div>
      </div>
      @endisset
  </div>
  <div class="col-md-4">
    {{-- <div class="card">
      <div class="card-header">
        <h5>Лид</h5>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label class="uk-form-label">IP</label>
          <input type="text" class="form-control" disabled="disabled">
        </div>
      </div>
    </div> --}}
    <div class="card">
      <div class="card-header">
        <h5>Примечание к заказу</h5>
      </div>
      <div class="card-body">
        <div class="form-group">
          <textarea name="notes" cols="50" rows="5" class="form-control">{{ $order->notes }}</textarea>
        </div>
      </div>
    </div>      
  </div>
</div>
  @push('scripts')
  <script>
    const changeOrderStatus = document.getElementById('changeOrderStatus')
    changeOrderStatus.onchange = function() {
      fetch('/admin/orders/change-status/' + {{$order->id}}, {
        method: 'PATCH',
        headers: {
          'Content-type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: 'status='+this.value
      }).then(res => res.json()).then(data => {
        $('.toast .toast-body').text(data.message)
        $('.toast').toast('show')
      }).catch(err => console.error(err.message))
    }
  </script>
  @endpush
</x-admin-layout>
  
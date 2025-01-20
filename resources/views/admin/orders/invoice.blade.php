<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{__('admin.Invoice')}} #{{$order->id}}</title>
  <style>
    html, body {
      margin: 10px;
      padding: 10px;
      font-family: "DejaVu Sans", sans-serif;
    }
    .page-break {page-break-after: always;}
    h1,h2,h3,h4,h5,h6,p,span,label {font-family: "DejaVu Sans", sans-serif;}
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 0px !important;
    }
    table thead th {
      height: 28px;
      text-align: left;
      font-size: 16px;
      font-family: "DejaVu Sans", sans-serif;
    }
    table, th, td {
      border: 1px solid #ddd;
      padding: 8px;
      font-size: 14px;
    }
    .heading {
      font-size: 24px;
      margin-top: 12px;
      margin-bottom: 12px;
      font-family: "DejaVu Sans", sans-serif;
    }
    .small-heading {
      font-size: 18px;
      font-family: "DejaVu Sans", sans-serif;
    }
    .total-heading {
      font-size: 18px;
      font-weight: 700;
      font-family: "DejaVu Sans", sans-serif;
    }
    .order-details tbody tr td:nth-child(1) {width: 20%;}
    .order-details tbody tr td:nth-child(3) {width: 20%;}
    .text-start {text-align: left;}
    .text-end {text-align: right;}
    .text-center {text-align: center;}
    .company-data span {
      margin-bottom: 4px;
      display: inline-block;
      font-family: "DejaVu Sans", sans-serif;
      font-size: 14px;
      font-weight: 400;
    }
    .no-border {border: 1px solid #fff !important;}
    .bg-blue {background-color: #002157;color: #fff;}
  </style>
</head>
<body>
  <table class="order-details">
    <thead>
      <tr>
        <th width="50%" colspan="2">
          <h2 class="text-start">{{$settings['sitename']}}</h2>
        </th>
        <th width="50%" colspan="2" class="text-end company-data">
          <span>{{__('admin.InvoiceId')}}: #{{$order->id}}</span><br>
          <span>{{__('admin.Date')}}: {{date('d / m / Y')}}</span><br>
          <span>{{__('admin.Address')}}: {{$settings['address']}}</span><br>
        </th>
      </tr>
      <tr class="bg-blue">
        <th width="50%" colspan="2">{{__('admin.OrderDetails')}}</th>
        <th width="50%" colspan="2">{{__('admin.CustomerDetails')}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{__('admin.OrderId')}}</td>
        <td>{{$order->id}}</td>
        <td>{{__('admin.FullName')}}</td>
        <td>{{$order->name}}</td>
      </tr>
      <tr>
        <td>{{__('admin.TrackingId/No.')}}</td>
        <td>{{$order->tracking_no}}</td>
        <td>Email</td>
        <td>{{$order->email}}</td>
      </tr>
      <tr>
        <td>{{__('admin.OrderedDate')}}</td>
        <td>{{$order->created_at->format('d.m.Y H:i')}}</td>
        <td>{{__('admin.Phone')}}</td>
        <td>{{$order->phone}}</td>
      </tr>
      <tr>
        <td>{{__('admin.PaymentMode')}}</td>
        <td>{{$order->payment_mode}}</td>
        <td>{{__('admin.Address')}}</td>
        <td>{{$order->address}}</td>
      </tr>
      <tr>
        <td>{{__('admin.OrderStatus')}}</td>
        <td>{{$order->status}}</td>
        <td>{{__('admin.PinCode')}}</td>
        <td>{{$order->zip}}</td>
      </tr>
    </tbody>
  </table>
  <table>
    <thead>
        <tr>
          <th class="no-border text-start heading" colspan="5">{{__('admin.OrderItems')}}</th>
        </tr>
        <tr class="bg-blue">
          <th>ID</th>
          <th>{{__('admin.Product')}}</th>
          <th>{{__('admin.Price')}}</th>
          <th>{{__('admin.Quantity')}}</th>
          <th>{{__('admin.Total')}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
      <tr>
        <td width="10%">{{$item->id}}</td>
        <td>
          {{$item->name}}
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
        <td width="10%">{{$item->price}}</td>
        <td width="10%">{{$item->quantity}}</td>
        <td width="15%" class="fw-bold">{{$item->quantity * $item->price}}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="4" class="total-heading">{{__('admin.TotalAmount')}}:</td>
        <td colspan="1" class="total-heading">{{$order->grand_total}}</td>
      </tr>
    </tbody>
  </table>
  <br>
  <p class="text-center">{{__('admin.ThankYouForShoppingWith', ['sitename' => $settings['sitename']])}}</p>
</body>
</html>

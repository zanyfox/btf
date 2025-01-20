<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order Email</title>
</head>
<body>
  <h1>Thanks for your order!</h1>
  <h2>Your order id is #{{$data['order']->id}}</h2>
  <h3>Shipping Address</h3>
  <address>dfhgbsfdhgsfd</address>
  <table>
    <thead>
      <tr>
        <th>Good</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data['order']->items as $item)
      <tr>
        <td>{{$item->title}}</td>
        <td>{{$item->price}}</td>
        <td>{{$item->qty}}</td>
        <td>{{$item->total}}</td>
      </tr>
      @endforeach
      <tr>
        <th colspan="3">@lang('Subtotal'):</th>
        <th>{{ $data['order']->subtotal }}</th>
      </tr>
      <tr>
        <th colspan="3">@lang('Discount'):</th>
        <th>{{ $data['order']->discount_amount }}</th>
      </tr>
      <tr>
        <th colspan="3">@lang('Shipping'):</th>
        <th>{{ $data['order']->shipping }}</th>
      </tr>
      <tr>
        <th colspan="3">Grand Total:</th>
        <th>{{ $data['order']->grand_total }}</th>
      </tr>
    </tbody>
  </table>
</body>
</html>
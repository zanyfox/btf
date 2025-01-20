@extends('layouts.account')

@section('title', $title)

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $title }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('account.orders')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Статус</span>
        <span class="info-box-number">{{$order->status}}</span>
      </div>
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Order Amount</span>
        <span class="info-box-number">{{$order->grand_total}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Tracking Id/No.</span>
        <span class="info-box-number"></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Payment Mode</span>
        <span class="info-box-number"></span>
      </div>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Order Created Date</span>
        <span class="info-box-number">{{ $order->created_at->format('d.m.Y H:i') }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Summary</h3>
      </div>
      <div class="card-body">
        <table class="table">
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td class="text-right">{{ $order->subtotal }}</td>
            </tr>
            <tr>
              <td>Discount {{ (!empty($order->discount_code)) ? '(' . $order->discount_code . ')' : '' }} </td>
              <td class="text-right">{{ $order->discount_amount }}</td>
            </tr>
            <tr>
              <td>Shipping</td>
              <td class="text-right">{{ $order->shipping }}</td>
            </tr>
            <tr>
              <td>Grand Total</td>
              <td class="text-right">{{ $order->grand_total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Content</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Sum</th>
            </tr>
          </thead>
          <tbody>
            @php
              $totalSum = 0;    
            @endphp
            @foreach ($order->items as $item)
            <tr>
              <td>
                <img src="/uploads/goods/small/{{ $item->good->pictures[0]->path }}" width="50" class="float-left mr-2" alt="">
                {{ $item->name }}
                {{-- @isset($item->goodColor)
                {{ $item->goodColor->color->name }}
                @endisset --}}
              </td>
              <td>{{$item->quantity}}</td>
              <td>{{$item->price}}</td>
              <td><span class="badge bg-danger">{{$item->price * $item->quantity}}</span></td>
            </tr>
            @php
              $totalSum += $item->price * $item->quantity;    
            @endphp
            @endforeach
            <tr>
              <td colspan="3">Total Amount:</td>
              <td>{{ $totalSum }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Customer Details</h3>
      </div>
      <div class="card-body">
        <h5>Full Name: {{ $order->name }}</h5>
        <h5>Email: {{ $order->email }}</h5>
        <h5>Phone: {{ $order->phone }}</h5>
        <h5>Address: {{ $order->address }}</h5>
      </div>
    </div>
  </div>
</div>
@endsection
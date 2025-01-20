@extends('layouts.account')

@section('title', __('Orders'))

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ __('Orders') }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">@lang('Dashboard')</a></li>
          <li class="breadcrumb-item active">@lang('Orders')</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 10px">Order ID</th>
            <th>Tracking No</th>
            <th>Customer Name</th>
            <th>Payment Mode</th>
            <th>Date Purchased</th>
            <th>Status</th>
            <th style="width: 80px">Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
          <tr>
            <td><a href="{{ route('account.orders', $order->id)}}">{{$order->id}}</a></td>
            <td></td>
            <td>{{$order->name}} {{$order->user->name}}</td>
            <td></td>
            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td>
              @foreach(\App\Enums\OrderStatus::values() as $key => $value)
                @if($key == $order->status )
                  {{ $value }}
                @endif
              @endforeach
              {{ config('enums.OrderStatus') }}
            </td>
            <td>{{-- {{ $order->getFullPrice() }} --}}  {{ number_format($order->grand_total, 0, '', ' ') }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="7">No Orders Available</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
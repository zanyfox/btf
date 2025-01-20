@section('title', __('admin.Coupons'))
<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Coupons')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      <div class="card">
        <div class="card-header">
          <h5>@lang('admin.Coupons')</h5>
          <a href="{{route('admin.coupons.create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateCoupon')" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.CreateCoupon')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('admin.CouponName')</th>
                  <th>@lang('admin.CouponCode')</th>
                  <th>@lang('admin.CouponValue')</th>
                  <th>@lang('admin.Period')</th>
                  <th>@lang('admin.CreatedAt')</th>
                  <th>@lang('admin.Counter')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach($coupons as $coupon)
                <tr>
                  <td>{{$coupon->id}}</td>
                  <td>{{$coupon->name}}</td>
                  <td>{{$coupon->code}}</td>
                  <td>{{$coupon->value}}@if($coupon->type == 'percent')%@endif</td>
                  <td>
                    {{ !empty($coupon->started_at) ? \Carbon\Carbon::parse($coupon->started_at)->format('d.m.Y') : '?'}} -
                    {{ !empty($coupon->expired_at) ? \Carbon\Carbon::parse($coupon->expired_at)->format('d.m.Y') : '?' }}
                  </td>
                  <td>{{\Carbon\Carbon::parse($coupon->created_at)->format('d.m.Y')}}</td>
                  <td class="text-center">{{$coupon->orders->count()}}</td>
                  <td class="text-right">
                    <a href="{{route('admin.coupons.edit', $coupon->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <button onclick="deleteCoupon({{$coupon->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
    function deleteCoupon(id) {
      event.preventDefault()
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/coupons/' + id, {
          method: 'DELETE',
          headers: {
            'Content-type': 'application/json; charset=UTF-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(res => res.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/coupons'
          }
        }).catch(err => console.error(err.message))
      } 
    }
  </script>
  @endpush
</x-admin-layout>
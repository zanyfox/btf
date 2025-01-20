<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.Discounts') }}</a></li>
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
          <h5>{{ __('admin.Discounts') }}</h5>
          <a href="{{url('admin/discounts/create')}}" data-toggle="tooltip" data-placement="left" title="{{__('admin.CreateNewDiscount')}}" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> {{__('admin.NewDiscount')}}
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('admin.CouponName')}}</th>
                  <th>{{__('admin.CouponCode')}}</th>
                  <th>{{__('admin.DiscountAmount')}}</th>
                  <th>{{__('admin.Period')}}</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach($discounts as $discount)
                <tr>
                  <td>{{$discount->id}}</td>
                  <td>{{$discount->name}}</td>
                  <td>{{$discount->code}}</td>
                  <td>
                    @if($discount->type == 'percent')
                    {{$discount->discount_amount}}%
                    @else
                    {{$discount->discount_amount}}
                    @endif
                  </td>
                  <td>
                    {{ !empty($discount->starts_at) ? \Carbon\Carbon::parse($discount->starts_at)->format('d.m.Y') : '?'}} -
                    {{ !empty($discount->expires_at) ? \Carbon\Carbon::parse($discount->expires_at)->format('d.m.Y') : '?' }}
                  </td>
                  <td>{{\Carbon\Carbon::parse($discount->created_at)->format('d.m.Y')}}</td>
                  <td class="text-right">
                    <a href="{{url('admin/discounts/' . $discount->id . '/edit')}}" data-toggle="tooltip" data-placement="top" title="{{__('admin.Edit')}}" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <button onclick="deleteDiscount({{$discount->id}})" data-toggle="tooltip" data-placement="top" title="{{__('admin.Delete')}}" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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
    function deleteDiscount(id) {
      event.preventDefault()
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/discounts/' + id, {
          method: 'DELETE',
          headers: {
            'Content-type': 'application/json; charset=UTF-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(res => res.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/discounts'
          }
        }).catch(err => console.log(err.message))
      } 
    }
  </script>
  @endpush
</x-admin-layout>
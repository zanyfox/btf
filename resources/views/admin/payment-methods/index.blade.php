<x-admin-layout>
  <x-slot name="title">@lang('admin.PaymentMethods')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.PaymentMethods')</a></li>
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
          <h5>@lang('admin.PaymentMethods')</h5>
          <a href="{{url('admin/payment-methods/create')}}" title="@lang('admin.CreateNewRecord')" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.NewRecord')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">@lang('admin.Name')</th>
                  <th scope="col">@lang('admin.Code')</th>
                  <th scope="col">@lang('admin.ExternalId')</th>
                  <th scope="col" class="text-center">@lang('admin.Sort')</th>
                  <th scope="col">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @if($paymentMethods->isNotEmpty())
                @foreach ($paymentMethods as $paymentMethod)
                <tr>
                  <td>{{$paymentMethod->id}}</td>
                  <td>{{$paymentMethod->name}}</td>
                  <td>{{$paymentMethod->code}}</td>
                  <td>{{$paymentMethod->external_id}}</td>
                  <td class="text-center">{{$paymentMethod->sort}}</td>
                  <td class="text-right">
                    <a href="{{url('admin/payment-methods/' . $paymentMethod->id . '/edit')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    @can('isAdmin')
                    <button type="button" onclick="deleteRecord({{$paymentMethod->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                    @endcan
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>  
            </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/payment-methods/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/payment-methods'
          }
        })
        .catch(err => console.error(err.message))
      }
    }
  </script>
</x-admin-layout>

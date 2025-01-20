<x-admin-layout>
  <x-slot:title>@lang('admin.Merchants')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Merchants')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <x-flash-message />
  @isset($token)
    <p class="alert alert-info">{{$token}}</p>
  @endisset
  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.Merchants')</h5>
      <a href="{{route('admin.merchants.create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateMerchant')" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> @lang('admin.CreateMerchant')
      </a>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('admin.Name')</th>
              <th>Email</th>
              <th>@lang('admin.CreatedAt')</th>
              <th>@lang('admin.UpdateToken')</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @if($merchants->isNotEmpty())
            @foreach ($merchants as $merchant)
            <tr>
              <td>{{$merchant->id}}</td>
              <td>{{$merchant->name}}</td>
              <td>{{$merchant->email}}</td>
              <td>{{$merchant->created_at->format('d.m.Y H:i')}}</td>
              <td>
                <a href="/admin/merchants/{{$merchant->id}}/update-token" data-toggle="tooltip" data-placement="top" title="@lang('admin.UpdateToken')" class="btn btn-sm btn-success"><i class="feather icon-refresh-ccw"></i></a>
              </td>
              <td class="text-right">

                @if($merchant->status)
                <a href="/admin/merchants/{{$merchant->id}}/changestatus" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-success"><i class="feather icon-eye"></i></a>
                @else
                <a href="/admin/merchants/{{$merchant->id}}/changestatus" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-success"><i class="feather icon-eye"></i></a>
                @endif

                <a href="/admin/merchants/{{$merchant->id}}/edit" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                <button type="button" onclick="deleteRecord({{$merchant->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>  
        </table>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/merchants/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/merchants'
          }
        })
        .catch(err => console.error(err.message))
      }
    }
  </script>
  @endpush
</x-admin-layout>

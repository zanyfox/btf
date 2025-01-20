<x-admin-layout>
  <x-slot:title>@lang('admin.Brands')</x-slot:title>
  <div class="page-header">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
      <li class="breadcrumb-item"><a href="#!">@lang('admin.Brands')</a></li>
    </ul>
  </div>
  <x-flash-message />
  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.Brands')</h5>
      <a href="{{route('admin.brands.create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateNewRecord')" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> @lang('admin.AddBrand')
      </a>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('admin.Picture')</th>
              <th>@lang('admin.BrandName')</th>
              <th>@lang('admin.Slug')</th>
              <th>@lang('admin.Qty')</th>
              <th>@lang('admin.CreatedAt')</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @if($brands->isNotEmpty())
            @foreach ($brands as $brand)
            <tr>
              <td>{{$brand->id}}</td>
              <td>
                @if(!empty($brand->picture))
                <img src="{{ url('uploads/brands', $brand->picture) }}" width="100" alt="">
                @else
                <img src="http://via.placeholder.com/100x100" alt="">
                @endif
              </td>
              <td>{{$brand->name}}</td>
              <td>{{$brand->slug}}</td>
              <td>{{ $brand->goods->count() }}</td>
              <td>{{$brand->created_at->format('d.m.Y H:i')}}</td>
              <td class="text-right">
                <button type="button" onclick="changeStatus({{$brand->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-default">
                  @if($brand->status)
                  <i class="feather icon-check-circle text-success"></i>
                  @else
                  <i class="feather icon-slash text-danger"></i>
                  @endif
                </button>
                <a href="/admin/brands/{{$brand->id}}/edit" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                <button type="button" onclick="deleteRecord({{$brand->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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

    function changeStatus(id) {
      fetch('/admin/brands/change-status/' + id).then(response => response.json()).then(data => {
        if(data.status == 'success') {
          window.location.href = '/admin/brands'
        }
      }).catch(err => console.error(err.message))
    }

    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/brands/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }).then(response => response.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/brands'
          }
        }).catch(err => console.error(err.message))
      }
    }
  </script>
  @endpush
</x-admin-layout>

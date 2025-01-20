<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Services')</a></li>
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
          <h5>@lang('admin.Services')</h5>
          <a href="{{url('admin/services/create')}}" title="@lang('admin.CreateNewPage')" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.NewRecord')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('admin.Name')</th>
                  <th>@lang('admin.Slug')</th>
                  <th>@lang('admin.Sort')</th>
                  <th>@lang('admin.Parent')</th>
                  <th>@lang('admin.Language')</th>
                  <th>@lang('admin.CreatedAt')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @if($services->isNotEmpty())
                @foreach ($services as $service)
                <tr>
                  <td>{{$service->id}}</td>
                  <td>{{$service->name}}</td>
                  <td>{{$service->slug}}</td>
                  <td>{{$service->order_by}}</td>
                  <td>{{ $service->parent_id }}</td>
                  <td>{{$service->lang}}</td>
                  <td>{{$service->created_at}}</td>
                  <td class="text-right">
                    <a href="{{ url('admin/services/' . $service->id . '/edit') }}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <button type="button" onclick="deleteRecord({{$service->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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
        fetch('/admin/services/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/pages'
          }
        })
        .catch(err => console.error(err.message))
      }
    }
  </script>
</x-admin-layout>

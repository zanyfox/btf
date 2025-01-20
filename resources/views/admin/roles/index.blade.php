<x-admin-layout>
  <x-slot name="title">@lang('admin.Roles')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Roles')</a></li>
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
          <h5>@lang('admin.Roles')</h5>
          <a href="{{url('admin/roles/create')}}" title="@lang('admin.CreateNewRole')" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.AddRole')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">@lang('admin.Name')</th>
                  <th scope="col">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @if($roles->isNotEmpty())
                @foreach ($roles as $role)
                <tr>
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td class="text-right">

                    <a href="{{url('admin/roles/' . $role->id . '/give-permissions')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Add/EditRolePermission')" class="btn btn-sm btn-warning">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                    </a>

                    <a href="{{url('admin/roles/' . $role->id . '/edit')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    @can('isAdmin')
                    <button type="button" onclick="deleteRecord({{$role->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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
  </div>
  <script>
    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/roles/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/roles'
          }
        })
        .catch(err => console.error(err.message))
      }
    }
  </script>
</x-admin-layout>

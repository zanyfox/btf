<x-admin-layout>
  <x-slot name="title">@lang('admin.Users')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">@lang('admin.Users')</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      
      <div class="card">
        <div class="card-body table-border-style">
          
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-uppercase active" data-toggle="tab" href="#usersTab" role="tab" aria-controls="usersTab" aria-selected="true">@lang('admin.Users')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" data-toggle="tab" href="#rolesTab" role="tab" aria-controls="rolesTab" aria-selected="false">@lang('admin.Roles')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" data-toggle="tab" href="#permissionsTab" role="tab" aria-controls="permissionsTab" aria-selected="false">@lang('admin.Permissions')</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade active show" id="usersTab" role="tabpanel" aria-labelledby="usersTab">

              <div class="card-header mb-3 px-0">

                <h5>@lang('admin.Users')</h5>
                @can('isAdmin')
                <a href="{{route('admin.users.create')}}" title="@lang('admin.CreateNewRecord')" class="btn btn-sm btn-primary float-right">
                  <i class="feather icon-plus"></i> @lang('admin.NewUser')
                </a>
                @endcan
              </div>

              <form class="form-inline float-left">
                <div class="form-group mb-2">
                  <label for="inputPerPage" class="mr-1">@lang('admin.Show')</label>
                  <select class="form-control form-control-sm mr-1" id="inputPerPage">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                  <label>записей</label>
                </div>
              </form>
              <form method="GET" class="form-inline float-right">
                <div class="form-group mb-2">
                  <label for="inputSearch" class="mr-2">@lang('admin.Search')</label>
                  <input type="search" name="search" value="{{ Request::get('search') }}" class="form-control form-control-sm" id="inputSearch" placeholder="Поиск по имени, email, телефону...">
                </div>
              </form>
              <div class="table-responsive">
                <table class="table table-sm2 table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox"></th>
                      <th>#</th>
                      <th>@lang('admin.Name')</th>
                      <th>Email</th>
                      <th>@lang('admin.Phone')</th>
                      <th>@lang('admin.Roles')</th>
                      <th>@lang('admin.CreatedAt')</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach ($user->roles as $role)
                          <span class="badge badge-primary">{{$role->name}}</span>
                          @endforeach
                        @endif
                      </td>
                      <td>{{\Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:s')}}</td>
                      <td class="text-right">
                        
                        @role('super-admin')
                        <a href="{{route('admin.users.edit',$user->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                        @endrole
                        
                        @can('isAdmin')
                          @if(Auth::user()->id != $user->id)
                          <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger" onclick="deleteUser({{$user->id}})"><i class="feather icon-trash"></i></a>
                          @endif
                        @endcan
    
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td rowspan="7">@lang('admin.NoRecordsAvailable')</td>
                    </tr>
                    @endforelse
                  </tbody>  
                </table>
              </div>
              {{-- {{ $users->appends(request()->input())->links('pagination.bootstrap') }} --}}
              {{ $users->appends(request()->input())->links() }}
            </div>
            <div class="tab-pane fade" id="rolesTab" role="tabpanel" aria-labelledby="rolesTab">

              <div class="card-header mb-3 px-0">
                <h5>@lang('admin.Roles')</h5>
                <a href="{{url('admin/roles/create')}}" title="@lang('admin.CreateNewRole')" class="btn btn-sm btn-primary float-right">
                  <i class="feather icon-plus"></i> @lang('admin.AddRole')
                </a>
              </div>

              <div class="table-responsive">
                <table class="table table-striped">
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
            <div class="tab-pane fade" id="permissionsTab" role="tabpanel" aria-labelledby="permissionsTab">
              <div class="card-header mb-3 px-0">
                <h5>@lang('admin.Permissions')</h5>
                <a href="{{url('admin/permissions/create')}}" title="@lang('admin.CreateNewPermission')" class="btn btn-sm btn-primary float-right">
                  <i class="feather icon-plus"></i> @lang('admin.AddPermission')
                </a>
              </div>
              <div class="table-responsive">
                <table id="dataTable2" class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">@lang('admin.Name')</th>
                      <th scope="col">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($permissions->isNotEmpty())
                    @foreach ($permissions as $permission)
                    <tr>
                      <td>{{$permission->id}}</td>
                      <td>{{$permission->name}}</td>
                      <td class="text-right">
                        <a href="{{url('admin/permissions/' . $permission->id . '/edit')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                        @can('isAdmin')
                        <button type="button" onclick="deleteRecord({{$permission->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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
    </div>
  </div>
  @push('scripts')
  <script>
    function deleteUser(id) {
      event.preventDefault()
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/users/' + id, {
          method: 'DELETE',
          headers: {
            'Content-type': 'application/json; charset=UTF-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
        }).then(res => res.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/users'
          }
        }).catch(err => console.error(err.message))
      } 
    }
  </script>
  @endpush
</x-admin-layout>
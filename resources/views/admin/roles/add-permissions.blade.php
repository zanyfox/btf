<x-admin-layout>
  <x-slot name="title">@lang('admin.GivePermissions')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">@lang('admin.Users')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.GivePermissions')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <x-flash-message />
      <form action="{{url('admin/roles/' . $role->id . '/give-permissions')}}" method="POST" id="roleForm" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.Role'): {{$role->name}}</h5>
          </div>
          <div class="card-body">

            @error('permissions')
            <div class="alert alert-danger">
              <ul class="list-unstyled mb-0">
                <li class="red-text">{{$message}}</li>
              </ul>
            </div>
            @enderror

            <div class="row">

              @foreach($permissions as $permission)
              <div class="col col-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input 
                      type="checkbox"
                      name="permissions[]"
                      class="form-check-input" 
                      value="{{$permission->name}}"
                      {{  in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                      >
                    {{$permission->name}}
                  </label>
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
        <button type="button" data-url="{{ url('admin/users') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
</x-admin-layout>

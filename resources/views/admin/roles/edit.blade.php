<x-admin-layout>
  <x-slot name="title">@lang('admin.EditRole')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users')}}">@lang('admin.Users')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditRole')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/roles/' . $role->id)}}" method="POST" id="roleForm" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditRole')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">@lang('admin.RoleName')</label>
                  <input type="text" name="name" value="{{$role->name}}" class="form-control" id="inputName">
                  <div class="d-block"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
        <button type="button" data-url="{{ url('admin/users') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
</x-admin-layout>

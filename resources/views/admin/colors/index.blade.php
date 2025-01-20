<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Colors')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5>{{ __('admin.Colors') }}</h5>
      <a href="{{route('admin.colors.create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateNewRecord')" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> @lang('admin.NewRecord')
      </a>
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">
        <table class="table table-striped" v-cloak>
          <thead>
            <tr>
              <th>#</th>
              <th v-on:click="sortByName()">@lang('admin.Name')</th>
              <th>@lang('admin.Code')</th>
              <th>@lang('admin.Status')</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach($colors as $color)
            <tr>
              <td>{{$color->id}}</td>
              <td>{{$color->name}}</td>
              <td>{{$color->code}}</td>
              <td>
                @if($color->status)
                <i class="feather icon-check-circle text-success"></i>
                @else
                <i class="feather icon-slash text-danger"></i>
                @endif
              </td>
              <td class="text-right">
                <a href="{{url('admin/colors/' . $color->id . '/edit')}}" data-toggle="tooltip" data-placement="top"  title="{{__('admin.Edit')}}" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                <a href="javascript:void(0)" type="button" onclick="deleteRecord({{$color->id}})" title="{{__('admin.Delete')}}" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>

    function changeStatus(id) {
      fetch('/admin/colors/change-status/' + id).then(response => response.json()).then(data => {
        if(data.status == 'success') {
          window.location.href = '/admin/categories'
        }
      }).catch(err => console.error(err.message))
    }

    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/colors/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }).then(response => response.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/colors'
          }
        }).catch(err => console.error(err.message))
      }
    }
  </script>
  @endpush
</x-admin-layout>

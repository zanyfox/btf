<x-admin-layout>
  <x-slot:title>@lang('admin.Galleries')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">@lang('admin.Galleries')</a></li>
        </ul>
      </div>
    </div>
  </div>
  <x-flash-message />
  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.Galleries')</h5>
      <a href="{{route('admin.galleries.create')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.CreateNewRecord')" class="btn btn-sm btn-primary float-right">
        <i class="feather icon-plus"></i> @lang('admin.NewRecord')
      </a>
    </div>
    <div class="card-body table-border-style">
      @if(count($galleries) > 0)
      <div class="table-responsive">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('admin.Name')</th>
              <th>@lang('admin.Slug')</th>
              <th>@lang('admin.Qty')</th>
              <th>@lang('admin.CreatedAt')</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($galleries as $gallery)
            <tr>
              <th scope="row">{{$gallery->id}}</th>
              <td><a href="{{route('admin.galleries.edit', $gallery->id)}}">{{$gallery->name}}</a></td>
              <td>{{ $gallery->slug }}</td>
              <td>{{ $gallery->pictures->count() }}</td>
              <td>@datetime($gallery->created_at)</td>
              <td class="text-right">
                <a href="{{route('admin.galleries.edit', $gallery->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                <form method="POST" action="{{route('admin.galleries.destroy', $gallery->id)}}" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure?');" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <p class="center-align red-text">@lang('admin.RecordsNotFound')</p>
      @endif
    </div>
  </div>
</x-admin-layout>

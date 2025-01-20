<x-admin-layout>
  <x-slot:title>@lang('admin.Categories')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Categories')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <x-flash-message />

  <div class="card">
    <div class="card-header">
      <h5>@lang('admin.Categories')</h5>
      @can('create', App\Models\Category::class)
        <a href="{{url('admin/categories/create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateNewCategory')" class="btn btn-sm btn-primary float-right">
          <i class="feather icon-plus"></i> @lang('admin.AddCategory')
        </a>
      @endcan
    </div>
    <div class="card-body table-border-style">
      @if($categories->isNotEmpty())
      <div class="table-responsive">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>@lang('admin.Image')</th>
              <th>@lang('admin.Name')</th>
              <th>@lang('admin.Parent')</th>
              <th>@lang('admin.OrderBy')</th>
              <th>@lang('admin.Language')</th>
              <th>@lang('admin.CreatedAt')</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr class="index-{{$loop->index}} iteration-{{$loop->iteration}}">
              <td>{{$category->id}}</td>
              <td>
                @if($category->picture)
                {{-- <img src="{{Storage::url($category->picture)}}" width="60"> --}}
                <img src="{{ asset('uploads/categories/thumbs/' .$category->picture) }}" width="60" alt="">
                @endif
              </td>
              <td>
                {{$category->__('name')}}<br>
                <small>{{$category->slug}}</small>
                @if($category->external_id)
                <br>
                <small>{{$category->external_id}}</small>
                @endif
              </td>
              <td>
                @if($category->parent_id)
                <ul class="list-unstyled">
                  @foreach($categories as $cat)
                  @if($category->parent_id == $cat->id)<li>{{$cat->name}}</li>@endif
                  @endforeach
                </ul>
                @else
                {{__('admin.NoParent')}}
                @endif
              </td>
              <td>{{$category->order_by}}</td>
              <td>{{$category->lang}}</td>
              <td>@if($category->created_at){{date('d.m.Y', strtotime($category->created_at))}}@endif</td>
              <td class="text-right">
                <a href="{{url('admin/categories/' . $category->id . '/change-status')}}" class="btn btn-sm btn-light" title="@lang('admin.ChangeStatus')">
                  <i class="feather @if($category->status) icon-check-circle text-success @else icon-slash text-danger @endif"></i>
                </a>
                <a href="{{url('admin/categories/' . $category->id . '/edit')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>

                @if(auth()->user()->hasRole(['super-admin','admin']))
                <button onclick="deleteCategory({{$category->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                @endif
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
  @if(auth()->user()->hasRole(['super-admin','admin']))
    @push('scripts')
    <script>
      function deleteCategory(id) {
        if(confirm('Вы уверены, что хотите удалить эту запись?')) {
          fetch('/admin/categories/' + id, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(response => response.json()).then(data => {
            if(data.status == 'success') {
              window.location.href = '/admin/categories'
            }
          }).catch(err => console.error(err.message))
        }
      }
    </script>
    @endpush
  @endif
</x-admin-layout>

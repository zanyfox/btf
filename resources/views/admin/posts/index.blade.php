<x-admin-layout>
  <x-slot name="title">@lang('admin.Posts')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Posts')</a></li>
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
          <h5>@lang('admin.Posts')</h5>
          <a href="{{url('admin/posts/create')}}" title="@lang('admin.CreateNewRecord')" data-toggle="tooltip" data-placement="left" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.NewRecord')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('admin.Picture')</th>
                  <th>@lang('admin.Name')</th>
                  <th>@lang('admin.Rubric')</th>
                  <th>@lang('admin.Author')</th>
                  <th>@lang('admin.CreatedAt')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                  <td>{{$post->id}}</td>
                  <td>
                    @if($post->preview)
                    <img src="{{ url('uploads/posts/preview', $post->preview)}}" width="70" alt="">
                    @endif
                  </td>
                  <td>{{$post->name}}</td>
                  <td>{{-- {{$post->rubric->name}} --}}</td>
                  <td>{{$post->author->name}}</td>
                  <td>{{$post->created_at->diffForHumans()}}</td>
                  <td class="text-right">
                    
                    <a href="{{url('admin/posts/changestatus/' . $post->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Change Status')" class="btn btn-sm btn-success"><i class="feather icon-check"></i></a>
                    <a href="{{url('admin/posts/' . $post->id . '/edit')}}"  data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    @can('isAdmin')
                    <form method="POST" action="{{url('admin/posts/delete/' . $post->id)}}" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" title="@lang('admin.Delete')" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                    </form>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>  
            </table>
          </div>
          {{$posts->links('pagination.bootstrap')}}
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>

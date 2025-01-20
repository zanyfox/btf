<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.Pages') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">

      {{-- @if(session('success'))
      <p>{{session('success')}}</p>
      @endif --}}
      <x-flash-message />

      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.Pages') }}</h5>
          <a href="{{url('admin/pages/create')}}" title="{{__('Create New Page')}}" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> Новая страница
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('admin.Title')}}</th>
                  <th>{{__('admin.Slug')}}</th>
                  <th>{{__('admin.Sort')}}</th>
                  <th>{{__('admin.Language')}}</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @if($pages->isNotEmpty())
                @foreach ($pages as $page)
                <tr>
                  <td>{{$page->id}}</td>
                  <td>{{$page->title}}</td>
                  <td>{{$page->slug}}</td>
                  <td>{{$page->sort}}</td>
                  <td>{{$page->lang}}</td>
                  <td>{{$page->created_at}}</td>
                  <td class="text-right">
                    <a href="/admin/pages/{{$page->id}}/edit" data-toggle="tooltip" data-placement="top" title="{{__('admin.Edit')}}" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <button type="button" onclick="deletePage({{$page->id}})" data-toggle="tooltip" data-placement="top" title="{{__('admin.Delete')}}" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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
    function deletePage(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/pages/' + id, {
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

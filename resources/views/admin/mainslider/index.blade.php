<x-admin-layout>
  <x-slot:title>@lang('admin.MainSlider')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="page-header-title"></div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">@lang('admin.MainSlider')</a></li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      <div class="card">
        <div class="card-header">
          <h5>@lang('admin.MainSlider')</h5>
          <a href="{{url('admin/mainslider/create')}}" title="@lang('admin.CreateNewRecord')" data-toggle="tooltip" data-placement="left" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.AddSlide')
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('admin.Image')</th>
                  <th>@lang('admin.Name')</th>
                  <th>@lang('admin.Tagline')</th>
                  <th>@lang('admin.OrderBy')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($slides as $slide)
                <tr>
                  <td>{{$slide->id}}</td>
                  <td><img src="{{ URL::asset('uploads/mainslider/' . $slide->picture)}}" width="160" alt=""></td>
                  <td>{{$slide->name}}</td>
                  <td>{{$slide->tagline}}</td>
                  <td>{{$slide->order_by}}</td>
                  <td class="text-right">
                    <a href="{{url('admin/mainslider/' . $slide->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
                    <a href="{{url('admin/mainslider/' . $slide->id . '/edit')}}"  data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <form method="POST" action="{{url('admin/mainslider/' . $slide->id)}}" class="d-inline-block" onsubmit="return confirm('Вы уверены, что хотите удалить слайд?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" title="@lang('admin.Delete')" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>  
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>

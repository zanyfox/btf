<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="page-header-title"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.Reviews') }}</h5>
          <a href="{{route('admin.reviews.create')}}" title="{{__('admin.CreateNewRecord')}}" data-toggle="tooltip" data-placement="left" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> {{__('admin.NewRecord')}}
          </a>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('admin.Picture')}}</th>
                  <th>{{__('admin.Name')}}</th>
                  <th>{{__('admin.Text')}}</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                  <th>{{__('admin.Status')}}</th>                  
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($reviews as $review)
                <tr>
                  <td>{{$review->id}}</td>
                  <td>
                    @if(File::exists(public_path('uploads/reviews/' . $review->picture)))
                    <img src="{{asset('uploads/reviews/' . $review->picture)}}" class="hei-75 wid-75 bg-light d-inline-block border border-secondary rounded-circle" width="70" alt="">
                    @endif                 
                  </td>
                  <td>{{$review->name}}</td>
                  <td>{{$review->content}}</td>
                  <td>{{$review->created_at->diffForHumans()}}</td>
                  <td>
                    @if($review->status)
                    <i class="feather icon-check-circle text-success"></i>
                    @else
                    <i class="feather icon-slash text-danger"></i>
                    @endif
                  </td>
                  <td class="text-right">
                    <a href="{{route('admin.reviews.edit', $review->id)}}"  data-toggle="tooltip" data-placement="top" title="{{__('admin.Edit')}}" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                    <form method="POST" action="{{route('admin.reviews.destroy', $review->id)}}" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" title="{{__('admin.Delete')}}" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
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

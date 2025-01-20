<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/reviews">{{__('admin.Reviews')}}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{__('admin.CreateReview')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{route('admin.reviews.store')}}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>{{__('admin.CreateReview')}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">{{__('admin.Name')}}</label>
                  <input type="text" name="name" class="form-control" value="{{old('name')}}" id="inputName" autofocus>
                  @error('name')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                  <label for="inputContent">{{__('admin.Text')}}</label>
                  <textarea id="inputContent" name="content" rows="5" class="form-control">{{old('content')}}</textarea>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked="checked" class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">{{__('admin.ActiveStatus')}}</label>
                  </div>
                </div>
                <div class="fileUpload">
                  <h6>{{__('admin.Picture')}}</h6>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{__('admin.Upload')}}</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="picture" class="custom-file-input" id="inputGroupFileImage">
                      <label class="custom-file-label" for="inputGroupFileImage">{{__('admin.ChooseFile')}}</label>
                    </div>
                  </div>
                  @error('image')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('admin.Create')}}</button>
        <button type="button" data-url="{{ url('admin/reviews') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
      </form>
    </div>
  </div>
</x-admin-layout>

<x-admin-layout>
  <x-slot:title>@lang('admin.CreateGallery')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/galleries')}}">@lang('admin.Galleries')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateGallery')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
      <li class="red-text">{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{route('admin.galleries.store')}}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.CreateGallery')</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col col-8">
            <div class="form-group">
              <label for="inputName">@lang('admin.Name')</label>
              <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="inputName" autofocus>
              @error('name')<span class="invalid-feedback d-block">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
              <label for="inputSlug">@lang('admin.Slug')</label>
              <input type="text" name="slug" value="{{old('slug')}}" class="form-control @error('slug') is-invalid @enderror" id="inputSlug">
              @error('slug')<span class="invalid-feedback d-block">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
              <label for="inputDescription">@lang('admin.Description')</label>
              <textarea id="inputDescription" name="description" class="form-control hasEditor" rows="10">{{old('description')}}</textarea>
            </div>
          </div>
          <div class="col col-4">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="status" @checked(old('status')) class="custom-control-input" id="customCheckStatus">
                <label class="custom-control-label" for="customCheckStatus">@lang('admin.ActiveStatus')</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputLang">@lang('admin.SelectLanguage')</label>
              <select name="lang" class="form-control" id="inputLang">
                <option value="" disabled selected>@lang('admin.ChooseLanguage')</option>
                @foreach (\App\Enums\Lang::cases() as $lang)
                <option value="{{$lang->value}}" @selected(old('lang'))>{{$lang->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col col-12">
            <input id="file" type="file" name="file" />
            <div class="fileUpload">
              <h6>@lang('admin.Images')</h6>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@lang('admin.Upload')</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="pictures[]" multiple="multiple" class="custom-file-input" id="inputGroupFileImages">
                  <label class="custom-file-label" for="inputGroupFileImages">@lang('admin.ChooseFiles')</label>
                </div>
              </div>
              @error('images')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
  </form>
</x-admin-layout>

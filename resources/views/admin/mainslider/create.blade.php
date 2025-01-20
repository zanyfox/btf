<x-admin-layout>
  <x-slot:title>@lang('admin.CreateNewRecord')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/mainslider')}}">@lang('admin.MainSlider')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateNewRecord')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/mainslider')}}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.NewRecord')</h5>
          </div>
          <div class="card-body">

            @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName" class="active">@lang('admin.Name')</label>
                  <input type="text" name="name" class="form-control" value="{{old('name')}}" id="inputName" autofocus>
                  @error('name')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>                
                <div class="form-group">
                  <label for="inputTagline">@lang('admin.Tagline')</label>
                  <input type="text" name="tagline" class="form-control" value="{{old('tagline')}}" id="inputTagline">
                </div>

                <div class="form-group">
                  <label for="inputDescription">@lang('admin.Description')</label>
                  <textarea name="description" rows="3" class="form-control hasEditor" id="inputDescription">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                  <label for="inputLink">@lang('admin.Link')</label>
                  <input type="url" name="link" class="form-control" value="{{old('link')}}" id="inputLink">
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked="checked" class="custom-control-input" id="checkboxStatus">
                    <label class="custom-control-label" for="checkboxStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputLang">@lang('admin.SelectLanguage')</label>
                  <select name="lang" class="form-control" id="inputLang">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                    @foreach (Lang::cases() as $lang)
                    <option value="{{$lang->value}}" @selected(old('lang'))>{{$lang->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputOrderBy">@lang('admin.OrderBy')</label>
                  <input type="number" name="order_by" class="form-control" value="{{old('order_by')}}" id="inputOrderBy">
                  @error('order_by')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                  <div class="input-file"></div>
                  <label for="inputPreview" class="form-label">@lang('admin.Preview')</label>
                  <input type="file" name="preview" class="form-control" id="inputPreview" accept="image/*" onchange="loadFile(event)">
                  @error('preview')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>

                {{-- <div class="fileUpload">
                  <h6>@lang('admin.Preview')</h6>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@lang('admin.Upload')</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="preview" accept="image/*" class="custom-file-input" id="inputGroupFilePreview">
                      <label class="custom-file-label" for="inputGroupFilePreview">@lang('admin.ChooseFile')</label>
                    </div>
                  </div>
                  @error('preview')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div> --}}

                {{-- <div class="fileUpload">
                  <h6>@lang('admin.Picture')</h6>
                  <div class="position-relative d-none2">
                    <a href="/admin/mainslider/1/deleteimage/preview" title="{{__('admin.Delete')}}" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
                    <img class="img-fluid d-block w-100 mb-3" id="outputPicture" src="" alt="">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@lang('admin.Upload')</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="picture" accept="image/*" onchange="loadPicture(event)" class="custom-file-input" id="inputGroupFilePicture">
                      <label class="custom-file-label" for="inputGroupFilePicture">@lang('admin.ChooseFile')</label>
                    </div>
                  </div>
                  @error('picture')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div> --}}

                <div class="form-group">
                  <div class="input-file"></div>
                  <label for="inputPicture">@lang('admin.Picture')</label>
                  <input type="file" name="picture" class="form-control" id="inputPicture" accept="image/*" onchange="loadFile(event)">
                  @error('picture')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
      </form>
    </div>
  </div>
  <script>
    const loadFile = function(event) {
      let imageContainer = event.target.previousElementSibling.previousElementSibling
      if(imageContainer.classList.contains('input-file')) {
        let html = `<div class="position-relative">
          <a href="javascript:void(0)" onclick="removeFile('${event.target.id}')" title="{{__('admin.Delete')}}" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
          <img class="img-fluid d-block w-100 mb-3" src="${URL.createObjectURL(event.target.files[0])}">
        </div>`
        imageContainer.innerHTML = html
      }
    }
    function removeFile(id) {
      URL.revokeObjectURL(document.getElementById(id).files[0]) // free memory
      document.getElementById(id).previousElementSibling.previousElementSibling.innerHTML = ''
      document.getElementById(id).value = ''
    }
  </script>
</x-admin-layout>

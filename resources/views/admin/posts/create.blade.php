<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="{{ url('admin/posts') }}">@lang('admin.Posts')</a></li>
          <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateNewRecord')</a></li>
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ url('admin/posts/store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.NewRecord')</h5>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">@lang('admin.Basic')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-uppercase" data-toggle="tab" href="#seoTab" role="tab" aria-controls="seoTab" aria-selected="false">SEO</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="basicTab" role="tabpanel" aria-labelledby="basicTab">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName" class="active">@lang('admin.Name')</label>
                  <input type="text" name="name" class="form-control" value="{{old('name')}}" id="inputName" autofocus>
                  @error('name')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                  <label for="inputSlug">@lang('admin.Slug')</label>
                  <input type="text" name="slug" class="form-control" value="{{old('slug')}}" id="inputSlug">
                </div>
                <div class="form-group">
                  <label for="inputTagline">@lang('admin.Tagline')</label>
                  <input type="text" name="tagline" class="form-control" value="{{old('tagline')}}" id="inputTagline">
                </div>
                <div class="form-group">
                  <label for="inputExcerpt">@lang('admin.Excerpt')</label>
                  <textarea id="inputExcerpt" name="excerpt" class="form-control" rows="4">{{old('excerpt')}}</textarea>
                </div>
                <div class="form-group">
                  <label for="inputBody">@lang('admin.Body')</label>
                  <textarea id="inputBody" name="body" rows="10" class="form-control hasEditor">{{old('body')}}</textarea>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" checked="checked" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputRubric">@lang('admin.SelectRubric')</label>
                  <select name="rubric_id" class="form-control" id="inputRubric">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                    @foreach($rubrics as $rubric)
                    <option value="{{ $rubric->id }}" @selected(old('rubric_id'))>{{ $rubric->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputAuthor">@lang('admin.SelectAuthor')</label>
                  <select name="author_id" class="form-control" id="inputAuthor">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                    @foreach($authors as $author)
                    <option value="{{$author->id}}" @selected(old($author->id))>{{$author->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputLang">@lang('admin.Language')</label>
                  <select name="lang" class="form-control" id="inputLang">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                    @foreach (Lang::cases() as $lang)
                    <option value="{{$lang->value}}" @selected(old('lang'))>{{$lang->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputTags">@lang('admin.Tags')</label>
                  <input type="text" name="tags" class="form-control" value="{{old('tags')}}" id="inputTags">
                </div>

                <div class="form-group">
                  <div class="input-file"></div>
                  <label for="inputPreview" class="form-label">@lang('admin.Preview')</label>
                  <input type="file" name="preview" class="form-control" id="inputPreview" accept="image/*" onchange="loadFile(event)">
                  @error('preview')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                  <div class="input-file"></div>
                  <label for="inputPicture">@lang('admin.Picture')</label>
                  <input type="file" name="picture" class="form-control" id="inputPicture" accept="image/*" onchange="loadFile(event)">
                  @error('picture')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
                
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputMetatitle">@lang('admin.MetaTitle')</label>
                  <input type="text" name="metatitle" class="form-control" value="{{old('metatitle')}}" id="inputMetatitle">
                  @if($errors->has('metatitle'))<div class="invalid-feedback d-block">{{$errors->first('metatitle')}}</div>@endif
                </div>
                <div class="form-group">
                  <label for="inputKeywords">@lang('admin.MetaKeywords')</label>
                  <input type="text" name="keywords" class="form-control" value="{{old('keywords')}}" id="inputKeywords">
                  @if($errors->has('keywords'))<div class="invalid-feedback d-block">{{$errors->first('keywords')}}</div>@endif
                </div>
                <div class="form-group">
                  <label for="inputDescription">@lang('admin.MetaDescription')</label>
                  <input type="text" name="description" class="form-control" value="{{old('description')}}" id="inputDescription">
                  @if($errors->has('description'))<div class="invalid-feedback d-block">{{$errors->first('description')}}</div>@endif
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputParent">@lang('admin.SelectVariant')</label>
                  <select name="parent_id" class="form-control" id="inputRobots">
                    <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
  </form>
  <script>
    const loadFile = function(event) {
      let imageContainer = event.target.previousElementSibling.previousElementSibling
      if(imageContainer.classList.contains('input-file')) {
        let html = `<div class="position-relative">
          <a href="javascript:void(0)" onclick="this.parentElement.remove()" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
          <img class="img-fluid d-block w-100 mb-3" src="${URL.createObjectURL(event.target.files[0])}">
        </div>`
        imageContainer.innerHTML = html
      }
    }
  </script>
</x-admin-layout>

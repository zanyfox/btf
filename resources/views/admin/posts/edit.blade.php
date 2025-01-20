<x-admin-layout>
  <x-slot name="title">@lang('admin.EditRecord')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/posts') }}">@lang('admin.Posts')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditRecord')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{ url('admin/posts/' . $post->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditRecord')</h5>
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
                      <input type="text" name="name" class="form-control" value="{{$post->name}}" id="inputName" autofocus>
                      @if ($errors->has('name'))
                      <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputSlug">@lang('admin.Slug')</label>
                      <input type="text" name="slug" class="form-control" value="{{$post->slug}}" id="inputSlug">
                    </div>
                    <div class="form-group">
                      <label for="inputTagline">@lang('admin.Tagline')</label>
                      <input type="text" name="tagline" class="form-control" value="{{$post->tagline}}" id="inputTagline">
                    </div>
                    <div class="form-group">
                      <label for="inputExcerpt">@lang('admin.Excerpt')</label>
                      <textarea id="inputExcerpt" name="excerpt" class="form-control" rows="4">{{$post->excerpt}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="inputBody">@lang('admin.Body')</label>
                      <textarea id="inputBody" name="body" rows="10" class="form-control hasEditor">{{$post->body}}</textarea>
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" @checked(old('status', $post->status)) class="custom-control-input" id="customCheckStatus">
                        <label class="custom-control-label" for="customCheckStatus">@lang('admin.ActiveStatus')</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputRubric">@lang('admin.SelectRubric')</label>
                      <select name="rubric_id" class="form-control" id="inputRubric">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @foreach($rubrics as $rubric)
                        <option value="{{$rubric->id}}"  @selected($post->rubric_id == $rubric->id)>{{$rubric->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputAuthor">@lang('admin.SelectAuthor')</label>
                      <select name="user_id" class="form-control" id="inputAuthor">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @foreach($authors as $author)
                        <option value="{{$author->id}}" {{$author->id === $post->author->id ? 'selected' : ''}}>{{$author->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputLang">@lang('admin.SelectLanguage')</label>
                      <select name="lang" class="form-control" id="inputLang">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @foreach (Lang::cases() as $lang)
                        <option value="{{$lang->value}}"  @selected($post->lang == $lang->value)>{{$lang->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputTags">@lang('admin.Tags')</label>
                      <input type="text" name="tags" class="form-control" value="{{old('tags')}}" id="inputTags">
                    </div>

                    <div class="form-group">
                      <div class="input-file">
                        @if($post->preview)
                        <div class="position-relative">
                          <a href="javascript:void(0)" onclick="this.parentElement.remove()" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
                          <img class="img-fluid d-block w-100 mb-3" src="{{url('uploads/posts/preview', $post->preview)}}">
                        </div>
                        @endif
                      </div>
                      <label for="inputPreview">@lang('admin.Preview')</label>
                      <input type="file" name="preview" class="form-control" id="inputPreview" accept="image/*" onchange="loadFile(event)">
                      @error('preview')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                    </div>
                      
                      <div class="form-group">
                        <div class="input-file">
                          @if($post->picture)
                          <div class="position-relative">
                            <a href="javascript:void(0)" onclick="this.parentElement.remove()" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
                            <img class="img-fluid d-block w-100 mb-3" src="{{url('uploads/posts', $post->picture)}}">
                          </div>
                          @endif
                        </div>
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
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
      </form>
    </div>
  </div>
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

<x-admin-layout>
  <x-slot:title>@lang('admin.EditGood')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10"></h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/goods')}}">@lang('admin.Goods')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditGood')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{route('admin.goods.update', $good->id)}}" id="goodForm" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditGood')</h5>
            <a href="{{route('admin.goods.index')}}" class="btn btn-sm btn-primary float-right">@lang('admin.Back')</a>
          </div>
          <div class="card-body">

            <div class="threebody-loader">
              <div><i class="threebody-spinner"></i></div>
            </div>

            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">@lang('admin.Basic')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" data-toggle="tab" href="#featuresTab" role="tab" aria-controls="featuresTab" aria-selected="false">@lang('admin.Features')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" data-toggle="tab" href="#modifiersTab" role="tab" aria-controls="modifiersTab" aria-selected="false">@lang('admin.Modifiers')</a>
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
                      <label for="inputName">@lang('admin.Name')</label>
                      <input type="text" name="name" value="{{$good->name}}" class="form-control" id="inputName" maxlength="255" autofocus>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputSlug">@lang('admin.Slug')</label>
                      <input type="text" name="slug" value="{{$good->slug}}" class="form-control" id="inputSlug" data-length="255">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputSubtitle">@lang('admin.Subtitle')</label>
                      <input type="text" name="subtitle" value="{{$good->subtitle}}" class="form-control" id="inputSubtitle" data-length="255">
                    </div>
                    <div class="form-group">
                      <label for="inputExcerpt">@lang('admin.Excerpt')</label>
                      <textarea id="inputExcerpt" name="excerpt" class="form-control" data-length="500" maxlength="500">{{$good->excerpt}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="inputDescription">@lang('admin.Description')</label>
                      <textarea name="description" id="inputDescription" class="form-control hasEditor">{{$good->description}}</textarea>
                    </div>
                    <div class="card-columns upload-previews mb-3">
                      @if($good->pictures->isNotEmpty())
                      @foreach($good->pictures as $picture)
                      <div class="position-relative mb-3 upload-preview{{$picture->id}}">
                        <img class="w-100 img-thumbnail" src="{{ asset('uploads/goods/small/' . $picture->path) }}" alt="">
                        <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {removePicture({{$picture->id}})}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
                      </div>
                      @endforeach
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="uploadFile">@lang('admin.Pictures')</label>
                      <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary">
                        <div class="dz-message needsclick">
                          <h5 class="text-primary mt-5">@lang('admin.DropFilesHereOrClickToUpload')</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group mt-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" @if($good->status)checked @endif class="custom-control-input" id="inputStatus">
                        <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="featured" @if($good->featured == 'Y')checked @endif class="custom-control-input" id="inputFeatured">
                        <label class="custom-control-label" for="inputFeatured">@lang('admin.Featured')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="novelty" @if($good->novelty)checked @endif class="custom-control-input" id="inputNovelty">
                        <label class="custom-control-label" for="inputNovelty">@lang('admin.Novelty')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="hit" @if($good->hit)checked @endif class="custom-control-input" id="inputHit">
                        <label class="custom-control-label" for="inputHit">@lang('admin.Hit')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputCategory">@lang('admin.Category')</label>
                      <select name="categories[]" class="form-control" id="inputCategory" multiple>
                        <option value="" disabled>@lang('admin.ChooseOption')</option>
                        @php
                        $categories = \App\Models\Category::where('parent_id', null)->get();
                        @endphp
                        @if($categories->isNotEmpty())
                        @foreach ($categories as $cat)
                        @include('admin.partials.good-category-select', ['category' => $cat, 'level' => 0, 'good' => $good])
                        {{-- <option value="{{$category->id}}" @selected($good->categories->contains($category->id))> --}}{{$cat->name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputBrand">@lang('admin.Brand')</label>
                      <select name="brand_id" class="form-control" id="inputBrand">
                        <option value="" selected disabled>@lang('admin.ChooseOption')</option>
                        @if($brands->isNotEmpty())
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" @selected($good->brand_id == $brand->id)>{{$brand->name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group">

                      <label for="inputRelatedGoods" class="d-block">@lang('admin.RelatedGoods')</label>
                      <select name="related_goods[]" class="w-100 form-control" id="inputRelatedGoods" multiple="multiple">
                        @if(!empty($otherGoods))
                        @foreach($otherGoods as $otherGood)
                        <option value="{{$otherGood['id']}}" @if(!$otherGood['status']) disabled @endif @if(in_array( $otherGood['id'], $relatedGoodsIds)) selected @endif >{{$otherGood['name']}}</option>
                        @endforeach
                        @endif
                      </select>

                    </div>
                    <div class="form-group">
                      <label for="inputPrice">@lang('admin.Price')</label>
                      <input type="number" name="price" value="{{$good->price}}" class="form-control" id="inputPrice">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputOldPrice">@lang('admin.OldPrice')</label>
                      <input type="number" name="oldprice" value="{{$good->oldprice}}" class="form-control" id="inputOldPrice">
                    </div>
                    <div class="form-group">
                      <label for="inputDiscount">@lang('admin.Discount')</label>
                      <input type="number" name="discount" value="{{$good->discount}}" class="form-control" id="inputDiscount">
                    </div>
                    <div class="form-group">
                      <label for="inputOrderBy">@lang('admin.OrderBy')</label>
                      <input type="number" name="order_by" value="{{$good->order_by}}" class="form-control" id="inputOrderBy">
                    </div>
                    <div class="form-group">
                      <label for="inputTags">@lang('admin.Tags')</label>
                      <input type="text" name="tags" value="{{$good->tags}}" class="form-control" id="inputTags" data-length="255" maxlength="255">
                    </div>
                    <div class="form-group">
                      <label for="inputSku">@lang('admin.SKU') (@lang('admin.StockKeepingUnit'))</label>
                      <input type="text" name="sku" value="{{$good->sku}}" class="form-control" id="inputSku">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputBarcode">@lang('admin.Barcode')</label>
                      <input type="text" name="barcode" value="{{$good->barcode}}" class="form-control" id="inputBarcode">
                    </div>
                    <div class="form-group">
                      <label for="InputExternalId">@lang('admin.ExternalId')</label>
                      <input type="text" name="external_id" value="{{$good->external_id}}" class="form-control" id="InputExternalId">
                    </div>
                    <div class="form-group">
                      <label for="inputCode">@lang('admin.Code')</label>
                      <input type="text" name="code" value="{{$good->code}}" class="form-control" id="inputCode">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="track_qty" @if($good->track_qty == 'Y')checked @endif class="custom-control-input" id="inputTrackQty">
                        <label class="custom-control-label" for="inputTrackQty">@lang('admin.TrackQuantity')</label>
                      </div>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputQty">@lang('admin.Quantity')</label>
                      <input type="number" name="quantity" value="{{$good->quantity}}" class="form-control" id="inputQty">
                      <div class="invalid-feedback d-block"></div>
                    </div>

                    <div class="form-group">
                      <label for="inputType">@lang('admin.Type')</label>
                      <select name="type_id" class="form-control" id="inputType">
                        <option value="" selected>@lang('admin.ChooseOption')</option>
                        @foreach ($types as $type)
                        <option value="{{$type->id}}" @selected($good->type_id == $type->id)>{{$type->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      @if($colors->isNotEmpty())
                        <div>
                          <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseColors" aria-expanded="false" aria-controls="collapseColors">
                            @lang('admin.SelectColor')
                          </button>
                        </div>

                        <div class="collapse" id="collapseColors">
                          <div class="card card-body p-0">
                            <table class="table table-sm">
                              <thead>
                                <tr>
                                  <th class="p-2">@lang('admin.Name')</th>
                                  <th class="p-2">@lang('admin.Qty')</th>
                                  <th class="p-2">@lang('admin.Price')</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($colors as $color)
                                <tr>
                                  @if($color->status != 0)
                                  <td class="p-2">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}" class="custom-control-input color-checkbox" id="inputColor{{$color->code}}">
                                      <label class="custom-control-label" for="inputColor{{$color->code}}">{{ $color->name }}</label>
                                    </div>
                                  </td>
                                  <td class="p-2">
                                    <input type="number" name="color_quantity[{{$color->id}}]" class="form-control form-control-sm" style="width: 60px;">
                                  </td>
                                  <td class="p-2">
                                    <input type="number" name="color_quantity[{{$color->id}}]" class="form-control form-control-sm" style="width: 70px;">
                                  </td>
                                  @endif
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      @endif
                    </div>

                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="featuresTab" role="tabpanel" aria-labelledby="featuresTab">
                <div class="row">
                  <div class="col col-4">
                    <div class="form-group">
                      @php
                        $goodFeaturesIds = [];
                        foreach($goodFeatures as $goodFeature) {
                          $goodFeaturesIds[] = $goodFeature->feature_id;
                        }
                      @endphp

                      <label for="inputFeature">@lang('admin.Feature')</label>
                      <select class="form-control" id="inputFeature">
                        <option>- @lang('admin.ChooseOption') -</option>
                        @foreach($features as $feature)
                        <option value="{{ $feature->id }}" @if(in_array($feature->id, $goodFeaturesIds)) disabled @endif>{{ $feature->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table" id="featuresTable">
                    <thead>
                      <tr>
                        <th>Имя атрибута</th>
                        <th>Значение</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($goodFeatures as $goodFeature)
                      <tr class="featureRow{{ $goodFeature->feature_id }}">
                        <td>{{ $goodFeature->name }}</td>
                        <td><input type="text" value="{{ $goodFeature->value }}" name="features[]" data-id="{{ $goodFeature->feature_id }}" class="form-control"></td>
                        <td class="text-right">
                          <button type="button" onclick="removeFeature({{ $goodFeature->feature_id }}, {{ $good->id }})" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="modifiersTab" role="tabpanel" aria-labelledby="modifiersTab">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <th>ID</th>
                      <th>@lang('admin.Name')</th>
                      <th>@lang('admin.GroupId')</th>
                      <th>@lang('admin.Price')</th>
                      <th>@lang('admin.DefaultAmount')</th>
                      <th>@lang('admin.MinAmount')</th>
                      <th>@lang('admin.MaxAmount')</th>
                      <th>@lang('admin.Required')</th>
                    </thead>
                    <tbody>
                      @foreach($goodModifiers as $goodModifier)
                      <tr>
                        <td>{{ $goodModifier->id }}</td>
                        <td>
                          {{ $goodModifier->name }}<br>
                          <small title="@lang('admin.ExternalId')">{{ $goodModifier->external_id }}</small>
                        </td>
                        <td>{{ $goodModifier->group_id }}</td>
                        <td>{{ $goodModifier->price }}</td>
                        <td>{{ $goodModifier->defaultAmount }}</td>
                        <td>{{ $goodModifier->minAmount }}</td>
                        <td>{{ $goodModifier->maxAmount }}</td>
                        <td>{{ $goodModifier->required }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
                <div class="row">
                  <div class="col col-8">
                    <div class="form-group">
                      <label for="inputMetaTitle">@lang('admin.MetaTitle')</label>
                      <input type="text" name="meta_title" value="{{$good->meta_title}}" class="form-control" id="inputMetaTitle">
                    </div>
                    <div class="form-group">
                      <label for="inputMetaKeywords">@lang('admin.MetaKeywords')</label>
                      <input type="text" name="meta_keywords" value="{{$good->meta_keywords}}" class="form-control" id="inputMetaKeywords">
                    </div>
                    <div class="form-group">
                      <label for="inputMetaDescription">@lang('admin.MetaDescription')</label>
                      <input type="text" name="meta_description" value="{{$good->meta_description}}" class="form-control" id="inputMetaDescription">
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <label for="inputMetaRobots">@lang('admin.MetaRobots')</label>
                      <select name="meta_robots" class="form-control" id="inputMetaRobots">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 10">
          <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
          <button type="button" data-url="{{ url('admin/goods') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
        </div>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>

    $('#inputRelatedGoods').multiselect({
      enableHTML: false,
      buttonWidth:'100%',
      maxHeight: 200,
      includeSelectAllOption: false,
      enableFiltering: true,
      enableCaseInsensitiveFiltering:false,
      enableFullValueFiltering:false,
      filterPlaceholder: 'Искать по названию или по id товара',
      filterBehavior: 'both',
      includeFilterClearBtn: false,
      preventInputChangeEvent: false,
      nonSelectedText: 'Ничего не выбрано',
      numberDisplayed: 3
    })

    function removePicture(pictureId) {
      fetch('/admin/goods/{{$good->id}}/remove-picture/' + pictureId).then(response => response.json()).then(data => {
        if(data.status == 'success') {
          document.querySelector('.upload-preview' + pictureId).remove()
        }
      }).catch(err => console.error(err.message))
    }

    // Dropzone
    Dropzone.autoDiscover = false
    const uploadFile = new Dropzone("#uploadFile", {
      url: '/admin/upload',
      maxFiles: 10,
      paramName: 'file',
      addRemoveLinks: true,
      acceptedFiles: 'image/jpg,image/jpeg,image/png,image/gif,image/webp',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function (file, response) {
        file.previewElement.classList.add('dz-success')

        let html = `<div class="position-relative mb-3">
            <input type="hidden" name="pictures[]" value="${response.tempFilename}">
            <img class="w-100 img-thumbnail" src="${file.dataURL}" alt="">
            <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {this.parentElement.remove()}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
          </div>`
        document.querySelector('.upload-previews').insertAdjacentHTML('beforeend', html)

      },
      complete: function (file) {
        this.removeFile(file)
      },
      error: function (file, response) {
        file.previewElement.classList.add('dz-error')
      }
    })

    const inputName = document.getElementById('inputName')
    const inputSlug = document.getElementById('inputSlug')
    const inputSubtitle = document.getElementById('inputSubtitle')
    const inputExcerpt = document.getElementById('inputExcerpt')
    const inputDescription = document.getElementById('inputDescription')
    const inputRelatedGoods = document.getElementById('inputRelatedGoods')
    const inputStatus = document.getElementById('inputStatus')
    const inputFeatured = document.getElementById('inputFeatured')
    const inputNovelty = document.getElementById('inputNovelty')
    const inputHit = document.getElementById('inputHit')
    const inputCategory = document.getElementById('inputCategory')
    const inputBrand = document.getElementById('inputBrand')
    const inputPrice = document.getElementById('inputPrice')
    const inputOldPrice = document.getElementById('inputOldPrice')
    const inputDiscount = document.getElementById('inputDiscount')
    const inputOrderBy = document.getElementById('inputOrderBy')
    const inputTags = document.getElementById('inputTags')
    const inputSku = document.getElementById('inputSku')
    const inputBarcode = document.getElementById('inputBarcode')
    const InputExternalId = document.getElementById('InputExternalId')
    const inputCode = document.getElementById('inputCode')
    const inputTrackQty = document.getElementById('inputTrackQty')
    const inputQty = document.getElementById('inputQty')
    const inputType = document.getElementById('inputType')
    const inputMetaTitle = document.getElementById('inputMetaTitle')
    const inputMetaKeywords = document.getElementById('inputMetaKeywords')
    const inputMetaDescription = document.getElementById('inputMetaDescription')
    const inputMetaRobots = document.getElementById('inputMetaRobots')

    /* inputName.onkeyup = function() {
      inputSlug.value = slugify(this.value, {lower: true})
    } */

    const goodForm = document.querySelector('#goodForm')
    const url = goodForm.getAttribute('action')
    const submitBtn = goodForm.querySelector('button[type="submit"]')

    goodForm.onsubmit = function(event) {
      event.preventDefault()
      submitBtn.setAttribute('disabled', true)

      let pictures = []
      let inputsPicture = document.querySelectorAll('[name="pictures[]"]')
      if(inputsPicture.length) {
        inputsPicture.forEach(input => {
          pictures.push(input.value)
        })
      }

      let features = []
      let inputsFeature = document.querySelectorAll('[name="features[]"]')
      if(inputsFeature.length > 0) {
        inputsFeature.forEach(input => {
          features.push({
            id: input.dataset.id,
            value: input.value
          })
        })
      }

      let values = {
        name: inputName.value,
        slug: inputSlug.value,
        subtitle: inputSubtitle.value,
        excerpt: inputExcerpt.value,
        description: inputDescription.value,
        related_goods: Array.from(inputRelatedGoods.options).filter(option => option.selected).map(option => Number(option.value)),
        status: inputStatus.checked,
        featured: inputFeatured.checked ? 'Y' : 'N',
        novelty: inputNovelty.checked,
        hit: inputHit.checked,
        categories: Array.from(inputCategory.options).filter(option => option.selected && !option.disabled).map(option => Number(option.value)),
        pictures: pictures,
        features: features,
        brand_id: inputBrand.value,
        price: inputPrice.value,
        oldprice: inputOldPrice.value,
        discount: inputDiscount.value,
        order_by: inputOrderBy.value,
        tags: inputTags.value,
        sku: inputSku.value,
        barcode: inputBarcode.value,
        external_id: InputExternalId.value,
        code: inputCode.value,
        track_qty: inputTrackQty.checked ? 'Y' : 'N',
        quantity: inputQty.value,
        type_id: inputType.value,
        meta_title: inputMetaTitle.value,
        meta_keywords: inputMetaKeywords.value,
        meta_description: inputMetaDescription.value,
        meta_robots: inputMetaRobots.value
      }

      console.log(values)

      fetch(url, {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(values)
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        console.log(data)
        if(data.status == 'success') {
          window.location.href = '/admin/goods'
          console.log(data)
        } else {

          let errors = data.errors
          console.log(errors)

          let inputsInvalid = document.querySelectorAll('input.is-invalid')
          if(inputsInvalid) {
            inputsInvalid.forEach(input => {
              input.classList.remove('is-invalid')
              let inputAttributeType = input.getAttribute('type')
              if(inputAttributeType == 'checkbox') {
                if(input.parentElement.nextElementSibling) {
                  input.parentElement.nextElementSibling.textContent = ''
                }
              } else {
                if(input.nextElementSibling) {
                  input.nextElementSibling.textContent = ''
                }
              }
            })
          }

          if(errors) {
            for(let key in errors) {
              let input = document.querySelector('input[name="' + key + '"]')
              input.classList.add('is-invalid')
              let inputAttributeType = input.getAttribute('type')
              if(inputAttributeType == 'checkbox') {
                if(input.parentElement.nextElementSibling) {
                  input.parentElement.nextElementSibling.textContent = errors[key]
                }
              } else {
                if(input.nextElementSibling) {
                  input.nextElementSibling.textContent = errors[key]
                }
              }
            }
          }
        }
      }).catch(error => console.error(error.message))
    }


    const inputFeature = document.getElementById('inputFeature')
    inputFeature.addEventListener('change', function() {

      this.options[this.selectedIndex].disabled = true

      let html = `<tr class="featureRow${this.value}">
        <td>${this.options[this.selectedIndex].text}</td>
        <td><input type="text" value="" name="features[]" data-id="${this.value}" class="form-control"></td>
        <td class="text-right">
          <button type="button" onclick="removeFeature(${this.value})" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
        </td>
      </tr>`
      document.querySelector('#featuresTable tbody').insertAdjacentHTML('beforeend', html)
    })

    function removeFeature(featureId, goodId = null) {
      if( confirm('Вы уверены, что хотите удалить у товара характеристику?') ) {
        for (let option of inputFeature.options) if(option.value == featureId) option.disabled = false
        document.querySelector('#featuresTable tbody').querySelector(`tr.featureRow${featureId}`).remove()

        if(goodId) {
          fetch('/admin/goods/' + goodId + '/remove-good-feature/' + featureId, {
            method: 'DELETE',
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(response => response.json()).then(data => {
            console.log(data)
          }).catch(error => console.error(error.message))
        }

      }
    }


  </script>
  @endpush
</x-admin-layout>

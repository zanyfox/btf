<x-admin-layout>
  <x-slot:title>@lang('admin.CreateGood')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/goods')}}">@lang('admin.Goods')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateGood')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{route('admin.goods.store')}}" method="POST" id="goodForm" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.CreateGood')</h5>
            <a href="{{route('admin.goods.index')}}" class="btn btn-sm btn-primary float-right">@lang('admin.Back')</a>
          </div>
          <div class="card-body">

            <div class="threebody-loader">
              <div><i class="threebody-spinner"></i></div>
            </div>

            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link text-uppercase active" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">@lang('admin.Basic')</a>
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
                      <input type="text" name="name" class="form-control" id="inputName" placeholder="@lang('admin.InsertName')" maxlength="255" autofocus>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputSlug">@lang('admin.Slug')</label>
                      <input type="text" name="slug" class="form-control" id="inputSlug" maxlength="255">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputSubtitle">@lang('admin.Subtitle')</label>
                      <input type="text" name="subtitle" class="form-control" id="inputSubtitle" maxlength="255">
                    </div>
                    <div class="form-group">
                      <label for="inputExcerpt">@lang('admin.Excerpt')</label>
                      <textarea id="inputExcerpt" name="excerpt" class="form-control" maxlength="500"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="inputDescription">@lang('admin.Description')</label>
                      <textarea name="description" id="inputDescription" class="form-control hasEditor"></textarea>
                    </div>
                    <div class="card-columns upload-previews mb-3"></div>
                    <div class="form-group">
                      <label>@lang('admin.Pictures')</label>
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
                        <input type="checkbox" name="status" checked class="custom-control-input" id="inputStatus">
                        <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="featured" class="custom-control-input" id="inputFeatured">
                        <label class="custom-control-label" for="inputFeatured">@lang('admin.Featured')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="novelty" class="custom-control-input" id="inputNovelty">
                        <label class="custom-control-label" for="inputNovelty">@lang('admin.Novelty')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="hit" class="custom-control-input" id="inputHit">
                        <label class="custom-control-label" for="inputHit">@lang('admin.Hit')</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputCategory">@lang('admin.Category')</label>
                      <select name="categories[]" class="form-control" id="inputCategory" multiple>
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @php
                        $categories = \App\Models\Category::where('parent_id', null)->get();
                        @endphp
                        @if($categories->isNotEmpty())
                        @foreach ($categories as $cat)
                        @include('admin.partials.good-category-select', ['category' => $cat, 'level' => 0])
                        @endforeach
                        @endif
                      </select>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputBrand">@lang('admin.Brand')</label>
                      <select name="brand_id" class="form-control" id="inputBrand">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @if($brands->isNotEmpty())
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputRelatedGoods" class="d-block">@lang('admin.RelatedGoods')</label>
                      <select name="related_goods[]" class="w-100 form-control" id="inputRelatedGoods" multiple="multiple">
                        @if(!empty($otherGoods))
                        @foreach($otherGoods as $otherGood)
                        <option value="{{$otherGood['id']}}" @if(!$otherGood['status']) disabled @endif>{{$otherGood['name']}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputPrice">@lang('admin.Price')</label>
                      <input type="number" name="price" class="form-control" id="inputPrice">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputOldPrice">@lang('admin.OldPrice')</label>
                      <input type="number" name="oldprice" class="form-control" id="inputOldPrice">
                    </div>
                    <div class="form-group">
                      <label for="inputDiscount">@lang('admin.Discount')</label>
                      <input type="number" name="discount" class="form-control" id="inputDiscount">
                    </div>
                    
                    <div class="form-group">
                      <label for="inputOrderBy">@lang('admin.OrderBy')</label>
                      <input type="number" name="order_by" class="form-control" id="inputOrderBy">
                    </div>
                    <div class="form-group">
                      <label for="inputTags">@lang('admin.Tags')</label>
                      <input type="text" name="tags" class="form-control" id="inputTags" maxlength="255">
                    </div>
                    <div class="form-group">
                      <label for="inputSku">@lang('admin.SKU') (@lang('admin.StockKeepingUnit'))</label>
                      <input type="text" name="sku" value="шт." class="form-control" id="inputSku">
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputBarcode">@lang('admin.Barcode')</label>
                      <input type="text" name="barcode" class="form-control" id="inputBarcode">
                    </div>
                    <div class="form-group">
                      <label for="InputExternalId">@lang('admin.ExternalId')</label>
                      <input type="text" name="external_id" class="form-control" id="InputExternalId">
                    </div>
                    <div class="form-group">
                      <label for="inputCode">@lang('admin.Code')</label>
                      <input type="text" name="code" class="form-control" id="inputCode">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="track_qty" class="custom-control-input" id="inputTrackQty">
                        <label class="custom-control-label" for="inputTrackQty">@lang('admin.TrackQuantity')</label>
                      </div>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputQuantity">@lang('admin.Quantity')</label>
                      <input type="number" name="quantity" class="form-control" id="inputQuantity">
                      <div class="invalid-feedback d-block"></div>
                    </div>

                    <div class="form-group">
                      <label for="inputType">@lang('admin.Type')</label>
                      <select name="type_id" class="form-control" id="inputType">
                        <option value="" selected>@lang('admin.ChooseOption')</option>
                        @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
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
                                  <input type="number" name="color_price[{{$color->id}}]" class="form-control form-control-sm" style="width: 70px;">
                                </td>
                                @endif
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                      @else
                      <div class="alert alert-danger" role="alert">
                        @lang('admin.NoColors')
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
                      <label for="inputFeature">@lang('admin.Feature')</label>
                      <select class="form-control" id="inputFeature">
                        <option disabled selected>- @lang('admin.ChooseOption') -</option>
                        @forEach($features as $feature)
                        <option value="{{$feature->id}}">{{$feature->name}}</option>
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
                    <tbody></tbody>
                  </table>
                </div>

              </div>
              <div class="tab-pane fade" id="modifiersTab" role="tabpanel" aria-labelledby="modifiersTab"></div>
              <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
                <div class="row">
                  <div class="col col-8">
                    <div class="form-group">
                      <label for="inputMetaTitle">@lang('admin.MetaTitle')</label>
                      <input type="text" name="meta_title" class="form-control" id="inputMetaTitle">
                    </div>
                    <div class="form-group">
                      <label for="inputMetaKeywords">@lang('admin.MetaKeywords')</label>
                      <input type="text" name="meta_keywords" class="form-control" id="inputMetaKeywords">
                    </div>
                    <div class="form-group">
                      <label for="inputMetaDescription">@lang('admin.MetaDescription')</label>
                      <input type="text" name="meta_description" class="form-control" id="inputMetaDescription">
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
          <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
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

    // Dropzone
    Dropzone.autoDiscover = false
    const uploadFile = new Dropzone("#uploadFile", {
      url: '/admin/upload',
      method: 'post',
      paramName: 'file',
      maxFilesize: 12,
      maxFiles: 10,
      parallelUploads: 2,
      resizeQuality: 1.0,
      addRemoveLinks: true,
      acceptedFiles: '.jpg,.jpeg,.png,.gif,.webp',
      dictDefaultMessage: 'Drag files here or click to upload',
      dictRemoveFile: 'Remove',
      autoProcessQueue: true,
      createImageThumbnails: true,
      thumbnailWidth: 120,
      thumbnailHeight: 120,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function (file, response) {
        file.previewElement.classList.add('dz-success')
        let html = `<div class="position-relative mb-3">
              <input type="hidden" name="pictures[]" value="${response.tempFilename}">
              <img class="img-thumbnail" src="${file.dataURL}" alt="">
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
    const inputQuantity = document.getElementById('inputQuantity')
    const inputType = document.getElementById('inputType')
    const inputMetaTitle = document.getElementById('inputMetaTitle')
    const inputMetaKeywords = document.getElementById('inputMetaKeywords')
    const inputMetaDescription = document.getElementById('inputMetaDescription')
    const inputMetaRobots = document.getElementById('inputMetaRobots')


    const goodForm = document.querySelector('#goodForm')
    const url = goodForm.getAttribute('action')
    const submitBtn = goodForm.querySelector('button[type="submit"]')

    goodForm.onsubmit = function(event) {
      event.preventDefault()

      submitBtn.setAttribute('disabled', true)
      document.querySelector('.threebody-loader').style.display = 'flex'

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

      console.log(features);

      let colors = []
      let inputsColors = document.querySelectorAll('.color-checkbox:checked')
      if(inputsColors.length > 0) {
        inputsColors.forEach(input => {
          colors.push(input.value)
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
        colors: colors,
        brand_id: inputBrand.value,
        price: inputPrice.value,
        oldprice: inputOldPrice.value,
        discount: inputDiscount.value,
        order_by: inputOrderBy.value,
        tags: inputTags.value,
        sku: inputSku.value,
        external_id: InputExternalId.value,
        code: inputCode.value,
        barcode: inputBarcode.value,
        track_qty: inputTrackQty.checked ? 'Y' : 'N',
        quantity: inputQuantity.value,
        type_id: inputType.value,
        meta_title: inputMetaTitle.value,
        meta_keywords: inputMetaKeywords.value,
        meta_description: inputMetaDescription.value,
        meta_robots: inputMetaRobots.value
      }

      console.log(values)

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(values)
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        document.querySelector('.threebody-loader').style.display = 'none'

        console.log(data)

        if(data.status == 'success') {
          window.location.href = url
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

    function removeFeature(id) {
      if( confirm('Вы уверены, что хотите удалить у товара характеристику?') ) {
        for (let option of inputFeature.options) if(option.value == id) option.disabled = false
        document.querySelector('#featuresTable tbody').querySelector(`tr.featureRow${id}`).remove()
      }
    }


  </script>
  @endpush
</x-admin-layout>

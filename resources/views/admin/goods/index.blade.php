<x-admin-layout>
  <x-slot:title>@lang('admin.Goods')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Goods')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">

      <x-flash-message />

      <div class="card card-table">
        <div class="card-header">
          <h5>Фильтрация товаров</h5>
          
          <div class="card-header-right">
            
            <div class="btn-group card-option">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="feather icon-more-horizontal"></i>
              </button>
              <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="GET">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputSearch">{{__('admin.SearchByTitle')}}</label>
                <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control" id="inputSearch">
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">{{__('admin.Category')}}</label>
                <select name="category" id="inputState" class="form-control">
                  <option value="" disabled selected>{{__('admin.ChooseOption')}}</option>
                  @php
                  $categories = \App\Models\Category::where('parent_id', null)->get();
                  @endphp
                  @if($categories->isNotEmpty())
                  @foreach ($categories as $cat)
                  @include('admin.partials.good-category-select', ['category' => $cat, 'level' => 0])
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputLang">{{__('admin.Brand')}}</label>
                <select name="brand_id[]" id="inputLang" class="form-control">
                  <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                  @if($brands->isNotEmpty())
                  @foreach ($brands as $brand)
                  <option value="{{$brand->id}}" @if(Request::get('brand_id')) {{ in_array($brand->id, Request::get('brand_id')) ? 'selected' : '' }} @endif>{{$brand->name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputLang">{{__('admin.Language')}}</label>
                <select id="inputLang" class="form-control">
                  <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                  @foreach (Lang::cases() as $lang)
                  <option value="{{$lang->value}}">{{$lang->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputPriceFrom">Цена от</label>
                <input type="number" name="price_from" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ Request::get('price_from') }}" class="form-control" id="inputPriceFrom">
              </div>
              <div class="form-group col-md-2">
                <label for="inputPriceTo">Цена до</label>
                <input type="number" name="price_to" min="{{$minPrice}}" max="{{$maxPrice}}" value="{{ Request::get('price_to') }}" class="form-control" id="inputPriceTo">
              </div>

              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="featured" @if(request()->has('featured')) checked @endif class="custom-control-input" id="inputFeatured">
                  <label class="custom-control-label" for="inputFeatured">@lang('admin.Featured')</label>
                </div>
              </div>

              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="novelty" @if(request()->has('novelty')) checked @endif class="custom-control-input" id="inputNovelty">
                  <label class="custom-control-label" for="inputNovelty">@lang('admin.Novelty')</label>
                </div>
              </div>

              <div class="form-group col-md-2 mt-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="hit" @if(request()->has('hit')) checked @endif class="custom-control-input" id="inputHit">
                  <label class="custom-control-label" for="inputHit">@lang('admin.Hit')</label>
                </div>
              </div>

            </div>
            <button type="submit" class="btn  btn-primary">Фильтровать</button>
            @if(Request::get('search'))
            <button type="button" data-url="{{ url('admin/goods') }}" onclick="if(!confirm('Вы уверены, что сбросить фильтры?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Reset')</button>
            @endif

            {{-- <select class="form-control form-control-sm float-right">
              <option value="latest">Latest</option>
              <option value="price_desc">Price High</option>
              <option value="price_asc">Price Low</option>
            </select> --}}

          </form>
        </div>
      </div>

      <div class="card">

        <div class="card-header">
          <h5>@lang('admin.Goods')</h5>
          <a href="{{url('admin/goods/import')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.ImportGoods')" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> @lang('admin.ImportGoods')
          </a>
          <a href="{{url('admin/goods/create')}}" data-toggle="tooltip" data-placement="left" title="@lang('admin.CreateNewGood')" class="btn btn-sm btn-primary mr-2 float-right">
            <i class="feather icon-plus"></i> @lang('admin.NewRecord')
          </a>
        </div>
        <div class="card-body table-border-style">
          @if($goods->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>&nbsp;</th>
                  <th>@lang('admin.Title')</th>
                  <th>@lang('admin.Category')</th>
                  <th class="text-nowrap">@lang('admin.Qty')</th>
                  <th>@lang('admin.Price')</th>
                  <th>@lang('admin.OrderBy')</th>
                  <th>@lang('admin.CreatedAt')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($goods as $good)
                <tr class="index-{{$loop->index}} iteration-{{$loop->iteration}}">
                  <td>{{$good->id}}</td>
                  <td>
                    @isset($good->pictures->first()->path)
                    <img src="{{asset('uploads/goods/small/' . $good->pictures->first()->path)}}" width="60">
                    @endisset
                  </td>
                  <td>
                    {{ $good->__('name') }}
                    <small class="d-block">{{$good->slug}}</small>
                    <small class="d-block">{{$good->external_id}}</small>
                  </td>
                  <td>
                    <ul class="list-unstyled">
                      @foreach($good->categories as $category)
                      <li>{{$category->name}}</li>
                      @endforeach
                    </ul>
                  </td>
                  <td class="text-center">{{(int)$good->quantity}}</td>
                  <td>{{$good->price}}</td>
                  <td>{{$good->order_by}}</td>
                  <td class="text-nowrap">
                    {{date('d.m.Y', strtotime($good['created_at']))}}
                  </td>
                  <td>
                    <div class="d-flex justify-content-end" style="gap: 3px">

                      @can('change status good')
                        @if($good->status)
                          <a href="{{url('admin/goods/' . $good->id . '/changestatus')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-success"><i class="feather icon-eye"></i></a>
                        @else
                          <a href="{{url('admin/goods/' . $good->id . '/changestatus')}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.ChangeStatus')" class="btn btn-sm btn-secondary"><i class="feather icon-eye-off"></i></a>
                        @endif
                      @endcan

                      @can('edit good')
                      <a href="{{route('admin.goods.edit', $good->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Edit')" class="btn btn-sm btn-info"><i class="feather icon-edit"></i></a>
                      @endcan

                      @can('delete good')
                        <button type="button" onclick="deleteGood({{$good->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                      @endcan
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="10">@lang('admin.NoRecordsAvailable')</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            </div>
            {{ $goods->appends(request()->input())->links() }}

            {{-- {{ $goods->withQueryString()->links() }} --}}

            {{-- <div class="btn-group">
              <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-target=".dropdown-menu">@lang('admin.Export')</button>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('admin/goods/export/xlsx') }}" class="dropdown-item">Export Goods (XLSX)</a>
                <a href="{{ url('admin/goods/export/csv') }}" class="dropdown-item">Export Goods (CSV)</a>
                <a href="{{ url('admin/goods/export/tsv') }}" class="dropdown-item">Export Goods (TSV)</a>
                <a href="{{ url('admin/goods/export/ods') }}" class="dropdown-item">Export Goods (ODS)</a>
                <a href="{{ url('admin/goods/export/xls') }}" class="dropdown-item">Export Goods (XLS)</a>
                <a href="{{ url('admin/goods/export/html') }}" class="dropdown-item">Export Goods (HTML)</a>
              </div>
            </div> --}}
          @else
          <p class="center-align red-text">@lang('admin.RecordsNotFound')</p>
          @endif
        </div>
      </div>
    </div>
  </div>
  @can('delete goods')
    @push('scripts')
    <script>
      function deleteGood(id) {
        if(confirm('Вы уверены, что хотите удалить эту запись?')) {
          fetch('/admin/goods/' + id, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            if(data.status == 'success') {
              window.location.href = '/admin/goods'
            }
          })
          .catch(err => console.error(err.message))
        }
      }
    </script>
    @endpush
  @endcan
</x-admin-layout>

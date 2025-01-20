<x-admin-layout>
  <x-slot name="title">{{ __('admin.Dashboard') }}</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10">@lang('admin.Dashboard')</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Dashboard')</a></li>
          </ul>
          <x-flash-message />
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xl-4">
      <div class="card flat-card">
        <div class="row-table">
          <div class="col-sm-6 card-body br">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-layout text-c-green mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                <h5>{{$totalGoods}}</h5>
                <span>{{__('admin.Goods')}}</span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 card-body">
          <div class="row">
            <div class="col-sm-4">
              <i class="icon feather icon-shopping-cart text-c-red mb-1 d-block"></i>
            </div>
            <div class="col-sm-8 text-md-center">
              <h5>{{$ordersCount}}</h5>
              <span>{{__('admin.Orders')}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row-table">
        <div class="col-sm-6 card-body br">
          <div class="row">
            <div class="col-sm-4">
              <i class="icon feather icon-users text-c-blue mb-1 d-block"></i>
            </div>
            <div class="col-sm-8 text-md-center">
              <h5>{{$customersCount}}</h5>
              <span>{{__('admin.Clients')}}</span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 card-body">
          <div class="row">
            <div class="col-sm-4">
              <i class="icon feather icon-layout text-c-yellow mb-1 d-block"></i>
            </div>
            <div class="col-sm-8 text-md-center">
              <h5>{{ $totalCategories }}</h5>
              <span>{{__('admin.Categories')}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="card flat-card widget-primary-card">
    <div class="row-table">
      <div class="col-sm-3 card-body">
        <i class="icon feather icon-trending-up"></i>
      </div>
      <div class="col-sm-9">
        <h4>{{ number_format($totalRevenue, 0, '.', ' ') }}</h4>
        <h6>{{__('admin.TotalRevenue')}}</h6>
      </div>
    </div>
  </div>
</div>
    <!-- table card-1 end -->
    <!-- table card-2 start -->
    <div class="col-md-12 col-xl-4">
      <div class="card flat-card">
        <div class="row-table">
          <div class="col-sm-6 card-body br">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>1000</h5>
                <span>Shares</span> --}}
              </div>
            </div>
          </div>
          <div class="col-sm-6 card-body">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-wifi text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>600</h5>
                <span>Network</span> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="row-table">
          <div class="col-sm-6 card-body br">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-rotate-ccw text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>3550</h5>
                <span>Returns</span> --}}
              </div>
            </div>
          </div>
          <div class="col-sm-6 card-body">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-blockz"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>100%</h5>
                <span>Order</span> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card flat-card widget-purple-card">
        <div class="row-table">
          <div class="col-sm-3 card-body">
            <i class="icon feather icon-trending-up"></i>
          </div>
          <div class="col-sm-9">
            <h4>{{number_format($revenueCurrentMonth, 0, '.', ' ')}}</h4>
            <h6>{{__('admin.revenueCurrentMonth')}}</h6>
          </div>
        </div>
      </div>
    </div>
    <!-- table card-2 end -->
    <!-- Widget primary-success card start -->
    <div class="col-md-12 col-xl-4">
      <div class="card flat-card">
        <div class="row-table">
          <div class="col-sm-6 card-body br">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>1000</h5>
                <span>Shares</span> --}}
              </div>
            </div>
          </div>
          <div class="col-sm-6 card-body">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-wifi text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>600</h5>
                <span>Network</span> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="row-table">
          <div class="col-sm-6 card-body br">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-rotate-ccw text-c-blue mb-1 d-block"></i>
              </div>
              <div class="col-sm-8 text-md-center">
                {{-- <h5>3550</h5>
                <span>Returns</span> --}}
              </div>
            </div>
          </div>
          <div class="col-sm-6 card-body">
            <div class="row">
              <div class="col-sm-4">
                <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-blockz"></i>
              </div>
              <div class="col-sm-8 text-md-center">
              {{-- <h5>100%</h5>
              <span>Order</span> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card flat-card widget-purple-card">
      <div class="row-table">
        <div class="col-sm-3 card-body">
          <i class="icon feather icon-trending-up"></i>
        </div>
        <div class="col-sm-9">
          <h4>{{number_format($revenueLastMonth, 0, '.', ' ')}}</h4>
          <h6>{{__('admin.revenueLastMonth')}}</h6>
        </div>
      </div>
    </div>
  </div>
    {{-- <div class="col-md-12 col-xl-4">
        <div class="card support-bar overflow-hidden">
            <div class="card-body pb-0">
                <h2 class="m-0">350</h2>
                <span class="text-c-blue">Support Requests</span>
                <p class="mb-3 mt-3">Total number of support requests that come in.</p>
            </div>
            <div id="support-chart"></div>
            <div class="card-footer bg-primary text-white">
                <div class="row text-center">
                    <div class="col">
                        <h4 class="m-0 text-white">10</h4>
                        <span>Open</span>
                    </div>
                    <div class="col">
                        <h4 class="m-0 text-white">5</h4>
                        <span>Running</span>
                    </div>
                    <div class="col">
                        <h4 class="m-0 text-white">3</h4>
                        <span>Solved</span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Widget primary-success card end -->

    <!-- prject ,team member start -->
    {{-- @if($stopListGoods->isNotEmpty())
    <div class="col-xl-6 col-sm-12 col-md-12">
      <div class="card table-card">
        <div class="card-header">
          <h5>Стоп лист</h5>
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
        <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Наименование</th>
                <th>Категория</th>
                <th class="text-right">Кол-во</th>
              </tr>
            </thead>
            <tbody>
                @foreach($stopListGoods as $stopListGood)
                <tr>
                  <td>
                    <div class="d-inline-block align-middle">
                      <div class="d-inline-block">
                        <h6>{{$stopListGood->name}}</h6>
                        <p class="text-muted m-b-0">{{$stopListGood->external_id}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    @isset($stopListGood->categories->first()->name)
                    {{$stopListGood->categories->first()->name}}
                    @endisset
                  </td>
                  <td class="text-right"><label class="badge badge-light-danger">{{$stopListGood->quantity}}</label></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif --}}
    {{-- <div class="col-xl-6 col-md-12">
      <div class="card latest-update-card">
        <div class="card-header">
          <h5>Обновления данных</h5>
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
          <div class="latest-update-box">
            @foreach($logs as $log)
            <div class="row p-t-30 p-b-30">
              <div class="col-auto text-right update-meta">
                <p class="text-muted m-b-0 d-inline-flex">{{ $log->created_at->diffForHumans() }}</p>
                @if($log->status == 'success')
                <i class="feather icon-check bg-success update-icon"></i>
                @else
                <i class="feather icon-info bg-danger update-icon"></i>
                @endif
              </div>
              <div class="col">
                <a href="#!">
                  <h6>{{ $log->name }}</h6>
                </a>
                <p class="text-muted m-b-0">{{ $log->description }}</p>
              </div>
            </div>
            @endforeach
          </div>
          <div class="text-center">
            <a href="{{url('admin/logs')}}" class="b-b-primary text-primary">Смотреть все логи</a>
            <a href="{{url('admin/seed-goods')}}" class="btn btn-sm btn-primary" id="btnImportGoods">Импорт товаров</a>
          </div>
          <div class="progress my-4">
            <div id="importGoodsProgress" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%; display: none;"></div>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- prject ,team member start -->
    <!-- seo start -->
    {{-- <div class="col-xl-4 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-6">
              <h3>$16,756</h3>
              <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
            </div>
            <div class="col-6">
              <div id="seo-chart1" class="d-flex align-items-end"></div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- <div class="col-xl-4 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-6">
              <h3>49.54%</h3>
              <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
            </div>
            <div class="col-6">
              <div id="seo-chart2" class="d-flex align-items-end"></div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- <div class="col-xl-4 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-6">
              <h3>1,62,564</h3>
              <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
            </div>
            <div class="col-6">
              <div id="seo-chart3" class="d-flex align-items-end"></div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- seo end -->

  <!-- Latest Customers start -->
  {{-- <div class="col-lg-8 col-md-12">
    <div class="card table-card review-card">
      <div class="card-header borderless ">
        <h5>{{__('admin.CustomerReviews')}}</h5>
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
      <div class="card-body pb-0">
        <div class="review-block">
          @foreach($reviews as $review)
          <div class="row">
            <div class="col-sm-auto p-r-0">
              @if(File::exists(public_path('uploads/reviews/' . $review->picture)))
              <img src="{{asset('uploads/reviews/' . $review->picture)}}" alt="{{$review->name}}" class="img-radius profile-img cust-img m-b-15">
              @endif
            </div>
            <div class="col">
              <h6 class="m-b-15">{{$review->name}} <span class="float-right f-13 text-muted"> {{$review->created_at->diffForHumans()}}</span></h6>
              <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
              <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
              <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
              <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
              <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
              <p class="m-t-15 m-b-15 text-muted">{{$review->content}}</p>
              <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
              <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
              <a href="{{route('admin.reviews.edit', $review->id)}}"><i class="feather icon-edit text-muted"></i></a>
              <blockquote class="blockquote m-t-15 m-b-0">
                <h6>Allina D’croze</h6>
                <p class="m-b-0 text-muted">Lorem Ipsum is simply dummy text of the industry.</p>
              </blockquote>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div> --}}
  {{-- <div class="col-lg-4 col-md-12">
    <div class="card">
      <div class="card-body">
        <h5 class="mb-3">Total Leads</h5>
        <p class="text-c-green f-w-500"><i class="fa fa-caret-up m-r-15"></i> 18% High than last month</p>
        <div class="row">
          <div class="col-4 b-r-default">
            <p class="text-muted m-b-5">Overall</p>
            <h5>76.12%</h5>
          </div>
          <div class="col-4 b-r-default">
            <p class="text-muted m-b-5">Monthly</p>
            <h5>16.40%</h5>
          </div>
          <div class="col-4">
            <p class="text-muted m-b-5">Day</p>
            <h5>4.56%</h5>
          </div>
        </div>
      </div>
      <div id="tot-lead" style="height:150px"></div>
    </div>
  </div> --}}
  <script>
    const btnImportGoods = document.querySelector('#btnImportGoods')
    const importGoodsProgress = document.querySelector('#importGoodsProgress')
    if( btnImportGoods ) {
      btnImportGoods.onclick = (event) => {
        event.preventDefault()
        btnImportGoods.classList.add('disabled')
        btnImportGoods.setAttribute('disabled', true)
        importGoodsProgress.style.display = 'block'
        fetch('/api/iiko/get-nomenclature').then(response => response.json()).then(data => {
          btnImportGoods.classList.remove('disabled')
          btnImportGoods.removeAttribute('disabled')
          importGoodsProgress.style.display = 'none'
          if(data.status == 'success') {
            $('.toast .toast-body').text(data.message)
            $('.toast').toast('show')
          }
        }).catch(error => console.error(error.message))
      } 
    }
  </script>
</x-admin-layout>

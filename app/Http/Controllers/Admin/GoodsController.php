<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Good;
use App\Models\GoodColors;
use App\Models\Category;
use App\Imports\GoodsImport;
use App\Exports\GoodsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use Intervention\Image\Laravel\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

use Session;
use Storage;

class GoodsController extends Controller {

  public $imageSizes = [
    'small' => [162, 348],
    'large' => [162, 348],
  ];

  //public $categories;
  public $brands;
  public $colors;
  public $types;
  public $features;

  public function __construct() {
    $this->brands = DB::table('brands')->select('id','name')->distinct()->orderBy('id','desc')->get();
    $this->colors = DB::table('colors')->select('id','name','code','status')->distinct()->orderBy('id','desc')->get();
    $this->types = DB::table('types')->select('id','name','code','status')->distinct()->orderBy('id','desc')->get();
    $this->features = DB::table('features')->select('id','name')->distinct()->orderBy('id','asc')->get();
  }

  public function index(Request $request) {


    //dd(Good::min('price'));
    //dd(get_class_methods($request));

    $minPrice = Good::min('price');
    $maxPrice = Good::max('price');

    //$query = Good::latest('goods.id')->with('category');

    // Apply Filters here


    $query = Good::query();

    // Sorting Filter by Latest Ids
    

    if( !empty($request->get('sort')) ) {
      
      $sort = $request->get('sort');
      if($sort == 'latest') {
        $query = $query->orderBy('goods.id', 'DESC');
      } else if($sort == 'price_asc') {
        $query = $query->orderBy('goods.price', 'ASC');
      } else {
        $query = $query->orderBy('goods.id', 'ASC');
      }
      
    } else {
      $query = $query->latest('goods.id');
    }

    //$query = $query->with('category');
    /* if( $request->filled('price_from') ) {
      $goodsQuery->where('price', '>=', $request->price_from);
    }
    if( $request->filled('price_to') ) {
      $goodsQuery->where('price', '<=', $request->price_to);
    }

    if( $request->has('featured') ) {
      $goodsQuery->where('featured', 'Y');
    }
    if( $request->has('novelty') ) {
      $goodsQuery->where('novelty', 1);
    }
    if( $request->has('hit') ) {
      $goodsQuery->where('hit', 1);
    } */

    // Apply Filter by Category ID
    if( !empty($request->query('category')) ) {
      $categoryID = intval($request->query('category'));
      $query = Good::leftJoin('category_good', function($join) use($categoryID) {
        $join->on('goods.id', '=', 'category_good.good_id')
        ->where('category_good.category_id','=', $categoryID);
      })->whereNotNull('category_good.category_id');
    }
    
    // Brand Filter
    if( !empty($request->get('brand_id')) && is_array($request->get('brand_id')) ) {
      $brandIds = $request->get('brand_id');
      $query = $query->whereIn('brand_id', $brandIds);
    }

    // Price Range Filter
    if( $request->get('price_from') != '' && $request->get('price_to') != '' ) {
      $requestedMinPrice = (int)$request->get('price_from') ?? $minPrice;
      $requestedMaxPrice = (int)$request->get('price_to') ?? $maxPrice;
      $query = $query->whereBetween('price', [$requestedMinPrice, $requestedMaxPrice]);
    }

    // Search Filter by Name Value 
    if(!empty($request->get('search'))) {
      $query = Good::where('name', 'like', '%'. $request->search .'%')
        ->orWhere('external_id',$request->search);
    }

    $goods = $query->paginate(24);
    //$goods = $goodsQuery->paginate(24)->withPath('?' . $request->getQueryString());

    return view('admin.goods.index', compact('goods'))
      ->with('brands', $this->brands)
      ->with('minPrice', $minPrice)
      ->with('maxPrice', $maxPrice);
  }

  public function create() {

    $otherGoods = Good::all();

    return view('admin.goods.create', [
      'brands' => $this->brands,
      'colors' => $this->colors,
      'types' => $this->types,
      'features' => $this->features,
      'otherGoods' => $otherGoods
    ]);
  }

  public function store(Request $request) {

    $rules = [
      'name' => 'required|string|min:3|max:255',
      'slug' => 'nullable|string|unique:goods,slug',//|unique:goods',
      'price' => 'nullable|numeric',
      //'categories' => 'required',
      'track_qty' => 'nullable|in:Y,N'
    ];

    if( !empty($request->track_qty) && $request->track_qty == 'Y' ) {
      $rules['quantity'] = 'required|numeric,min:0';
    }

    $validator = Validator::make($request->all(), $rules);

    if( $validator->fails() ) {
      session()->flash('fail', 'Validation went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $good = new Good();
    $good->name = $request->name;

    if(empty($request->slug)) {
      $good->slug = Str::slug($request->name);
    } else {
      $good->slug = $request->slug;
    }

    $good->subtitle = $request->subtitle;
    $good->excerpt = $request->excerpt;
    $good->description = $request->description;
    $good->related_goods = !empty($request->related_goods) ? implode(',', $request->related_goods) : '';
    $good->price = $request->price;
    $good->oldprice = $request->oldprice;
    $good->discount = $request->discount;
    $good->order_by = $request->order_by;
    $good->lang = $request->lang;
    $good->tags = $request->tags;
    $good->brand_id = $request->brand_id;
    $good->sku = $request->sku;
    $good->barcode = $request->barcode;
    $good->external_id = $request->external_id;
    $good->code = $request->code;
    $good->track_qty = $request->track_qty;
    $good->quantity = $request->quantity;
    $good->type_id = $request->type_id;
    $good->status = $request->status;
    $good->featured = $request->featured;
    $good->novelty = $request->novelty;
    $good->hit = $request->hit;
    $good->meta_title = $request->meta_title;
    $good->meta_keywords = $request->meta_keywords;
    $good->meta_description = $request->meta_description;
    $good->meta_robots = $request->meta_robots;

    $good->save();

    if($request->has('categories')) {
      $good->categories()->attach( $request->categories );
    }

    if($request->has('pictures')) {


      $uploadPath = public_path('uploads/goods/');
      $insertPictures = [];

      foreach($request->pictures as $tempPicture) {

        
        $fileName = Str::random(16) . '.webp';

        $insertPicture = Picture::create([
          'path' => $fileName
        ]);

        $insertPictures[] = $insertPicture->id;

        $tempFile = public_path('temp/' . $tempPicture);

        $largePicture = Image::read($tempFile);
        $largePicture->toWebp(100);
        /* $largePicture->resize($this->imageSizes['large'][0], null, function($constraint) {
          $constraint->aspectRatio();
        }); */
        $largePicture->save(public_path('uploads/goods/large/' . $fileName));

        $smallPicture = Image::read($tempFile);
        $smallPicture->toWebp(100);
        //$smallPicture->resize($this->imageSizes['small'][0], $this->imageSizes['small'][1]);
        $smallPicture->save(public_path('uploads/goods/small/' . $fileName)); 

      }
      if($insertPictures) {
        $good->pictures()->attach($insertPictures);
      }
    }

    if($request->has('features')) {
      foreach($request->features as $feature) {
        if(empty($feature['value']) || empty($feature['id'])) continue;
        DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$feature['value'], $feature['id'], $good->id]);
      }
    }

    // Add colors to good
    if($request->colors) {
      foreach($request->colors as $key => $color) {
        $good->colors()->create([
          'good_id' => $good->id,
          'color_id' => $color,
          'quantity' => $request->color_quantity[$key] ?? 0,
          'price' => $request->color_price[$key] ?? 0
        ]);
      }
    }

    /* return response()->json([
      'status' => 'test',
      'message' => $request->colors
    ]); */

    Session::flash('success', __('admin.RecordHasBeenCreated'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordHasBeenCreated')
    ]);

  }

  public function import(Request $request) {

    // Import data from exel
    if( $request->isMethod('post') ) {

      $request->validate([
        'import_file' => 'required|file|mimes:xls,xlsx'
      ]);

      //print_r($request->isMethod('post'));die;

      Excel::import(new GoodsImport, $request->file('import_file'));

      

      /* $path = $request->file('file')->getRealPath();
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      $spreadsheet = $reader->load($path);
      $sheet = $spreadsheet->getActiveSheet();
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();
      $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
      $data = [];
      for ($row = 2; $row <= $highestRow; ++$row) {
        for ($col = 0; $col < $highestColumnIndex; ++$col) {
          $data[$row][$col] = $sheet->getCellByColumnAndRow($col, $row)->getValue();
        }
      }
      //dd($data);
      
      return redirect()->back()->with('success', __('admin.ImportedSuccessfully'));
    }
    /* Good::firstOrCreate(
      ['name' => $request->name],
      [
        'code' => $request->code,
        'status' => $request->status == true ? 1 : 0
      ]
    ); */
    /* Good::updateOrCreate(
      ['name' => $request->name],
      [
        'code' => $request->code,
        'status' => $request->status == true ? 1 : 0
      ]
    ); */
    }
    return view('admin.goods.import');
  }

  public function export(Request $request) {

    switch($request->format) {
      case 'xlsx':
        $ext = 'xlsx';
        $format = \Maatwebsite\Excel\Excel::XLSX;
        break;
      case 'csv':
        $ext = 'csv';
        $format = \Maatwebsite\Excel\Excel::CSV;
        break;
      case 'tsv':
        $ext = 'tsv';
        $format = \Maatwebsite\Excel\Excel::TSV;
        break;
      case 'ods':
        $ext = 'ods';
        $format = \Maatwebsite\Excel\Excel::ODS;
        break;
      case 'xls':
        $ext = 'xls';
        $format = \Maatwebsite\Excel\Excel::XLS;
        break;
      case 'html':
        $ext = 'html';
        $format = \Maatwebsite\Excel\Excel::HTML;
        break;
      default:
        $ext = 'xlsx';
        $format = \Maatwebsite\Excel\Excel::XLSX;
    }

    $filename = 'goods_' . date('Y-m-d') . '.' . $ext;
    return Excel::download(new GoodsExport, $filename, $format);

  }

  public function edit(int $id) {

    $good = Good::with('features')->with('modifiers')->find($id);



    //print_r($good->brand->name); die;
    $goodColors = $good->colors->pluck('color_id')->toArray();
    //$colors = Color::whereNotIn('id', $goodColors)->get()->toArray();
    //print_r($goodColors); die;

    if(!$good) {
      Session::flash('fail', __('admin.RecordNotFound'));
      return redirect('admin/goods');
    }

    $goodModifiers = DB::select('SELECT * FROM modifiers AS m JOIN goods AS g ON m.id = g.external_id WHERE m.good_id=' . $good->id);
    //print_r($good->modifiers->toArray()); die;

    $goodFeatures = DB::select('SELECT * FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=?', [$good->id]);

    //print_r($good->features); die;
    //print_r($goodFeatures); die;

    $otherGoods = Good::with('features')->where('id', '!=', $id)->get();
    $relatedGoods = [];
    $relatedGoodsIds = [];
    if($good->related_goods) {
      $relatedGoodsIds = explode(',', $good->related_goods);
      $relatedGoods = Good::select('id','name')->whereIn('id', $relatedGoodsIds)->get()->toArray();
    }

    return view('admin.goods.edit', [
      'good' => $good,
      'brands' => $this->brands,
      'colors' => $this->colors,
      'types' => $this->types,
      'goodModifiers' => $goodModifiers,
      'features' => $this->features,
      'goodFeatures' => $goodFeatures,
      'relatedGoods' => $relatedGoods,
      'relatedGoodsIds' => $relatedGoodsIds,
      'otherGoods' => $otherGoods,
    ]);
  }

  public function update(Request $request, int $id) {

    //dd($request->except(['_token','_method']));
    //dd($request->all());

    /* $request->validate([
      'name' => 'required|string|min:3|max:255',
      'picture' => 'mimes:jpg,jpeg,png,gif,svg|max:5048',
      'price' => 'required|integer|min:0'
    ]); */

    //print_r($request->categories); die;

    $good = Good::find($id);

    $rules = [
      'name' => 'required|string|min:3|max:255',
      'slug' => 'nullable|unique:goods,slug,' . $good->id . ',id',
      'price' => 'nullable|numeric',
      'track_qty' => 'required|in:Y,N'
    ];

    if( !empty($request->track_qty) && $request->track_qty == 'Y' ) {
      $rules['quantity'] = 'required|numeric';
    }

    $validator = Validator::make($request->all(), $rules);

    if( $validator->fails() ) {
      session()->flash('fail', 'Validation went wrong');
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation went wrong',
        'errors' => $validator->errors()
      ]);
    }

    $good->name = $request->name;

    if(empty($request->slug)) {
      $good->slug = Str::slug($request->title);
    } else {
      $good->slug = $request->slug;
    }

    $good->subtitle = $request->subtitle;
    $good->excerpt = $request->excerpt;
    $good->description = $request->description;
    $good->related_goods = !empty($request->related_goods) ? implode(',', $request->related_goods) : '';
    $good->price = $request->price;
    $good->oldprice = $request->oldprice;
    $good->discount = $request->discount;
    $good->order_by = $request->order_by;
    $good->lang = $request->lang;
    $good->tags = $request->tags;
    $good->brand_id = $request->brand_id;
    $good->sku = $request->sku;
    $good->barcode = $request->barcode;
    $good->external_id = $request->external_id;
    $good->code = $request->code;
    $good->track_qty = $request->track_qty;
    $good->quantity = $request->quantity;
    $good->type_id = $request->type_id;
    $good->status = $request->status;
    $good->featured = $request->featured;
    $good->novelty = $request->novelty;
    $good->hit = $request->hit;
    $good->meta_title = $request->meta_title;
    $good->meta_keywords = $request->meta_keywords;
    $good->meta_description = $request->meta_description;
    $good->meta_robots = $request->meta_robots;

    $good->save();

    if($request->has('categories')) {
      $good->categories()->sync( $request->categories );
    }

    if($request->has('pictures') && !empty($request->pictures)) {

      // Fetch current good pictures
      /* $pictureGoodIds = [];
      if( DB::statement('SELECT * FROM picture_good WHERE good_id=' . $good->id) ) {
        $pictureGoodIds = DB::table('picture_good')->where('good_id','=',$good->id)->pluck('picture_id')->toArray();
      }

      // DELETE MISSING GOOD IMAGES
      if(!empty($pictureGoodIds)) {
        $diff = array_diff($pictureGoodIds, $request->pictures);
        if($diff) {
          $diff = array_values($diff);
          for($i = 0; $i < count($diff); $i++) {
            $diffPictureId = $diff[$i];
            $diffPicture = Picture::find($diffPictureId);
            if($diffPicture) {
              File::delete(public_path('uploads/goods/large/' . $diffPicture->path));
              File::delete(public_path('uploads/goods/small/' . $diffPicture->path));
              DB::table('picture_good')->where('picture_id', $diffPicture->id)->delete();
              $diffPicture->delete();
            }
          }
        }
      } */
      
      $insertPictures = [];

      foreach($request->pictures as $tempPicture) {

        /* return response()->json([
          'status' => 'test',
          'message' => $tempPicture
        ]); */

        //$requestPictureId = (int)$requestPictureId;

        //if( !in_array($requestPictureId, $pictureGoodIds) ) {
          //$tempImage = TempImage::find($requestPictureId);
          //$tempFile = public_path('temp/' . $tempPicture);
          /* return response()->json([
            'status' => 'test',
            'message' => $tempFile
          ]); */
          //$extArr = explode('.', $tempImage->name);
          //$ext = last($extArr);

          $fileName = Str::random(16) . '.webp';

          $insertPicture = Picture::create([
            'path' => $fileName
          ]);

          $insertPictures[] = $insertPicture->id;

          $tempFile = public_path('temp/' . $tempPicture);

          $largeImage = Image::read($tempFile);
          $largeImage->toWebp(100);
          /* $largeImage->resize($this->imageSizes['large'][0], null, function($constraint) {
            $constraint->aspectRatio();
          }); */
          $largeImage->save(public_path('uploads/goods/large/' . $fileName));

          $smallImage = Image::read($tempFile);
          $smallImage->toWebp(100);
          //$smallImage->resize($this->imageSizes['small'][0], $this->imageSizes['small'][1]);
          $smallImage->save(public_path('uploads/goods/small/' . $fileName));
        //}
      }
      if($insertPictures) {
        $good->pictures()->attach($insertPictures);
      }
    }

    /* if( $request->hasFile('image') ) {
      //$image = $this->storeImage($request);
      if($good->image) {
        Storage::delete($good->image);
      }
      $good->image = $request->file('image')->store('public/goods');
    } */

    if($request->has('features')) {
      
      foreach($request->features as $feature) {
        
        $goodFeature = DB::select('SELECT * FROM feature_good WHERE feature_id=? AND good_id=?', [$feature['id'], $good->id]);
        if($goodFeature) {
          DB::update('UPDATE feature_good set value=? WHERE feature_id=? AND good_id=?', [$feature['value'], $feature['id'], $good->id]);
        } else {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$feature['value'], $feature['id'], $good->id]);
        }

      }
    }

    $request->session()->flash('success', __('admin.RecordHasBeenUpdated'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordHasBeenUpdated')
    ]);

  }

  public function destroy(int $id) {
    $good = Good::find($id);
    if(!$good) {
      Session::flash('success', __('admin.RecordNotFound'));
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound'),
      ]);
    }
    if($good->pictures) {
      foreach($good->pictures as $picture) {
        //Storage::delete($picture->path);
        if(File::exists(public_path('uploads/goods/large/' . $picture->path))) {
          File::delete(public_path('uploads/goods/large/' . $picture->path));
        }
        if(File::exists(public_path('uploads/goods/medium/' . $picture->path))) {
          File::delete(public_path('uploads/goods/medium/' . $picture->path));
        }
        if(File::exists(public_path('uploads/goods/small/' . $picture->path))) {
          File::delete(public_path('uploads/goods/small/' . $picture->path));
        }
      }
      $good->pictures()->delete();
      $good->pictures()->detach();
    }
    $good->categories()->detach();
    $good->delete();
    session()->flash('success', __('admin.RecordDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
  }



  public function changestatus($id) {
    $good = Good::findOrFail($id);
    $good->status = !$good->status;
    $good->save();
    return to_route('admin.goods.index')->with('success', 'Good status has been changed');
  }

  protected function storeImage($request) {
    /* $guessExtension = $request->file('image')->guessExtension();
      $guessClientExtension = $request->file('image')->guessClientExtension();
      $mimeType = $request->file('image')->getMimeType(); // store // asStore // storePublicly // move // getClientOriginal
      $clientOriginalName = $request->file('image')->getClientOriginalName();
      $clientMimeType = $request->file('image')->getClientMimeType();
      $size = $request->file('image')->getSize(); //getError() // isValid()
      dd($clientOriginalName); */
    $newImageName = uniqid() . '-' . $request->slug . '.' . $request->picture->extension();
    return $request->picture->move( public_path('uploads'), $newImageName );
  }

  public function getRelatedGoods(Request $request) {

    

    //print_r();
    
    /* $good->status = !$good->status;
    $good->save();
    return to_route('admin.goods.index')->with('success', 'Good status has been changed'); */
  }

  public function removePicture(int $id, int $pictureId) {
    $good = Good::find($id);
    $picture = Picture::find($pictureId);
    if(File::exists( public_path('uploads/goods/large/' . $picture->path) )) {
      File::delete(public_path('uploads/goods/large/' . $picture->path));
    }
    if(File::exists( public_path('uploads/goods/small/' . $picture->path) )) {
      File::delete(public_path('uploads/goods/small/' . $picture->path));
    }
    $picture->delete();
    $good->pictures()->detach($pictureId);
    session()->flash('success', __('admin.PictureDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.PictureDeletedSuccessfully')
    ]);
    
  }


  public function removeGoodFeature(int $id, int $featureId) {
    $good = Good::find($id);
    $good->features()->detach($featureId);
    session()->flash('success', __('admin.FeatureDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.FeatureDeletedSuccessfully')
    ]);
  }
  
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use App\Models\Good;
use App\Models\Category;
use App\Models\Picture;
use App\Models\Log;

use TeaEagle\IikoTransport\App AS IikoTransport;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class GoodSeeder extends Seeder {

  protected $app;
  protected $token;
  protected $organizationId;

  public $imageSizes = [
    'small' => [387, 326],
    'large' => [592, 438],
  ];

  public function __construct() {
    $apiKey = getenv('IIKO_APIKEY');
    $app = new IikoTransport($apiKey);
    $app->setOrganization('995f17bc-1f48-401f-919a-c07c51c8d784');
    $this->app = $app;
    /* $this->token = $this->getToken();
    $this->organizationId = $this->getOrganizationId($this->token); */
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

    //\App\Models\Good::factory()->count(10)->create();

    $products = $this->app->product->list();

    if( !is_null($products) && count($products) > 0 ) {

      set_time_limit(0);
      DB::table('goods')->update(['status' => false]);

      foreach($products as $product) {

        $good = Good::where('external_id', $product->id)->first();

        // Or create new good
        if(!$good) {
          $good = new Good();
          $good->external_id = $product->id;
        }

        $good->price = isset($product->sizePrices[0]->price->currentPrice) ? $product->sizePrices[0]->price->currentPrice : 0;
        $good->order_by = $product->order;
        $good->code = $product->code;
        $good->name = $product->name;

        $good->slug = Str::slug($product->name);
        $good->type = $product->type;
        $good->excerpt = $product->description;
        $good->order_item_type = $product->orderItemType;
        $good->status = $product->isDeleted ? false : true;
        $good->save();

        $category = Category::select('id','slug')->where('external_id', $product->parentGroup)->first();

        if($category) {
          $good->categories()->detach();
          $good->categories()->attach([$category->id]);
        }

        if($product->groupModifiers) {
          DB::table('modifiers')->where('good_id', $good->id)->delete();
          foreach($product->groupModifiers as $groupModifier) {
            if($groupModifier->childModifiers) {
              foreach($groupModifier->childModifiers as $childModifier) {
                DB::insert('INSERT INTO modifiers (id,good_id,group_id,defaultAmount,minAmount,maxAmount) VALUES(?,?,?,?,?,?)', [$childModifier->id, $good->id, $groupModifier->id, $childModifier->defaultAmount, $childModifier->minAmount, $childModifier->maxAmount]);
              }
            }
          }
        }

        DB::table('feature_good')->where('good_id', $good->id)->delete();

        if($product->weight) {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$product->weight, 1, $good->id]);
        }

        if($product->proteinsAmount) {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$product->proteinsAmount, 2, $good->id]);
        }

        if($product->fatAmount) {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$product->fatAmount, 3, $good->id]);
        }

        if($product->carbohydratesAmount) {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$product->carbohydratesAmount, 4, $good->id]);
        }

        if($product->energyAmount) {
          DB::insert('INSERT INTO feature_good (value,feature_id,good_id) VALUES(?,?,?)', [$product->energyAmount, 5, $good->id]);
        }



        // Delete old pictures
        if($good->pictures->isNotEmpty()) {
          $goodPicturesId = $good->pictures->pluck('id')->toArray();
          $oldPictures = Picture::whereIn('id', $goodPicturesId)->get();
          if($oldPictures->isNotEmpty()) {
            foreach($oldPictures as $oldPicture) {
              $oldPath = public_path() . '/temp/' . $oldPicture->path;
              if(file_exists($oldPath)) {
                unlink($oldPath);
              }
              $oldPath = public_path() . '/uploads/goods/large/' . $oldPicture->path;
              if(file_exists($oldPath)) {
                unlink($oldPath);
              }
              $oldPath = public_path() . '/uploads/goods/small/' . $oldPicture->path;
              if(file_exists($oldPath)) {
                unlink($oldPath);
              }
              $oldPicture->delete();
            }
          }
        }

        $insertPictures = [];
        $good->pictures()->detach();

        if(isset($product->imageLinks) && !empty($product->imageLinks)) {

          foreach($product->imageLinks as $image) {

            $origin = $image;
            //$filename = pathinfo($origin, PATHINFO_FILENAME);
            $ext = pathinfo($origin, PATHINFO_EXTENSION);
            $fileName = Str::random(16) . '.' . $ext;
            $destinationPath = public_path('temp/' . $fileName);
            copy($origin, $destinationPath);

            $insertPicture = Picture::create([
              'path' => $fileName
            ]);

            $insertPictures[] = $insertPicture->id;

            $sourcePath = $destinationPath;

            // create new large image instance
            $destinationPath = public_path('/uploads/goods/large/' . $fileName);
            $largeImage = ImageManager::imagick()->read($sourcePath);
            $largeImage->scale($this->imageSizes['large'][0]);
            $largeImage->save($destinationPath);

            $destinationPath = public_path('/uploads/goods/small/' . $fileName);
            $smallImage = ImageManager::imagick()->read($sourcePath);
            $smallImage->cover($this->imageSizes['small'][0], $this->imageSizes['small'][1]);
            $smallImage->save($destinationPath);

            if($insertPictures) {
              $good->pictures()->attach($insertPictures);
            }
          }
        }

      }

      Log::create([
        'name' => 'Обновление ленты товаров',
        'type' => 'products',
        'description' => 'Успешно обновлен список товаров',
        'response' => json_encode($products, JSON_UNESCAPED_UNICODE),
        'status' => 'success'
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Goods updated successfully'
      ]);

    }
  }
}

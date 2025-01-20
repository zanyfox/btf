<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log AS Logging;
use TeaEagle\IikoTransport\App AS IikoTransport;
use App\Models\Log;
use App\Models\City;
use App\Models\Street;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\Good;
use App\Models\Category;
use App\Models\Picture;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class IikoController extends Controller {
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

  public function getNomenclature() {
//print_r($this->app->product->list()); die;
            /*$origin = 'https://ce6e1bcc-e329-4500-b965-54d06a22bcc8.selstorage.ru/3691729/a2bf4894-343e-4857-9a2d-b3b7d1ce985f.jpg';
            //$filename = pathinfo($origin, PATHINFO_FILENAME);
            $ext = pathinfo($origin, PATHINFO_EXTENSION);
            
            $fileName = 'test.' . $ext;
            
            $destinationPath = public_path('temp/' . $fileName . '.' . $ext);
            copy($origin, $destinationPath);

            //$insertPicture = Picture::create([
              //'path' => $fileName
            //]);

            //$insertPictures[] = $insertPicture->id;

            $sourcePath = $destinationPath;
            $destinationPath = public_path() . '/uploads/goods/test/' . $fileName;
			
            //print_r($destinationPath); die;
            //$manager = new ImageManager(new Driver());

            // create new image instance
            $smallImage = ImageManager::imagick()->read($sourcePath);
            $smallImage->cover($this->imageSizes['small'][0], $this->imageSizes['small'][1], 'left');
            $smallImage->save($destinationPath);
            print_r($smallImage); die;*/


    /* $apiKey = getenv('IIKO_APIKEY');
    $app = new IikoTransport($apiKey);
    $app->setOrganization('995f17bc-1f48-401f-919a-c07c51c8d784'); */
    //$app = $this->app;
    //print_r($this->app->product->groups()); die; //  // 
    //print_r($this->app->product->list()); die;
    // Update Groups
    $groups = $this->app->product->groups();
    
    if($groups) {
      Category::where('status', 1)->update(['status' => 0]);
      foreach ($groups as $group) {
        //if( $group->parentGroup == '611ade0f-b63b-438c-8663-6087811f71eb' ) { // РЕГАНО
        if( $group->parentGroup == 'ab0cbf04-9011-4a15-b655-169cea0e90ed' || $group->parentGroup == '7ae570a4-e589-48d9-baa2-1cc6dc68107e' ) {
          //print_r($group->name); die;
          Category::updateOrCreate(
            ['external_id' => $group->id],
            [
              'name' => $group->name,
              'slug' => Str::slug($group->name),
              'external_id' => $group->id,
              'meta_title' => $group->seoTitle,
              'meta_keywords' => $group->seoKeywords,
              'meta_description' => $group->seoDescription,
              'lang' => 'ru',
              'order_by' => $group->order,
              'status' => ($group->isDeleted || $group->id == '6d2724f3-0332-46da-a513-e24d150b0762') ? 0 : 1
            ]
          );
        }
      }
    }

    //print_r($groups); die;

    // Update Products
    $products = $this->app->product->list();

    if( $products ) {
      set_time_limit(0);
      DB::table('goods')->update(['status' => false]);
      
      foreach($products as $product) {

        $good = Good::where('external_id', $product->id)->first();

        // Or create new good
        if(!$good) {
          $good = new Good();
          $good->external_id = $product->id;
          $good->available = false;
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


        $categoryExternalId = $product->parentGroup;

        
        $category = Category::select('id')->where('external_id',$categoryExternalId)->first();
        //print_r($category->id); die;

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

        $insertPictures = [];
        $good->pictures()->detach();


        if(isset($product->imageLinks) && !empty($product->imageLinks)) {
          foreach($product->imageLinks as $image) {

            $origin = $image;
            //$filename = pathinfo($origin, PATHINFO_FILENAME);
            $ext = pathinfo($origin, PATHINFO_EXTENSION);
            $fileName = Str::random(16) . '.' . $ext;
            $destinationPath = public_path('temp/' . $fileName . '.' . $ext);
            copy($origin, $destinationPath);

            $insertPicture = Picture::create([
              'path' => $fileName
            ]);

            $insertPictures[] = $insertPicture->id;

            $sourcePath = $destinationPath;
            $destinationPath = public_path() . '/uploads/goods/large/' . $fileName;

            //print_r($destinationPath); die;
            //$manager = new ImageManager(new Driver());

            // create new image instance
            $largeImage = ImageManager::imagick()->read($sourcePath);
            //$largeImage->resize($this->imageSizes['large'][0], $this->imageSizes['large'][1]);
            $largeImage->scale($this->imageSizes['large'][0]);
            $largeImage->save($destinationPath);

            $destinationPath = public_path() . '/uploads/goods/small/' . $fileName;
            $smallImage = ImageManager::imagick()->read($sourcePath);
            //$smallImage->resize($this->imageSizes['small'][0], $this->imageSizes['small'][1]);
            $smallImage->cover($this->imageSizes['small'][0], $this->imageSizes['small'][1]);
            //$smallImage->scale($this->imageSizes['small'][0]);
            $smallImage->save($destinationPath);
    


            //$good = Good::where('id', $good->id)->first();
            if($insertPictures) {
              $good->pictures()->attach($insertPictures);
            }
          }
        }
      }
    }

    Log::create([
      'name' => 'Обновление ленты товаров',
      'type' => 'groups',
      'description' => 'Успешно обновлены группы товаров',
      'response' => json_encode($groups, JSON_UNESCAPED_UNICODE),
      'status' => 'success'
    ]);
    
    Log::create([
      'name' => 'Обновление ленты товаров',
      'type' => 'products',
      'description' => 'Успешно обновлен список товаров',
      'response' => json_encode($products, JSON_UNESCAPED_UNICODE),
      'status' => 'success'
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'Categories and Goods updated successfully'
    ]);

  }

  public function getTerminals() {
    //$terminals = $this->app->terminal->result();
    $terminals = $this->app->terminal->list();
    print_r($terminals[0]->id); die;
  }

  public function getPaymentTypes() {
    $paymentTypes = $this->app->paymentType->list();
    if( $paymentTypes ) {
      PaymentMethod::where('status', 1)->update(['status' => 0]);
      foreach($paymentTypes as $paymentType) {
        PaymentMethod::updateOrCreate(
          ['external_id' => $paymentType->id],
          [
            'name' => $paymentType->name,
            'code' => $paymentType->code,
            'description' => $paymentType->comment,
            'status' => true
          ]
        );
      }
      Logging::channel('iiko')->info('Payment Types updated', PaymentMethod::all()->toArray());
    }
  }

  // /api/iiko/get-order-types
  public function getDeliveryTypes() {

    //$deliveryTypes = $this->app->deliveryType->result();
    $deliveryTypes = $this->app->deliveryType->list();
    /* $ch = curl_init('https://api-ru.iiko.services/api/1/deliveries/order_types');
    $body = ['organizationIds' => [$this->organizationId]];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer " . $this->token]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response); */
    if( $deliveryTypes ) {
      foreach($deliveryTypes as $deliveryType) {
        DeliveryMethod::updateOrCreate(
          ['code' => $deliveryType->orderServiceType],
          [
            'external_id' => $deliveryType->id
          ]
        );
      }
    }

    return response()->json([
      'status' => 'success',
      'message' => 'Delivery Methods updated successfully'
    ]);

  }

  public function getCities() {
    //$cities = $this->app->city->result();
    $cities = $this->app->city->list();
    print_r($cities); die;
    if($cities) {
      foreach ($cities as $city) {
        City::updateOrCreate(
        ['external_id' => $city->id],
        [
          'name' => $city->name,
          'external_id' => $city->id
        ]);
      }

      Log::create([
        'name' => 'Обновление списка городов',
        'description' => 'Успешно обновлен список городов',
        'response' => json_encode($cities, JSON_UNESCAPED_UNICODE),
        'status' => 'success'
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Cities created successfully'
      ]);

    }

    Log::create([
      'name' => 'Обновление списка городов',
      'description' => 'Ошибка обновления городов',
      'status' => 'fail'
    ]);
    return response()->json([
      'status' => 'fail',
      'message' => 'No Cities'
    ]);
    
  }

  public function getStreets() {

    $streets = $this->app->street->list();
    //print_r($streets); die;
    if( $streets ) {
      foreach ($streets as $street) {
        Street::updateOrCreate(
        ['external_id' => $street->id],
        [
          'cityId' => $street->cityId,
          'name' => $street->name,
          'classifierId' => $street->classifierId,
          'external_id' => $street->id
        ]);
      }

      Log::create([
        'name' => 'Обновление списка улиц',
        'description' => 'Успешно обновлен список улиц',
        'response' => json_encode($streets, JSON_UNESCAPED_UNICODE),
        'status' => 'success'
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Streets created successfully'
      ]);
    }

    Log::create([
      'name' => 'Обновление списка улиц',
      'description' => 'Ошибка обновления улиц',
      'status' => 'fail'
    ]);

    return response()->json([
      'status' => 'fail',
      'message' => 'Ошибка обновления улиц'
    ]);
  }

  public function getStopLists() {
    $apiKey = getenv('IIKO_APIKEY');
    $iikoTransport = new \RussianProtein\iikoTransport\iikoTransport($apiKey);
    $data = $iikoTransport->getStopList(['995f17bc-1f48-401f-919a-c07c51c8d784']);
    if( isset($data->terminalGroupStopLists[0]->items[0]->items) && !empty($data->terminalGroupStopLists[0]->items[0]->items) ) {
      DB::table('goods')->update(['available' => true]);
      foreach($data->terminalGroupStopLists[0]->items[0]->items as $item) {
        $good = Good::where('external_id', $item->productId)->first();
        //if($good && $item->balance == 0) {
        if($good) {
          $good->update(['available' => false]);
        }
      }
    }
  }



  public function index2() {

    
  
   /*  $token = $this->getToken();
    if($token) {
      $organizationId = $this->getOrganizations($token);
      $menu = $this->getNomenclature($token, $organizationId);
      print_r($nomenclature); die;
    }
   */
    // do anything you want with your response
    

  /*$ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => $apiUrl . '/api/1/access_token',
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_DNS_USE_GLOBAL_CACHE => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
      'Content-Type' => 'application/x-www-form-urlencoded'
    ],
    CURLOPT_POSTFIELDS => http_build_query(['apiLogin' => $apiKey])
  ]);
  $response = curl_exec($ch);
  curl_close($ch);

  print_r($response); die;

  $result = curl_exec($ch);
  print_r($result); die; */

  
  
  //$terminal = $data->getTerminal(['995f17bc-1f48-401f-919a-c07c51c8d784']);
  
  //$regions = $data->getRegions(['995f17bc-1f48-401f-919a-c07c51c8d784']);
  //$discounts = $data->getDiscounts(['995f17bc-1f48-401f-919a-c07c51c8d784']);
  //print_r($nomenclature); die;
  foreach($nomenclature->products as $product) {
    $weight = $product->weight;
    CustomerAddress::updateOrCreate(
      ['external_id' => $product->id],
      [
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
      ]
    );
  }
  print_r($nomenclature->products); die;
  //$cities = $data->getCities(['995f17bc-1f48-401f-919a-c07c51c8d784']);

  $post = [
    'apiLogin' => 'pbapi'
  ];

  $ch = curl_init('https://api-ru.iiko.services/api/1/access_token');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

  $response = curl_exec($ch);

  // close the connection, release resources used
  curl_close($ch);

  // do anything you want with your response
  var_dump($response); die;

  $iiko_access = [
    'user_id' => 'pbapi',
    'user_secret' => 'RESTO0pb'
  ];
  
  
  $url = "https://api-ru.iiko.services/api/1/access_token";

  $defaults = [
    CURLOPT_URL => $url . '?' . http_build_query($iiko_access),
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_DNS_USE_GLOBAL_CACHE => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0
  ];

  $ch = curl_init();
  curl_setopt_array($ch, $defaults);

  $result = curl_exec($ch);
  //print_r($defaults); die;
  $iiko_token = trim($result, '"');
  


  return response()->json([
    'posts' => [
      'id' => 1,
      'title' => 'test'
    ]
  ]);

  }

  protected function getToken() {
    $apiKey = getenv('IIKO_APIKEY');  
    $ch = curl_init('https://api-ru.iiko.services/api/1/access_token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['apiLogin' => $apiKey]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response);
    return isset($decoded->token) ? $decoded->token : null;
  }

  protected function getOrganizationId($token) {
    $ch = curl_init('https://api-ru.iiko.services/api/1/organizations');
    $body = ['organizationIds' => NULL, true];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer ".$token]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response);
    return isset($decoded->organizations[0]) ? $decoded->organizations[0]->id : null;
  }

  /* protected function getStatus() {
    $token = $this->getToken();
    $ch = curl_init('https://api-ru.iiko.services/api/1/commands/status');
    $body = ['organizationIds' => ['995f17bc-1f48-401f-919a-c07c51c8d784'], true];
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer ".$token]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response);
    print_r($decoded); die;
    return isset($decoded->organizations[0]) ? $decoded->organizations[0]->id : null;
  } */

  /* protected function getNomenclature($token, $organizationId) {
    $ch = curl_init('https://api-ru.iiko.services/api/1/nomenclature');

    $body = ['organizationId' => $organizationId];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer ".$token]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response);
    print_r($decoded); die;
    return isset($decoded->organizations[0]) ? $decoded->organizations[0]->id : null;
  } */

  public function checkOrders() {

    $apiKey = getenv('IIKO_APIKEY');
    $iikoTransport = new \RussianProtein\iikoTransport\iikoTransport($apiKey);

    $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
    $todayOrders = DB::table('orders')->select('external_id')
      ->whereDate('created_at', $currentDate)
      ->where('status','new')
      ->where('external_id', '!=','')
      ->get()->toArray();
    
    $todayOrdersID = [];
    if(count($todayOrders) > 0) {
      foreach($todayOrders as $todayOrder) {
        $todayOrdersID[] = $todayOrder->external_id;
      }
      $dataIiko = $iikoTransport->getOrderById('995f17bc-1f48-401f-919a-c07c51c8d784', $todayOrdersID);
      if(count($dataIiko->orders) > 0) {
        foreach($dataIiko->orders as $iikoOrder) {
          if($iikoOrder->creationStatus == 'Error') {
            DB::table('orders')->where('id', $iikoOrder->externalNumber)->update(['status' => 'error']);
            Log::create([
              'name' => 'Ошибка создания заказа №' . $iikoOrder->externalNumber,
              'type' => 'order',
              'order_id' => $iikoOrder->externalNumber,
              'description' => $iikoOrder->errorInfo->description,
              'response' => json_encode($iikoOrder, JSON_UNESCAPED_UNICODE),
              'status' => 'fail'
            ]);
          }
        }
      }
    }
  }

}

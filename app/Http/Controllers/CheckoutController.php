<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;

use Illuminate\Support\Str;
use App\Helpers\Helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require '../vendor/autoload.php'; // На время закоментировал для php artisan route:list

use Session;
use Carbon\Carbon;
/* use RussianProtein\iikoTransport\iikoTransport; */
use TeaEagle\IikoTransport\App AS IikoTransport;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Setting;
use App\Models\Country;
use App\Models\City;
use App\Models\Street;
use App\Models\CustomerAddress;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ItemModifier;
use App\Models\Payment;
use App\Models\User;
use App\Models\Good;
use App\Models\Log;

use App\Helpers\IikoHelper;
use App\Helpers\EmailHelper;
use App\Helpers\PaykeeperHelper;

class CheckoutController extends Controller {

  protected function getPaymentLink($order) {

    $user = getenv('PAYKEEPER_USER');
    $password = getenv('PAYKEEPER_PASSWORD');
    $server_paykeeper = getenv('PAYKEEPER_SERVER');

    $base64 = base64_encode("$user:$password");         
    $headers = [
      'Content-Type: application/x-www-form-urlencoded',
      'Authorization: Basic '. $base64
    ]; 
    
             
    $payment_data = [
      "pay_amount" => $order->grand_total,
      "orderid" => $order->id,
      "client_email" => $order->email,
      "client_phone" => $order->phone,
      "clientid" => $order->name
    ];

    
    
    $uri = "/info/settings/token/";
    $curl = curl_init(); 
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    $response = curl_exec($curl);      
    $php_array = json_decode($response,true);
    
    if (isset($php_array['token'])) {
      $token = $php_array['token'];
    } else {
      return 'No token';
    }
    
    $uri = "/change/invoice/preview/";
    $request = http_build_query(array_merge($payment_data, array ('token'=>$token)));              
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$request);
    $response = json_decode(curl_exec($curl),true);
    /* if (isset($response['invoice_id'])) $invoice_id = $response['invoice_id']; else die();
    
    $link = "$server_paykeeper/bill/$invoice_id/"; */
    $link = $response['invoice_url'];
    return $link;
  }

  public function test() {
    //$paymentInfo = PaykeeperHelper::getPaymentInfoById(54);
    //print_r($paymentInfo); die;
    //echo url('/'); die; //https://regano.ru

    //$result = $this->createPayment(91);
    //print_r($result); die;

    //$result = $this->sendOrderEmail(71);
    //print_r($result); die;

    /* $order = (object)[];
    $order->id = 31;
    $order->sum = 34535;
    $order->phone = '+79056067878';
    $order->email = 'test@mail.ru';
    $paymentLink = $this->getPaymentLink($order);
    
    print_r($paymentLink); die; */

    $orderId = 163;
    $order = Order::find($orderId);

    
    $orderItems = [];
    
    if(!empty($order->items)) {
      foreach($order->items as $item) {
        
        $itemModifiers = ItemModifier::where('item_id', $item->id)->select('modifier_id','amount')->get()->toArray();
        $modifiersId = [];
        if(count($itemModifiers) > 0) {
          for($i = 0; $i < count($itemModifiers); $i++) {
            $modifiersId[] = $itemModifiers[$i]['modifier_id'];
          }
        }

        $modifiers = DB::table('modifiers')
        ->select('modifiers.*','goods.name','goods.price')
        ->leftJoin('goods','goods.external_id','=','modifiers.id')
        ->where('goods.type','Modifier')
        ->where('goods.status',true)
        ->where('modifiers.good_id',$item->good_id)
        ->whereIn('goods.id', $modifiersId)
        ->distinct()
        ->get()->toArray();

        
        /* $modifiers = DB::table('modifiers')
        ->select('modifiers.*','goods.name','goods.price')
        ->leftJoin('goods','goods.external_id','=','modifiers.id')
        ->where('goods.type','Modifier')
        ->where('goods.status',true)
        ->where('modifiers.good_id',138)
        ->whereIn('goods.id', $modifiersId)
        ->distinct()
        ->get()->toArray(); */

        $orderItems[] = [
          'id' => $item->external_id,
          'type' => 'Product',
          'product' => $item->name,
          'price' => $item->price,
          'amount' => $item->quantity,
          'modifiers' => $modifiers,
        ];
      }
    }

    

    $orderData = [
      'externalNumber' => $orderId,
      'customer' => [
        'name' => 'Тест'
      ],
      'phone' => '+7(904)606-41-99',
      'comment' => "Тестовый заказ!!!\nДоставка на ближайшее время\n Столовые приборы к заказу: Да",
      'items' => $orderItems,
      'isPickup' => false,
      'isCash' => true,
      'address' => [
        'city' => "Светлогорск",
        //'cityId' => "a65dacbc-acfa-4ec7-9435-e9300a063aff",
        //'street' => "Аптечная",
        'streetId' => "0484521b-c371-3e15-018c-7bfd8f46de3b",
        //'classifierId' => null,
        'house' => 1,
        'building' => 2,
        'entrance' => 3,
        'flat' => 5,
        'floor' => 4,
        'doorphone' => null
      ],
      'orderType' => "76067ea3-356f-eb93-9d14-1fa00d082c4e",// '5b1508f9-fe5b-d6af-cb8d-043af587d5c2',
      'paymentTypeId' => "09322f46-578a-d210-add7-eec222a08871",
      'sum' => 815
    ];

    //print_r($orderData); die;

    $orderController  = new OrderController;
    $result = $orderController->store($orderData);
    print_r($result); die;

  }
  public function index() {

    $html = '';
    if( Cart::count() > 0 ) {

      //$cartContent = Cart::content();

      $countries = Country::orderBy('name','ASC')->get();
      $cities = City::orderBy('name','ASC')->get();
      $streets = Street::orderBy('name','ASC')->get();

      //$userId = 6; // Auth::user()->id;
      //$customerAddress = CustomerAddress::where('user_id', $userId)->first();
      $customerAddress = null;

      $subtotal = Cart::subtotal(0, '.', '');
      
      
      $cartContent = Cart::content();
      $cartModifiersTotalSum = 0;
      foreach($cartContent as $item) {
        if($item->options->modifiersSum > 0) {
          $cartModifiersTotalSum += $item->options->modifiersSum * $item->qty;
        }
      }
      $cartTotalSum = $subtotal + $cartModifiersTotalSum;

      $discountAmount = 0;
      if( session()->has('discount') ) {

        $discount = session()->get('discount');
        if($discount->type == 'percent') {
          $discountAmount = $cartTotalSum/100 * $discount->discount_amount;
        } else {
          $discountAmount = $discount->discount_amount;
        }
        
      }

      // Calculate shipping
      $shippingInfo = DeliveryMethod::where('code','DeliveryByCourier')->first();

      $totalShipping = $shippingInfo->amount;

      if($cartTotalSum >= 900) {
        $totalShipping = 0;
      }

      $grandTotal = ($cartTotalSum - $discountAmount) + $totalShipping;

      $html .= '<div class="cards-container">';

      foreach(Cart::content() as $item) {
        $html .= '<div class="card" id="checkoutCartItem' . $item->rowId . '">
          <div class="card-header">
            <a href="#" class="card-image">';
            if($item->options->picture) {
              $html .= '<img src="' . asset('uploads/goods/small/' . $item->options->picture->path) . '" alt="' . $item->name . '">';
            } else {
              $html .= '<img src="https://placehold.co/387x326/EEE/002157?font=montserrat&text=Regano" alt="' . $item->name . '">';
            }
            $html .= '</a>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="card-title">
                <h4>' . $item->name . '</h4>
              </div>
              <p>' . $item->options->excerpt . '</p>
              <p>' . round($item->options->weight * 1000) . 'г.</p>';

              if($item->options->modifiersSum > 0) {
                foreach ($item->options->modifiers as $modifier) {
                  $html .= '<div class="cart-item-modfiers-list">
                    <h6>Добавлен</h6>
                    <div class="cart-item-modfier">
                      <div>' . $modifier->name . '</div>
                      <div>' . $modifier->price . ' р.</div>
                    </div>
                  </div>';
                }
              }

            $html .= '</div>
            <div class="card-footer">';
            if($item->options->modifiersSum) {
              $html .= '<p class="wrapper-price"><span id="checkoutGoodSum' . $item->rowId . '">' . ($item->price + $item->options->modifiersSum) * $item->qty . '</span><small>р.</small></p>';
            } else {
              $html .= '<p class="wrapper-price"><span id="checkoutGoodSum' . $item->rowId . '">' . $item->price * $item->qty . '</span><small>р.</small></p>';
            }
            $html .= '<div class="wrapper-quantity-input checkout-wrapper-quantity-input">
                <button type="button" class="btn-quantity-input btnChangeQty" data-dir="down">-</button>
                <input type="number" value="' . $item->qty . '" class="quantity-input number-spinner" data-rowid="' . $item->rowId . '" min="1" max="99">
                <button type="button" class="btn-quantity-input btnChangeQty" data-dir="up">+</button>
              </div>
              <button type="button" class="btn-link btnRemoveFromCart" data-rowid="' . $item->rowId . '">
                <i class="icon icon-trash"></i>
              </button>
            </div>
          </div>
        </div>';
      }
      $html .= '</div>';
      $html .= '<div class="wrappper-checkout-summary-price">';
      $html .= '<p class="text-bold">к оплате: <span id="checkoutGrandTotal">' . number_format($grandTotal, 0, '.', '') . '</span><small>р.</small></p>';
      if( $grandTotal != $cartTotalSum ) {
        $html .= '<p class="text-muted wrapperCheckoutSubtotal">Сумма заказа: <span id="checkoutSubtotal">' . $cartTotalSum . '</span><small>р.</small></p>';
      } else {
        $html .= '<p class="text-muted wrapperCheckoutSubtotal" style="display: none;">Сумма заказа: <span id="checkoutSubtotal">' . $cartTotalSum . '</span><small>р.</small></p>';
      }
      if($discountAmount > 0) {
        $html .= '<p class="text-muted wrapperCheckoutDiscount">Скидка: <span id="checkoutDiscount">' . number_format($discountAmount, 0, '.', '') . '</span><small>р.</small></p>';
      } else {
        $html .= '<p class="text-muted wrapperCheckoutDiscount" style="display: none;">Скидка: <span id="checkoutDiscount">' . number_format($discountAmount, 0, '.', '') . '</span><small>р.</small></p>';
      }
      if($totalShipping > 0) {
        $html .= '<p class="text-muted wrapperCheckoutShippingAmount">Доставка: <span id="checkoutShippingAmount">' . number_format($totalShipping, 0, '.', '') . '</span><small>р.</small></p>';
      } else {
        $html .= '<p class="text-muted wrapperCheckoutShippingAmount" style="display: none;">Доставка: <span id="checkoutShippingAmount">' . number_format($totalShipping, 0, '.', '') . '</span><small>р.</small></p>';
      }
      $html .= '</div>';

      /* if( !Auth::check() ) {
        if( session()->has('url.intended') ) {
          session(['url.intended' => url()->current()]);
        }
        return redirect()->route('auth.login');
      }

      session()->forget('url.intended'); */

      return response()->json([
        'body' => $html,
        'countries' => $countries,
        'cities' => $cities,
        'streets' => $streets,
        'customerAddress' => $customerAddress,
        'totalShipping' => $totalShipping,
        'discountCode' => Session::has('discount') ? Session::get('discount')->code : ''
      ]);

    }

  }

  public function placeOrder(Request $request) {

    /* STEP 1: FORM DATA VALIDATION */
    $rules = [
      'name' => 'required|string|min:3|max:100',
      'phone' => 'required',
      'email' => 'nullable|email',
    ];

    if( $request->delivery_type != 'DeliveryPickUp' ) {
      $rules['streetName'] = 'required|string|min:3|max:100';
      $rules['house'] = 'required';
    }


    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation errors',
        'errors' => $validator->errors()
      ]);
    }

    /* STEP 2: GET AUTH USER OR CREATE NEW USER */
    //$user = Auth::user();
    //$user = null; 
    $user =  Auth::user() ?? null;
    
    /* $user = User::firstOrCreate(
      ['email' => 'admin@gmail.com'],
      [
        'name' => $request->name,
        'phone' => $request->phone,
        //'email' => !empty($request->email) ? $request->email : 'customer' . (User::max('id') + 1) . '@regano.ru',
        'email' => 'customer' . (User::max('id') + 1) . '@regano.ru',
        'password' => Hash::make(Str::random(16)),
        'status' => true
      ],
    ); */

    /* $user = User::firstOrNew(
      ['email' => 'admin@gmail.com'],
      [
        'name' => $request->name,
        'phone' => $request->phone,
        //'email' => !empty($request->email) ? $request->email : 'customer' . (User::max('id') + 1) . '@regano.ru',
        'email' => 'customer' . (User::max('id') + 1) . '@regano.ru',
        'password' => Hash::make(Str::random(16)),
        'status' => true
      ],
    );
    $user->save(); */

    //dd($user);

    if(!$user) {
      // Insert New Record
      $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        //'email' => !empty($request->email) ? $request->email : 'customer' . (User::max('id') + 1) . '@regano.ru',
        'email' => 'customer' . (User::max('id') + 1) . '@regano.ru',
        'password' => Hash::make(Str::random(16)),
        'status' => true
      ]);
    }

    /* STEP 3: GET OR DEFINE DELIVERY AND PAYMENT TYPES */
    $requestDeliveryType = !empty($request->delivery_type) ? $request->delivery_type : 'DeliveryPickUp';
    $deliveryType = DeliveryMethod::where(['code' => $requestDeliveryType, 'status' => true])->first();
    if(!$deliveryType) {
      return response()->json([
        'status' => 'fail',
        'data' => __('app.DeliveryTypeNotFound')
      ]);
    }

    $requestPaymentType = !empty($request->payment_method) ? $request->payment_method : 'CASH';
    $paymentType = PaymentMethod::where(['code' => $requestPaymentType, 'status' => true])->first();

    if(!$paymentType) {
      return response()->json([
        'status' => 'fail',
        'data' => __('app.PaymentTypeNotFound')
      ]);
    }


    $isPickup = $deliveryType->code == 'DeliveryPickUp';
    $isCash = $paymentType->code == 'CASH';

    /* STEP 4: CREATE OR UPDATE CUSTOMER ADDRESS (IF DELIVERY TYPE IS NOT SELF-DELIVERY) */
    //if(!$isPickup) {
      CustomerAddress::updateOrCreate(
        ['user_id' => $user->id],
        [
          'country_id' => 179,
          'city' => $request->city,
          'street_id' => $request->streetId,
          'street_name' => $request->streetName,
          'house' => $request->house,
          'building' => $request->building,
          'entrance' => $request->entrance,
          'floor' => $request->floor,
          'flat' => $request->flat,
          'doorphone' => $request->doorphone,
          'notes' => $request->notes,
          'type_id' => $deliveryType->id,
          'delivery_date' => (isset($request->date) && !empty($request->date)) ? Carbon::parse($request->date)->format('Y-m-d') : null,
          'delivery_time' => (isset($request->time) && !empty($request->time)) ? Carbon::parse($request->time)->format('H:i:s') : null
        ]
      );
    //}

  
    /* STEP 5: CREATE NEW ORDER IN SITE DATABASE */

    // For goods
    $subTotal = (int)Cart::subtotal(0,'','');

    $cartController = new CartController;
    $cartModifiersTotalSum = $cartController->getCartModifiersTotalSum();
    $subTotal += $cartModifiersTotalSum;
    


    // Shipping Total
    $shipping = $deliveryType->amount;

    if( $subTotal >= 900 ) {
      $shipping = 0;
    }

    // Apply Discount
    $discountAmount = 0;
    if(session()->has('discount')) {
      $discount = session()->get('discount');
      if($discount->type == 'percent') {
        $discountAmount = ($discount->discount_amount/100) * $subTotal;
      } else {
        $discountAmount = $discount->discount_amount;
      }
      $discountAmount = round($discountAmount);
    }

    if($discountAmount) {
      $grandTotal = ($subTotal - $discountAmount) + $shipping;
    } else {
      $grandTotal = $subTotal + $shipping;
    }

    // Create Order
    $order = new Order;
    $order->user_id = $user->id;
    //$order->payment_id = $paymentType->id;
    $order->subtotal = $subTotal;
    $order->shipping = $shipping;
    $order->discount_code = isset($discount->code) && !empty($discount->code) ? $discount->code : null;
    $order->discount_amount = $discountAmount;
    $order->grand_total = $grandTotal;

    $currency = \App\Services\CurrencyConversion::getCurrentCurrencyFromSession();
    $order->currency_id = $currency->id; // 1; // Rubles

    $order->name = $request->name;
    $order->phone = $request->phone;
    $order->email = $request->email;
    $order->notes = $request->notes;

    if($request->delivery_time == 'onway') {
      $order->notes .= PHP_EOL . 'Доставка на ближайшее время';
    }

    if($request->delivery_time == 'ontime') {
      $order->notes .= PHP_EOL . 'Доставка на указанное время: ' . $request->date . ' ' . $request->time;
    }

    if(!empty($request->moneychange)) {
      $order->notes .= PHP_EOL . 'Требуется сдача с ' . $request->moneychange;
    }

    if( $request->cutlery == 'on' ) {
      $order->notes = $order->notes . PHP_EOL . 'Столовые приборы к заказу: Да';
    }

    if( $request->cutlery == 'off' ) {
      $order->notes = $order->notes . PHP_EOL . 'Столовые приборы к заказу: Нет';
    }

    $order->status = 'new';

    // Save New Order
    $order->save();

    $orderItems = [];

    /* STEP 6: STORE ORDER ITEMS IN ORDER ITEMS TABLE */
    foreach (Cart::content() as $item) {

      $orderItem = new OrderItem;
      $orderItem->order_id = $order->id;
      $orderItem->good_id = $item->id;
      //$orderItem->color_id = $item->options->color_id;
      //$orderItem->size_id = $item->options->size_id;
      $orderItem->name = $item->name;
      $orderItem->external_id = $item->options->external_id;
      $orderItem->quantity = $item->qty;
      $orderItem->price = $item->price;
      $orderItem->total = $item->price * $item->qty;
      $orderItem->save();

      /* if($item->options->color_id) {
        $orderItem->goodColor()->decrement('quantity', $item->qty);
        $orderItem->save();
      }
      if($item->options->size_id) {
        $orderItem->goodSize()->decrement('quantity', $item->qty);
        $orderItem->save();
      } */

      // SAVE MODIFIERS TO DB
      $itemModifiers = $item->options->modifiers;
      if( $itemModifiers ) {
        foreach($itemModifiers as $modifier) {
          DB::table('item_modifiers')->insert(['item_id' => $orderItem->id, 'modifier_id' => $modifier->id, 'amount' => 1]);
        }
      }     

      // UPDATE GOOD QTY IN STOCK IF TRACK QTY IS TURN ON
      $goodData = Good::find($item->id);
      if( $goodData->track_qty == 'Y' ) {
        $goodData->quantity = $goodData->quantity - $item->qty;
        $goodData->save();
      }

      $orderItems[] = [
        'id' => $item->options->external_id,
        'type' => 'Product',
        'product' => $item->name,
        'price' => $item->price,
        'amount' => $item->qty,
        'modifiers' => $item->options->modifiers
      ];

    }

    /* STEP 7: SEND ORDER DATA TO IIKO */
    /* $orderData = [
      'externalNumber' => $order->id,
      'customer' => [
        'name' => $order->name
      ],
      'phone' => $order->phone,
      'comment' => $order->notes,
      'items' => $orderItems,
      'isPickup' => $isPickup,
      'isCash' => $isCash,
      'address' => [
        'city' => $request->city,
        //'streetName' => $request->streetName, //'Аптечная',
        'streetId' => $request->streetId,
        //'classifierId' => '39016001000000100',
        'house' => $request->house,
        'building' => $request->building,
        'entrance' => $request->entrance,
        'flat' => $request->flat,
        'floor' => $request->floor,
        //'doorphone' => 'No'
      ],
      'orderType' => $deliveryType->external_id,
      'paymentTypeId' => $paymentType->external_id,
      'sum' => $order->grand_total
    ]; */

    /* STEP 7: CREATE PAYMENT */
    $payment = $this->createPayment($order->id, $paymentType->id);

    
    /* STEP 8: SELECT PAYMENT OPTION */
    if($paymentType->code == 'ONLN' || $paymentType->code == 'SBP') {

      // INCLUDE PAYKEEPER HERE
      $paymentLink = $this->getPaymentLink($order);

      return response()->json([
        'status' => 'waiting',
        'isOnline' => $paymentType->code == 'ONLN',
        'isSBP' => $paymentType->code == 'SBP',
        'redirectUrl' => $paymentLink,
        'orderId' => $order->id,
        'message' => __('app.OrderPlacedSuccessfully')
      ]);

    } else {

      $result = IikoHelper::createOrder($order->id);
      //$result = $this->createOrder($orderData);

      $order->external_id = null;
      if( isset($result->orderInfo->id) && !empty($result->orderInfo->id) ) {
        $order->external_id = $result->orderInfo->id;
        $order->save();
      }

      /* STEP 8: SEND ORDER DATA TO CUSTOMER AND ADMIN EMAIL */
      EmailHelper::sendOrderEmail($order->id, $deliveryType, $paymentType);

      session()->forget('discount');
      session()->flash('success', __('app.YouHaveSuccessfullyPlacedYourOrder'));
      Cart::destroy();

    }

    

    
    //print_r($result->orderInfo->id); die;

    

    //$result = $this->sendOrderTg(11);
    //print_r($result); die;

    /* $result = Helper::orderEmail(11);

    print_r($result); die; */


    return response()->json([
      'status' => 'success',
      'isCard' => false,
      'orderId' => $order->id,
      'orderExternalId' => $order->external_id,
      'message' => __('app.OrderPlac  edSuccessfully')
    ]);
    
  }

  protected function createPayment($orderId, $paymentTypeId) {
    $order = Order::find($orderId);
    $result = Payment::create([
      'orderid' => $order->id,
      'type_id' => $paymentTypeId,
      'sum' => $order->grand_total,
      'client_email' => $order->email,
      'client_phone' => $order->phone
    ]);
    return $result;
  }

  public function getOrderSummary(Request $request) {
    if( !$request->type ) {
      return response()->json([
        'status' => 'fail'
      ]);
    }
    $subTotal = (int)Cart::subtotal(0, '.', '');

    $cartController = new CartController;
    $cartModifiersTotalSum = $cartController->getCartModifiersTotalSum();
    $subTotal += $cartModifiersTotalSum;


    $discountAmount = 0;
    // Apply Discount
    if(session()->has('discount')) {
      $discount = session()->get('discount');
      if($discount->type == 'percent') {
        $discountAmount = ($discount->discount_amount/100) * $subTotal;
      } else {
        $discountAmount = $discount->discount_amount;
      }
    }


    $grandTotal = $subTotal;
    if($discountAmount) {
      $grandTotal = $subTotal-$discountAmount;
    }

    $deliveryMethod = DeliveryMethod::where('code', $request->type)->first();
    $totalShipping = $deliveryMethod->amount ? $deliveryMethod->amount : 0;

    if($subTotal >= 900) {
      $totalShipping = 0;
    }

    if($deliveryMethod->amount) {
      $grandTotal += $totalShipping;
    }

    

    return response()->json([
      'status' => 'success',
      'subTotal' => number_format($subTotal, 0, '.', ''),
      'totalShipping' => number_format($totalShipping, 0, '.', ''),
      'grandTotal' => number_format($grandTotal, 0, '.', ''),
      'discount' => $discountAmount
    ]);
  }

  public function applyDiscount(Request $request) {
    
    if( !$request->code ) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Nocode'
      ]);
    }
    $discount = Discount::where('code', $request->code)->first();
    if(!$discount) {
      return response()->json([
        'status' => 'fail',
        'message' => __('app.InvalidDiscountCoupon')
      ]);
    }

    $now = Carbon::now();
    
    if($discount->starts_at != '') {
      $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $discount->starts_at);
      if( $now->lt($startDate) ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('app.InvalidDiscountCoupon')
        ]);
      }
    }

    if($discount->expires_at != '') {
      $expireDate = Carbon::createFromFormat('Y-m-d H:i:s', $discount->expires_at);
      if( $now->gt($expireDate) ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('app.InvalidDiscountCoupon')
        ]);
      }
    }

    // MAX USES CHECK
    /* if($discount->max_uses > 0) {
      $couponUsedCount = Order::where('discount_code', $discount)->count();
      if( $couponUsedCount >= $discount->max_uses ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('app.YouAlreadyUsedThisCouponCode')
        ]);
      }
    } */

    // MAX USES USER CHECK
    /* if($discount->max_uses_user > 0) {
      $couponUsedByUserCount = Order::where(['discount_code' => $discount, 'user_id' => Auth::user()->id])->count();
      if( $couponUsedByUserCount >= $discount->max_uses_user ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('app.InvalidDiscountCoupon')
        ]);
      }
    } */

    // MIN AMOUNT CONDITION CHECK
    if($discount->min_amount > 0) {
      $subTotal = Cart::subtotal(0, '.','');
      if( $subTotal < $discount->min_amount ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('app.YourMinAmountMustBe') . ' ' . $discount->min_amount
        ]);
      }
    }

    /* return response()->json([
      'status' => 'test5',
      'data' => $discount
    ]); */

    session()->put('discount', $discount);
    return $this->getOrderSummary($request);
    /* return response()->json([
      'status' => 'success'
    ]); */
  }

  public function removeDiscount(Request $request) {
    session()->forget('discount');
    return $this->getOrderSummary($request);
  }

  public function thankyou($orderId) {

    $apiKey = getenv('IIKO_APIKEY');
    $iikoTransport = new \RussianProtein\iikoTransport\iikoTransport($apiKey);
    /* $data = $iikoTransport->getOrderById('995f17bc-1f48-401f-919a-c07c51c8d784',['2b1d82d5-5355-4626-08d7-84c9f1107b13']);
    print_r($data); die; */

    $order = Order::find($orderId);


/*     $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    $deliveryType = DeliveryMethod::find($customerAddress->type_id);

    $payment = Payment::where('orderid', $order->id)->first();
    $paymentType = PaymentMethod::find($payment->type_id);
    $result = EmailHelper::sendOrderEmail($order->id, $deliveryType, $paymentType);
    print_r($result); die;










 */

    $orderInfo = null;
    if(isset($order->external_id)) {
      $data = $iikoTransport->getOrderById('995f17bc-1f48-401f-919a-c07c51c8d784',[$order->external_id]);
      $orderInfo = isset($data->orders[0]) ? $data->orders[0] : null;
      Log::create([
        'name' => 'Лог заказа iiko',
        'type' => 'order',
        'order_id' => $orderId,
        'description' => 'Лог заказа №' . $orderId,
        'response' => json_encode($orderInfo, JSON_UNESCAPED_UNICODE),
        'status' => 'success'
      ]);
    }

    
    
    return view('checkout.thankyou', ['orderId' => $orderId]);
  }

  public function success() {
    session()->forget('discount');
    session()->flash('success', __('app.YouHaveSuccessfullyPlacedYourOrder'));
    Cart::destroy();

    return view('checkout.success');
  }

  public function fail() {
    return view('checkout.fail');
  }

  /*protected function sendOrderEmail($orderId, $deliveryType = null, $paymentType = null) {

    $order = Order::find($orderId);
    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    //print_r($customerAddress); die;

    $admin = User::where('id',1)->first();
    //print_r($admin->email); die;
    $data = [
      'order' => $order,
      'customerAddress' => $customerAddress,
      'subject' => 'Order Mail'
    ];
    Mail::to('nozhikmayakovskogo@gmail.com')->send(new OrderEmail($data));
    print_r($customerAddress); die;


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = getenv('MAIL_HOST');
    $mail->SMTPAuth = true;
    $mail->Username = getenv('MAIL_USERNAME');
    $mail->Password = getenv('MAIL_PASSWORD');
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = getenv('MAIL_PORT');
    $mail->CharSet = 'utf-8';
    $mail->SMTPOptions = [
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      ]
    ];
    $mail->setFrom(getenv('MAIL_USERNAME'), 'Admin');

    $settingEmail = Setting::where('key','email')->first();
    if( $settingEmail->value ) {
      $mail->addAddress($settingEmail->value, 'Администратор');
      $mail->addAddress('nozhikmayakovskogo@gmail.com', 'Администратор');
    }
    if( $order->email ) {
      $mail->addAddress($order->email, $order->name);
    }
    $mail->isHTML(true);
    $mail->Subject = 'Новый заказ';

    $html = '<h2>Новый заказ</h2>';
    $html .= '<h3>Номер заказа: ' . $order->id . '</h3>';
    $html .= '<h4>Имя клиента: ' . $order->name . ', Email: ' . $order->email . ', Телефон: ' . $order->phone . '</h4>';

    if(isset($paymentType->code)) {
      $html .= '<h4>Способ доставки: ' . $paymentType->name . '</h4>';
    }

    if(isset($deliveryType->code)) {
      $html .= '<h4>Способ доставки: ' . $deliveryType->name . '</h4>';
    }

    if(isset($deliveryType->code) && $deliveryType->code == 'DeliveryByCourier') {
      if($customerAddress) {
        $html .= '<h4 style="margin-bottom: 5px;">Адрес доставки:</h4><address>';
      }
      if($customerAddress->city) {
        $html .= 'г.' . $customerAddress->city;
      }
      if($customerAddress->street_name) {
        $html .= ', ' . $customerAddress->street_name;
      }
      if($customerAddress->house) {
        $html .= ', д.' . $customerAddress->house;
      }
      if($customerAddress->building) {
        $html .= ', к.' . $customerAddress->building;
      }
      if($customerAddress->entrance) {
        $html .= ', подъезд ' . $customerAddress->entrance;
      }
      if($customerAddress->floor) {
        $html .= ', этаж ' . $customerAddress->floor;
      }
      if($customerAddress->flat) {
        $html .= ', кв.' . $customerAddress->flat;
      }
      if($customerAddress) {
        $html .= '</address>';
      }
    }

    if($order->notes) {
      $html .= '<h4>Примечание к заказу:</h4><p>' . $order->notes . '</p>';
    }
    $html .= '<br><br><table width="760" cellpadding="4" cellspacing="0" border="1">
    <thead>
      <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Сумма</th>
      </tr>
    </thead>
    <tbody>';
    foreach($order->items as $item) {
      $html .= '<tr>
        <td>' . $item->name . '</td>
        <td align="center">' . $item->price . '</td>
        <td align="center">' . $item->quantity . '</td>
        <td align="center">' . $item->total . '</td>
      </tr>';
    }
    $html .= '<tr>
          <th align="right" colspan="3">Стоимость товаров:</th>
          <th>' . $order->subtotal . '</th>
        </tr>
        <tr>
          <th align="right" colspan="3">Скидка:</th>
          <th>' . $order->discount_amount . '</th>
        </tr>
        <tr>
          <th align="right" colspan="3">Доставка:</th>
          <th>' . $order->shipping . '</th>
        </tr>
        <tr>
          <th align="right" colspan="3">Итоговая сумма:</th>
          <th>' . $order->grand_total . '</th>
        </tr>
      </tbody>
    </table>';
    $mail->Body = $html;
    return $mail->send();
  }*/

  protected function sendOrderTg($orderId) {

    /* $order = Order::find($orderId);
    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();

    $text = '';

    $apiToken = "6827212378:AAGG3CLbVrGFTk6fmyfj-Wbdea7N5LlnBq82";
    $data = [
        'chat_id' => '-10021364745662',
        'text' => $text
    ];
    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
    return $response; */
  }

  public function getMapPoint(Request $request) {
    $encoder = [
      'а' => "%D0%B0",
      'б' => "%D0%B1",
      'в' => "%D0%B2",
      'г' => "%D0%B3",
      'д' => "%D0%B4",
      'е' => "%D0%B5",
      'ё' => "%D1%91",
      'ж' => "%D0%B6",
      'з' => "%D0%B7",
      'и' => "%D0%B8",
      'й' => "%D0%B9",
      'к' => "%D0%BA",
      'л' => "%D0%BB",
      'м' => "%D0%BC",
      'н' => "%D0%BD",
      'о' => "%D0%BE",
      'п' => "%D0%BF",
      'р' => "%D1%80",
      'с' => "%D1%81",
      'т' => "%D1%82",
      'у' => "%D1%83",
      'ф' => "%D1%84",
      'х' => "%D1%85",
      'ц' => "%D1%86",
      'ч' => "%D1%87",
      'ш' => "%D1%88",
      'щ' => "%D1%89",
      'ъ' => "%D1%8A",
      'ы' => "%D1%8B",
      'ь' => "%D1%8C",
      'э' => "%D1%8D",
      'ю' => "%D1%8E",
      'я' => "%D1%8F",
      '(' => "%28",
      ')' => "%29",
      ' ' => "%20"
    ];
    
    $street = $request->street;
    $streetParts = preg_split('//u', $street, NULL, PREG_SPLIT_NO_EMPTY);
    $streetEncoded = '';
    foreach ($streetParts as $key => $letter) {
      $streetEncoded .= $encoder[mb_strtolower($letter)];
    }
    $house = $request->house;
    $options = [];
    
    $url = "https://geocode-maps.yandex.ru/1.x/?apikey=388a2222-79af-4a68-9aee-366c805c4825&format=json&geocode=%D0%9A%D0%B0%D0%BB%D0%B8%D0%BD%D0%B8%D0%BD%D0%B3%D1%80%D0%B0%D0%B4%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C+%D0%A1%D0%B2%D0%B5%D1%82%D0%BB%D0%BE%D0%B3%D0%BE%D1%80%D1%81%D0%BA+$streetEncoded+$house&results=1";
    
    $defaults = [
      CURLOPT_URL => $url,
      CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
      ],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_DNS_USE_GLOBAL_CACHE => false,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => 0
    ];
    
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    
    if (!$result = curl_exec($ch)) {
      trigger_error(curl_error($ch));
    }
    
    curl_close($ch);
    $decoded = json_decode($result);

    return response()->json([
      'status' => 'success',
      'point' => isset($decoded->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos) ? $decoded->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos : null
    ]);
    
    
  }

}

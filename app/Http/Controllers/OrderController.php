<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Order;

use TeaEagle\IikoTransport\App AS IikoTransport;

class OrderController extends Controller {

  public function show($id) {
    return view('order/show');
  }

  /*public function store(Request $request) {


    dd(auth()->user()->id);

    $order = Order::create([
      'user_id' => auth()->user()->id,
      'server_id' => 1,
      'status' => 'new',
      'sum' => 0,
    ]);

    if($request->has('goods')) {
      $order->goods()?->attach( $request->goods );
    }

    Session::flash('success', 'New order has been created');
    return redirect('/order/thanks');
  }

  public function thanks() {
    return '9';
  }*/

  public function store($data) {

    $apiKey = getenv('IIKO_APIKEY');
    $app = new IikoTransport($apiKey);
    
    //$organizations = $app->organization->getOrganizationIds();
    //$terminals = $app->terminal->list();

    $app->setOrganization('995f17bc-1f48-401f-919a-c07c51c8d784');
    $app->setTerminal('bfcc5950-17f1-4927-9e0a-934c07823240');

    $order = $app->newOrder();
    $order->setRealOrderId($data['externalNumber']);
    
    
    $order->setPhone($data['phone']);
    $order->setCustomer($data['customer']['name']);
    $order->setComment($data['comment']);

    foreach ($data['items'] as $key => $item) {
      $product = $app->newProduct();
      $product->setId($item['id']);
      $product->setAmount($item['amount']);

      // Модификаторы
      if (!empty($item['modifiers']) && is_array($item['modifiers'])) {
        foreach ($item['modifiers'] as $keyChild => $modItem) {
          $modifier = $app->newModifier();
          $modifier->setId($modItem->id);
          $modifier->setGroup($modItem->group_id);
          $modifier->setAmount(1);
          $modifier->setPrice($modItem->price);
          $product->setModifier($modifier);
        }
      }
      
      $order->setProduct($product);
    }
    
    //print_r($order); die;
    
    if( $data['isPickup'] === false && $data['sum'] < 900 ) {

      $product = $app->newProduct();
      $product->setId('dec3934f-e1aa-4b13-85ab-26b7e8dee610');
      $product->setAmount(1);
      $order->setProduct($product);

    }

    
    if ($data['isPickup'] === false) {

      
      
      $order->isDelivery(true);
      $address = $app->newAddress();
      
      $address->setCity($data['address']['city']);
      
      if(isset($data['address']['street']) && !empty($data['address']['street'])) {
        $address->setStreet($data['address']['street']);
      }
      if(isset($data['address']['streetId']) && !empty($data['address']['streetId'])) {
        $address->setStreetId($data['address']['streetId']);
      }
      if(isset($data['address']['classifierId']) && !empty($data['address']['classifierId'])) {
        $address->setClassifierId($data['address']['classifierId']);
      }
      $address->setHouse($data['address']['house']);
      $address->setBuilding($data['address']['building']);
      $address->setEntrance($data['address']['entrance']);
      $address->setFlat($data['address']['flat']);
      $address->setFloor($data['address']['floor']);
      if(isset($data['address']['doorphone']) && !empty($data['address']['doorphone'])) {
        $address->setDoorphone($data['address']['doorphone']);
      }
      $order->setAddress($address);
      
    }

    // Оплата бонусами
    /*if ($bonuses) {
      $payment = $app->newPayment();
      $payment->setIsIikoCard();
      $payment->setPaymentTypeId('43259388-c317-4bd5-a81a-d7ccb7c0b892');
      $payment->setSum(100);
      $payment->setPhone('+70000000000');
      $order->setPayment($payment);
    }*/

    $payment = $app->newPayment();

    if($data['isCash']) {
      // Оплата наличными
      $payment->setIsCash();
    } else {
      // Оплата картой
      $payment->setIsCard();
      $payment->setIsProcessedExternally();
    }

    $payment->setPaymentTypeId($data['paymentTypeId']);
    $payment->setSum($data['sum']);

    $order->setPayment($payment);
    
    // Тип заказа
    $order->setOrderType($data['orderType']);
    
    // Вернёт массив готовый к запросу
    //$array = $order->toArray();
    //print_r($array); die;
    $doOrder = $order->send();
    print_r($doOrder); die;
    return $doOrder;

  }

}

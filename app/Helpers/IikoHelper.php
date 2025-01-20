<?php

namespace App\Helpers;
use DB;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\Payment;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\ItemModifier;
use App\Models\Log;

use TeaEagle\IikoTransport\App AS IikoTransport;

class IikoHelper {

  public static function createOrder(int $orderId) {

    // FIND CUSTOMER ORDER BY ID
    $order = Order::find($orderId);

    // FORM ORDER DATA
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

    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    $deliveryType = DeliveryMethod::where(['id' => $customerAddress->type_id])->first();

    $payment = Payment::where('orderid',  $orderId)->first();
    $paymentType = PaymentMethod::where(['id' => $payment->type_id])->first();

    $isPickup = $deliveryType->code == 'DeliveryPickUp';
    $isCash = $paymentType->code == 'CASH';

    $data = [
      'externalNumber' => $order->id,
      'customer' => [
        'name' => $order->name
      ],
      'phone' => $order->phone,
      'comment' => $order->notes,
      'items' => $orderItems,
      'sum' => $order->grand_total,
      'isPickup' => $isPickup,
      'isCash' => $isCash,
      'address' => [
        'city' => $customerAddress->city,
        'streetId' => $customerAddress->street_id,
        'house' => $customerAddress->house,
        'building' => $customerAddress->building,
        'entrance' => $customerAddress->entrance,
        'flat' => $customerAddress->flat,
        'floor' => $customerAddress->floor
      ],
      'orderType' => $deliveryType->external_id,
      'paymentTypeId' => $paymentType->external_id
    ];


    $apiKey = getenv('IIKO_APIKEY');
    $app = new IikoTransport($apiKey);
    $app->setOrganization('995f17bc-1f48-401f-919a-c07c51c8d784');
    $app->setTerminal('bfcc5950-17f1-4927-9e0a-934c07823240');
    
    
    $iikoOrder = $app->newOrder();
    $iikoOrder->setRealOrderId($data['externalNumber']);
    
    $iikoOrder->setPhone($data['phone']);
    $iikoOrder->setCustomer($data['customer']['name']);
    $iikoOrder->setComment($data['comment']);

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

      $iikoOrder->setProduct($product);
    }

    if( $data['isPickup'] === false && $data['sum'] < 900 ) {

      $product = $app->newProduct();
      $product->setId('6d2724f3-0332-46da-a513-e24d150b0762');
      $product->setAmount(1);
      $iikoOrder->setProduct($product);

    }

    if ($data['isPickup'] === false) {




      $iikoOrder->isDelivery(true);
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
      //$address->setStreetId($data['address']['streetId']);
      //$address->setClassifierId($data['address']['classifierId']);
      $address->setHouse($data['address']['house']);
      $address->setBuilding($data['address']['building']);
      $address->setEntrance($data['address']['entrance']);
      $address->setFlat($data['address']['flat']);
      $address->setFloor($data['address']['floor']);
      if(isset($data['address']['doorphone']) && !empty($data['address']['doorphone'])) {
        $address->setDoorphone($data['address']['doorphone']);
      }
      $iikoOrder->setAddress($address);
    }

    // Оплата бонусами
    /* if ($bonuses) {
      $iikoPayment = $app->newPayment();
      $iikoPayment->setIsIikoCard();
      $iikoPayment->setPaymentTypeId('43259388-c317-4bd5-a81a-d7ccb7c0b892');
      $iikoPayment->setSum(100);
      $iikoPayment->setPhone('+70000000000');
      $iikoOrder->setPayment($iikoPayment);
    } */

    // Оплата картой
    /* $iikoPayment = $app->newPayment();
    $iikoPayment->setIsCard();
    $iikoPayment->setPaymentTypeId('faa09787-9403-467e-829a-1bb6de306e6f');
    $iikoPayment->setSum('330');
    $iikoPayment->setIsProcessedExternally();
    $iikoOrder->setPayment($iikoPayment); */

    // Оплата наличными
    $iikoPayment = $app->newPayment();
    if($data['isCash']) {
      $iikoPayment->setIsCash();
    } else {
      $iikoPayment->setIsCard();
      $iikoPayment->setIsProcessedExternally();
    }

    $iikoPayment->setPaymentTypeId($data['paymentTypeId']);
    $iikoPayment->setSum($data['sum']);
    $iikoOrder->setPayment($iikoPayment);

    // Тип заказа
    $iikoOrder->setOrderType($data['orderType']);
    
    // Вернёт массив готовый к запросу
    $array = $iikoOrder->toArray();
    //print_r($array); die;
    $doOrder = $iikoOrder->send();
    //print_r($doOrder); die;

    Log::create([
      'name' => 'Лог заказа iiko',
      'type' => 'order',
      'description' => 'Лог',
      'response' => json_encode($doOrder, JSON_UNESCAPED_UNICODE),
      'status' => 'success'
    ]);

    return $doOrder;
  }

}
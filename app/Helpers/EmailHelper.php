<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\Setting;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class EmailHelper {

  public static function sendOrderEmail($orderId, $deliveryType, $paymentType) {

    $order = Order::find($orderId);
    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    //print_r($customerAddress); die;

    /* $admin = User::where('id',1)->first();
    //print_r($admin->email); die;
    $data = [
      'order' => $order,
      'customerAddress' => $customerAddress,
      'subject' => 'Order Mail'
    ];
    Mail::to('nozhikmayakovskogo@gmail.com')->send(new OrderEmail($data));
    print_r($customerAddress); die; */


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
    $mail->setFrom(getenv('MAIL_USERNAME'), 'Регано Пастерия');

    $settingEmail = Setting::where('key','email')->first();
    if( $settingEmail->value ) {
      $mail->addAddress($settingEmail->value, 'Регано Пастерия');
      //$mail->addAddress('nozhikmayakovskogo@gmail.com', 'Регано Пастерия');
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
      $html .= '<h4>Способ оплаты: ' . $paymentType->name . '</h4>';
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

      $itemModifiers = \DB::table('item_modifiers')->select('goods.name','goods.price')->leftJoin('goods', 'goods.id','=','item_modifiers.modifier_id')->where('item_modifiers.item_id', $item->id)->get();
      


      $html .= '<tr>
        <td>' . $item->name;
        if($itemModifiers) {
          $html .= '<ul>';
          foreach($itemModifiers as $itemModifier) {
            $html .= '<li>' . $itemModifier->name . ', стоимость: '. $itemModifier->price . '</li>';
          }
          $html .= '</ul>';
        }
        $html .= '</td>
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
  }
}
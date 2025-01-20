<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\Payment;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;

use App\Helpers\IikoHelper;
use App\Helpers\EmailHelper;

class PaymentController extends Controller {


  public function index() {

    file_put_contents("paykeeper.txt", serialize($_POST));
    //$array = file_get_contents("paykeeper.txt");
    //$_POST = unserialize($array);
    //print_r($_POST); die;
    $order = Order::find($_POST['orderid']);
	  
    
    /* SEND ORDER DATA TO IIKO */
    $result = IikoHelper::createOrder($_POST['orderid']);

    $order->external_id = null;
    if( isset($result->orderInfo->id) && !empty($result->orderInfo->id) ) {
      $order->external_id = $result->orderInfo->id;
      $order->save();
    }
    $payment = Payment::where('orderid', $order->id)->first();

    /* DB::transaction(function() {
      DB::update('UPDATE orders SET external_id = ? WHERE id = ?', [$result->orderInfo->id, $_POST['orderid']]);
      DB::update('UPDATE payments SET paymentid = ? WHERE orderid = ?', [$_POST['id'], $order->id]);
    }); */
    
    $result = $payment->update([
      'paymentid' => $_POST['id'],
      'clientid' => isset($_POST['clientid']) ? $_POST['clientid'] : '',
      'sum' => isset($_POST['sum']) ? $_POST['sum'] : null,
      'key' => isset($_POST['key']) ? $_POST['key'] : '',
      'ps_id' => isset($_POST['ps_id']) ? $_POST['ps_id'] : null,
      'client_email' => isset($_POST['client_email']) ? $_POST['client_email'] : '',
      'client_phone' => isset($_POST['client_phone']) ? $_POST['client_phone'] : '',
      'service_name' => isset($_POST['service_name']) ? $_POST['service_name'] : '',
      'card_number' => isset($_POST['card_number']) ? $_POST['card_number'] : '',
      'card_holder' => isset($_POST['card_holder']) ? $_POST['card_holder'] : '',
      'card_expiry' => isset($_POST['card_expiry']) ? $_POST['card_expiry'] : null,
      'obtain_datetime' => isset($_POST['obtain_datetime']) ? $_POST['obtain_datetime'] : null,
      'RRN' => isset($_POST['RRN']) ? $_POST['RRN'] : '',
      'APPROVAL_CODE' => isset($_POST['APPROVAL_CODE']) ? $_POST['APPROVAL_CODE'] : ''
    ]);
    
    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    $deliveryType = DeliveryMethod::find($customerAddress->type_id);
    $paymentType = PaymentMethod::find($payment->type_id);
    EmailHelper::sendOrderEmail($order->id, $deliveryType, $paymentType);
    
    if(url('/') == 'https://regano.ru') {
      $secret_seed = getenv('PAYKEEPER_SECRET_SEED');
    } else {
      $secret_seed = getenv('PAYKEEPER_SECRET_SEED_TEST');
    }
    
    
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $sum = isset($_POST['sum']) ? $_POST['sum'] : '';
    $clientid = isset($_POST['clientid']) ? $_POST['clientid'] : '';
    $orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    
    if( $key != md5($id.number_format($sum, 2, ".", "").$clientid.$orderid.$secret_seed) ) {
      echo "Error! Hash mismatch";
      file_put_contents("paykeeper_error.txt",  $orderid . '-' . $key . '-' . md5($id.number_format($sum, 2, ".", "").$clientid.$orderid.$secret_seed));
      exit;
    }
    file_put_contents("paykeeper_ok.txt", "OK " . md5($id . $secret_seed));
    echo "OK " . md5($id . $secret_seed);
  }

  public function success() {
    Cart::destroy();
    return 'success';
  }

  public function fail() {
    return 'fail';
  }

  public function httplogbyid() {
    
    $user = getenv('PAYKEEPER_USER');
    $password = getenv('PAYKEEPER_PASSWORD');
    $base64 = base64_encode("$user:$password");         
    $headers = [
      'Content-Type: application/x-www-form-urlencoded',
      'Authorization: Basic '. $base64
    ]; 
    
    $server_paykeeper = getenv('PAYKEEPER_SERVER');
    
    $uri = "/info/settings/token/";
    $curl = curl_init(); 
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    $response = curl_exec($curl);      
    $php_array = json_decode($response,true);
    
    if (isset($php_array['token'])) $token=$php_array['token']; else die();
    
    $uri = "/info/httplog/byid/?id=54";
    $request = http_build_query(['token'=>$token]);              
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$request);
    $response = json_decode(curl_exec($curl),true);
    print_r($response); die;
  }

  public function paymentbyid(int $id) {
    $user = getenv('PAYKEEPER_USER');
    $password = getenv('PAYKEEPER_PASSWORD');
    $base64 = base64_encode("$user:$password");         
    $headers = [
      'Content-Type: application/x-www-form-urlencoded',
      'Authorization: Basic '. $base64
    ]; 
    
    $server_paykeeper = getenv('PAYKEEPER_SERVER');
    
    
    $uri = "/info/settings/token/";
    $curl = curl_init(); 
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    $response = curl_exec($curl);      
    $php_array = json_decode($response,true);
    
    if (isset($php_array['token'])) $token=$php_array['token']; else die();
    
    $uri = "/info/payments/byid/?advanced=true&id=" . $id;
    $request = http_build_query(['token'=>$token]);              
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$request);
    $response = json_decode(curl_exec($curl),true);
    return $response;
  }

}

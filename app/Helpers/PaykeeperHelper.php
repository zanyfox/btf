<?php

namespace App\Helpers;

class PaykeeperHelper {

  public static function getPaymentInfoById(int $id) {
    $REQUEST_URL = '/info/payments/byid/';
    $user = getenv('PAYKEEPER_USER');
    $password = getenv('PAYKEEPER_PASSWORD');
    $server = getenv('PAYKEEPER_SERVER');
    # параметры запроса
    $auth_header = array(
      'Authorization: Basic '.base64_encode("$user:$password")
    );
    
    $request_headers = array_merge($auth_header, array("Content-type: application/x-www-form-urlencoded"));
    
    $context = stream_context_create(array(
      'http' => array (
        'method' => 'GET',
        'header' => $request_headers
      )
    ));
    
    $result = json_decode(file_get_contents($server . $REQUEST_URL . "?id=" . $id, FALSE, $context), TRUE);
    return isset($result[0]) ? $result[0] : null;

  }

  // Запрос на сброс счетчика повторов для платежа
  public static function changePaymentRepeatcnt(int $id) {
    $REQUEST_URL = '/change/payment/repeatcnt/';
    $user = getenv('PAYKEEPER_USER');
    $password = getenv('PAYKEEPER_PASSWORD');
    $server = getenv('PAYKEEPER_SERVER');
    # параметры запроса
    $auth_header = array(
      'Authorization: Basic '.base64_encode("$user:$password")
    );
    
    $request_headers = array_merge($auth_header, array("Content-type: application/x-www-form-urlencoded"));
    
    $context = stream_context_create(array(
      'http' => array (
        'method' => 'GET',
        'header' => $request_headers
      )
    ));
    
    $result = json_decode(file_get_contents($server . $REQUEST_URL . "?id=" . $id, FALSE, $context), TRUE);
    return isset($result[0]) ? $result[0] : null;

  }

}
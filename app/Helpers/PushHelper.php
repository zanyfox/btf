<?php

namespace App\Helpers;

class PushHelper {
  
  public static function sendNotificationFCM($deviceKey, $title, $message, $userId, $type) {
    
    $serverKey = env('SERVER_KEY');
    $URL = 'https://fcm.googleapis.com/fcm/send';
    $postData = '{
      "to" : "' . $deviceKey . '",
      "data" : {
        "body" : "",
        "title" : "' . $title . '",
        "type" : "' . $type . '",
        "id" : "' . $userId . '",
        "message" : "' . $message . '",
      },
      "notification" : {
        "body" : "' . $message . '",
        "title" : "' . $title . '",
        "type" : "' . $type . '",
        "id" : "' . $userId . '",
        "message" : "' . $message . '",
        "icon" : "new",
        "sound" : "default"
      },
    }';
    
    $crl = curl_init();
    
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, [
      'Content-type: application/json',
      'Authorization: key=' . $serverKey
    ]);
    
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($crl);
    curl_close($crl);
    $result = $response === false ? 0 : 1;
    if (!$result) {
      throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));
    }    
    return $response;
  }
}
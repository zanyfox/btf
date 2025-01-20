<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\PushHelper;
use App\Helpers\PaykeeperHelper;



class NotificationController extends Controller {
  
  public function __construct() {
    $this->middleware('auth');
  }

  public function sendPush() {
    $fields['include_player_ids'] = ['45491de8-39d1-49d1-bdf5-5fbe650215b1'];
    $message = 'hey!! this is test push.!';
    //OneSignal::sendPush($fields, $message);
  }

  public function getNotifications() {
    //return OneSignal::getNotifications();
  }

  public function getNotification($notificationID) {
    //return OneSignal::getNotification($notificationID);
  }

  public function getDevices() {
    //return OneSignal::getDevices();
  }

  public function getDevice($deviceID) {
    // OneSignal::getDevice($deviceID);
  }

  public function index() {

    $fcmKey = env('FCM_KEY');
    $user = User::where('id', 1)->first();
    $deviceKey = $user->device_key;
    //print_r($deviceKey); die;
    return view('push', ['fcmKey' => $fcmKey]);
  }

  public function storeToken(Request $request) {
    auth()->user()->update(['device_key' => $request->token]);
    return response()->json(['Token successfully stored', $request->token]);
  }

  public function sendWebNotification(Request $request) {

    $url = 'https://fcm.googleapis.com/fcm/send';
    $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
    $serverKey = getenv('SERVER_KEY');

    $data = [
      //'registration_ids' => $FcmToken,
      // NotRegistered

      // Local Desktop Device ID
      //'registration_ids' => ['dW2fSmEuwr8NOYejD_Xh1U:APA91bHqROotCKwEemSLg7cC0B_ycOmsoCConJta0sGwLB1A93_lo9UOkTNKxNNRgKHVTDKraVlFxpR8PJ74hKqTCioAEbUPr_GYCAw904n-2GYUdI3v8LCriG7WNiFZtFlb_yMO8rrM'],
      
      // Remote Desktop Device ID
      //'registration_ids' => ['fI6nMe2Tt2TELpP1t0T3kq:APA91bHmaKYs1jEtf9EXFTP23DJ0VIY3pOvcDAthp9tpWbvxTLFNmimilGMOcg0t085a4vxd-yaQaMEaXv_BNmGYsvlaFAWjEPVuVv0plyNqxqdlXq-91QNgcS6hPXjcJkDYJjsRfKRI'],
      
      // Remote Mobile Device ID
      //'registration_ids' => ['eBg-QY53YNkDV5v8KkWuf0:APA91bHopcqIAJ2zNOYo9FrelUQJThFx8sGdX2R_FTAgyJ2l0BqgxGtF0uAWBJEoTwSA9brFPGwpr-hIUm07TTlgsJfnplECRvJ6TjEHTTrjADdxgrqFxduO5DmFf6vgYLq76j9C2kcl'],
      
      // PB Local Desktop Device ID
      //'registration_ids' => ['cOV6mXhqZQIprmydpx1jtT:APA91bHt6yV8B-ZsaDl6IocxN-jYAxb6iAaill53MESAAEOjWvGSCZ4B_lV6XJ7osH43eftSzRD1y1Vlwf-_G3swI_BRCOyOrpVgs2xltUTIaC_ZBBBjBYPycl6l0j6KpIOJK8me7TNm'],
      
      
      //'registration_ids' => ['c7JkA0PiFXdFsmX4pGah8p:APA91bGXN_t-itcY0FCLhZMwOr8SKAHXIuZ9ttI5ufrKU0PZwyub6nRXJRnZ2gNtWC4qhPfRq4kRGPJNa6749YrHo8_qHytDBGkStK2ZNKSjgyhDSwwFgSjbI_98JCEmUbELtC0PGRra'],
      
      // Evgenii Mobile Token
      //'registration_ids' => ['fW0VjvL6jdk:APA91bHtFwZUNFBxhDEHOVKNF7z-YCn_tXNvsEbJ-WwlWtV9dWbQamgWyysENrn5bMun-E7AiEEHBioDJq4lUTQdmCuPw2IIYIHPkfU6vfHB4McS7cEAL5ycSvAn9rBAvxa74nBqQ8sr'],
      
      // My Mobile DEVICE TOKEN
      //'registration_ids' => ['dsYsdPgyXt8:APA91bH4-3IBrV9Ps92wemiFb8bGSNl76P2X5Cm7pFt1TJo8gpaWhzKlnt1mAaFTSs1A-RvJTIYRSy4tGuLD8yFIYLOOgdwx_Zrz7NTrYWCFZ6qp-DwSuaUk0-EvPSboBJsQ0Iv8Ydqd'],
      'to' => 'dsYsdPgyXt8:APA91bH4-3IBrV9Ps92wemiFb8bGSNl76P2X5Cm7pFt1TJo8gpaWhzKlnt1mAaFTSs1A-RvJTIYRSy4tGuLD8yFIYLOOgdwx_Zrz7NTrYWCFZ6qp-DwSuaUk0-EvPSboBJsQ0Iv8Ydqd', // my
      //'to' => 'fW0VjvL6jdk:APA91bHtFwZUNFBxhDEHOVKNF7z-YCn_tXNvsEbJ-WwlWtV9dWbQamgWyysENrn5bMun-E7AiEEHBioDJq4lUTQdmCuPw2IIYIHPkfU6vfHB4McS7cEAL5ycSvAn9rBAvxa74nBqQ8sr',

      // Anton PM
      //'to' => 'fT5hDaZpP3E:APA91bE36VgCXXqaWGDGLp2yg4Yl8UySq-TTPNlKE7acYwdPgml9D2W5aDE6taaMlTFNQLGLmtMJLE2MZyPfYgavDFhBu0Mi6HPZ3LOSc1asXextcRw_t69wHfzx1xuF5DeFuDLg7bdE',
      "priority" => "high",
      'notification' => [
        'title' => $request->title,
        'body' => $request->body,  
        //'icon' => "https://pabeppe.ru/favicon.png"
      ],
    ];
    $encodedData = json_encode($data);

    $headers = [
      'Authorization:key=' . $serverKey,
      'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }        
    curl_close($ch);
    // FCM response
    return response()->json([$result]);
  }


  public function sendWebNotification2() {

    $url = 'https://fcm.googleapis.com/fcm/send';
    $serverKey = getenv('SERVER_KEY');

    $data = [
      //'to' => 'fW0VjvL6jdk:APA91bHtFwZUNFBxhDEHOVKNF7z-YCn_tXNvsEbJ-WwlWtV9dWbQamgWyysENrn5bMun-E7AiEEHBioDJq4lUTQdmCuPw2IIYIHPkfU6vfHB4McS7cEAL5ycSvAn9rBAvxa74nBqQ8sr',
      'to' => 'dsYsdPgyXt8:APA91bH4-3IBrV9Ps92wemiFb8bGSNl76P2X5Cm7pFt1TJo8gpaWhzKlnt1mAaFTSs1A-RvJTIYRSy4tGuLD8yFIYLOOgdwx_Zrz7NTrYWCFZ6qp-DwSuaUk0-EvPSboBJsQ0Iv8Ydqd',
      //'to' => 'fpurjPov1C8:APA91bFyzECMaWN17VzhJg42lKp7cNDOw6xiqjuCVabvRG9QXMP1-qLCvZL08DHMTspFNmHXPV3IegVLp_AQtI4nUKUmAOzSw4Og84GenuYELd3Wu0iiyAT5DFUhj5xeDCzN4WRGwAtL',
      'notification' => [
        'title' => 'Test2',
        'body' => 'Test3'
      ],
    ];
    $encodedData = json_encode($data);

    $headers = [
      'Authorization:key=' . $serverKey,
      'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);        
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }        
    curl_close($ch);
    return response()->json([$result]);
  }

  public function notifyUser(Request $request) {
    $user = User::where('id', $request->id)->first();
    $deviceKey = $user->device_key;
    $title = 'Greeting Notification';
    $message = 'Have good day!';
    $type = 'basic';

    $result = PushHelper::sendNotificationFCM($deviceKey, $title, $message, $user->id, $type);
    return response()->json([
      'status' => 'test',
      'data' => $result,
    ]);
    
    print_r($result); die;
    if($result == 1){
      // success code
    }else{
      // fail code
    } 
  }

}
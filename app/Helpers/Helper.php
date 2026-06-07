<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;
use App\Models\Page;
use App\Models\Order;
use App\Models\Setting;
use illuminate\Support\Facades\Cache;

class Helper {

  public function setting($key) {
    $settings = Cache::rememberForever('settings', function () {
      return Setting::pluck('value','key')->all();
    });
    return $settings[$key] ?? false;
  }

  public static function staticPages() {
    $pages = cache()->remember('helper.staticPages', now()->addDays(30), function() {
      return Page::orderBy('sort','ASC')->orderBy('id','ASC')->where(['status' => true, 'lang'=>'ru'])->get();
    });
    return $pages;
  }

  public static function orderEmail($orderId) {
    $order = Order::where('id', $orderId)->with('items')->first();


    if($order->email) {

      $data = [
        'subject' => __('app.ThanksForYourOrder'),
        'order' => $order
      ];

      Mail::to($order->email)->send(new OrderEmail($data));
    }
    return $order;
  }

  /**
   * https://snipp.ru/php/phone-format
   */
  static function phone_format($phone) {
    $phone = trim($phone);
    $res = preg_replace(
      [
        '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
        '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
        '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
        '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
        '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
        '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
      ],
      [
        '+7 ($2) $3-$4-$5',
        '+7 ($2) $3-$4-$5',
        '+7 ($2) $3-$4-$5',
        '+7 ($2) $3-$4-$5',
        '+7 $2 $3-$4',
        '+7 $2 $3-$4',
      ],
      $phone
    );
    return $res;
  }

  static function region_phone_format($phone) {

    // +7 4012 313-142
    //$pattetn = '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/';
    //return preg_replace($pattetn, '+7 $2 $3-$4', trim($phone));

    $pattetn = '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/';
    return preg_replace($pattetn, '+7 ($2) $3-$4-$5', trim($phone));

  }

}

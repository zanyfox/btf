<?php

namespace App\Services;
use Carbon\Carbon;
use App\Models\Currency;

class CurrencyConversion {

  const DEFAULT_CURRENCY_CODE = 'RUB';

  protected static $container;

  public static function loadContainer() {
    if(is_null(self::$container)) {
      $currencies = Currency::get();
      foreach($currencies as $currency) {
        self::$container[$currency->code] = $currency;
      }
    }
  }

  public static function getCurrencyFromSession() {
    return session('currency', self::DEFAULT_CURRENCY_CODE);
  }

  public static function getCurrentCurrencyFromSession() {
    self::loadContainer();
    $currencyCode = self::getCurrencyFromSession();
    foreach( self::$container as $currency ) {
      if($currency->code == $currencyCode  ) {
        return $currency;
      }
    }
  }

  public static function getCurrencies() {
    return self::$container;
  }

  public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null) {

    self::loadContainer();
    $originCurrency = self::$container[$originCurrencyCode];

    if(is_null($targetCurrencyCode)) {
      $targetCurrencyCode = self::getCurrencyFromSession(); // session('currency', 'RUB');
    }
    $targetCurrency = self::$container[$targetCurrencyCode];

    return $sum / $originCurrency->rate * $targetCurrency->rate;
    
  }

  public static function getCurrencySymbol() {
    self::loadContainer();
    $currencyCode = self::getCurrencyFromSession(); // session('currency', self::DEFAULT_CURRENCY_CODE);
    $currency = self::$container[$currencyCode];
    return $currency->code == self::DEFAULT_CURRENCY_CODE ? 'р.' : $currency->symbol;
  }

  public static function getBaseCurrency() {
    self::loadContainer();
    foreach(self::$container as $code => $currency) {
      if($currency->isMain()) {
        return $currency;
      }
    }
  }

}
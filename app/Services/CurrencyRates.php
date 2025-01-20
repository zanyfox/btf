<?php

namespace App\Services;

use App\Models\Currency;
use Exception;
use GuzzleHttp\Client;

class CurrencyRates {

  public static function getRates() {

    $baseCurrency = CurrencyConversion::getBaseCurrency();
    $url = config('currency_rates.api_url') . '?apikey=' . config('currency_rates.apikey') . '&base_currency=' . $baseCurrency->code . '&currencies=USD,EUR,RUB';
    $client = new Client();
    $response = $client->request('GET', $url);
    if($response->getStatusCode() != 200) {
      throw new Exception('There is a problem with currency rate service');
    }
    $decoded = json_decode($response->getBody()->getContents(), true);
    $rates = $decoded['data'];
    foreach (CurrencyConversion::getCurrencies() as $currency) {
      if(!$currency->isMain()) {
        if(!isset($rates[$currency->code])) {
          throw new Exception('There is a problem with currency ' . $currency->code);
        } else {
          $currency->update(['rate' => $rates[$currency->code]['value']]);
          $currency->touch();
        }
      }
    }
  }

}
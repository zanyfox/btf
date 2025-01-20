<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Services\CurrencyConversion;

class CurrenciesComposer {
  public function compose(View $view) {

    $currencySymbol = CurrencyConversion::getCurrencySymbol();
    $currencies = CurrencyConversion::getCurrencies();
    $view->with('currencySymbol', $currencySymbol)->with('currencies', $currencies);

  }
}
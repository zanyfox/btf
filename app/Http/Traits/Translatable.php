<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\App;

trait Translatable {

  protected $defaultLocale = 'ru';

  public function __($fieldName) {
    $locale = App::getLocale() ?? $this->defaultLocale;
    if( $locale === 'en' ) $fieldName .= '_en';
    return isset($this->attributes[$fieldName]) ? $this->attributes[$fieldName] : null;
  }

}
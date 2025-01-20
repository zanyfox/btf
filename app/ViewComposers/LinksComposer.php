<?php

namespace App\ViewComposers;

//use App\Models\Category;
use Illuminate\View\View;

class LinksComposer {

  protected $links;

  //public function __construct(Category $links) {
  public function __construct() {
    // set repository
    $this->links = [
      ['name' => 'nvrh.ru', 'url' => 'https://nvrh.ru', 'target' => '_blank'],
      ['name' => 'hartmanhotel.ru', 'url' => 'https://hartmanhotel.ru', 'target' => '_blank'],
      ['name' => 'alterdoktor.ru', 'url' => 'https://alterdoktor.ru', 'target' => '_blank'],
    ];
  }

  public function compose(View $view) {
    $view->with('links', $this->links);
  }
}
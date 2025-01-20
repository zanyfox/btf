<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component {

  public $name;

  /**
   * Create new a component instance
   * 
   * @return void
   */
  public function __construct($name) {
    $this->name = $name;
  }

  /**
   * Get the view / contents that represents the component.
   */
  public function render(): View {
    return view('components.card');
  }
}

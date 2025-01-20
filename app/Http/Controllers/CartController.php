<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Good;

class CartController extends Controller {

  public function index() {

    $cartContent = Cart::content();
    
      
    //dd(Cart::content());
    // Cart::content()->count() 

    /* $minDate = Carbon::today();
    $maxDate = Carbon::now()->addWeek();
    $userCart = DB::select('SELECT * FROM cart WHERE user_id = ? LIMIT 1', [auth()->user()->id]);
    return view('cart/index', [
      'cart' => $userCart
    ]); */


    //print_r(Cart::content()); die;

    $cartModifiersTotalSum = 0;

    if(Cart::count() > 0) {
      $html = '<div class="cart-fullfilled">
      <div class="cart-fullfilled-header">
        <h4>Ваш заказ</h4>
        <p class="text-grey">доставим за 60 мин</p>
        <button type="button" class="btnDestroyCart">
          <i class="icon icon-trash"></i>
        </button>
      </div>';
      $html .= '<div class="cart-fullfilled-body">
        <div class="cards-container">';
          foreach($cartContent as $item) {
            $html .= '<div class="card in-cart" id="sidebarCartItem' . $item->rowId . '">
              <div class="card-header">
                <a href="javascript:void(0)" class="card-image">';
                if($item->options->picture) {
                  $html .= '<img src="' . asset('uploads/goods/small/' . $item->options->picture->path) . '" alt="' . $item->name . '">';
                } else {
                  $html .= '<img src="https://placehold.co/387x326/EEE/002157?font=montserrat&text=' . env('APP_NAME') . '" alt="' . $item->name . '">';
                }
                $html .= '</a>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="card-title">
                    <h4>' . $item->name . '</h4>
                  </div>
                  <p>' . $item->options->excerpt . '</p>
                  <p>' . round($item->options->weight * 1000) . 'г.</p>';

                  if($item->options->color) {
                    $html .= '<p>   Цвет: ' . $item->options->color . '</p>';
                  }
                  
                  if($item->options->modifiersSum > 0) {

                    $cartModifiersTotalSum += $item->options->modifiersSum * $item->qty;

                    foreach ($item->options->modifiers as $modifier) {
                      $html .= '<div class="cart-item-modfiers-list">
                        <h6>Добавлен</h6>
                        <div class="cart-item-modfier">
                          <div>' . $modifier->name . '</div>
                          <div>' . $modifier->price . ' р.</div>
                        </div>
                      </div>';
                    }
                  }

                $html .= '</div>
                <div class="card-footer">';
                if($item->options->modifiersSum) {
                  $html .= '<p class="wrapper-price"><span id="cartGoodSum' . $item->rowId . '">' . ($item->price + $item->options->modifiersSum) * $item->qty . '</span><small>р.</small></p>';
                } else {
                  $html .= '<p class="wrapper-price"><span id="cartGoodSum' . $item->rowId . '">' . $item->price * $item->qty . '</span><small>р.</small></p>';
                }
                $html .= '<div>
                    <div class="wrapper-quantity-input">
                      <button class="btn-quantity-input btnChangeQty" data-dir="down" data-rowid="' . $item->rowId . '">-</button>
                      <input type="number" value="' . $item->qty . '" class="quantity-input number-spinner" data-rowid="' . $item->rowId . '" min="1" max="99">
                      <button class="btn-quantity-input btnChangeQty" data-dir="up" data-rowid="' . $item->rowId . '">+</button>
                    </div>
                  </div>
                  <button type="button" class="btn-link btnRemoveFromCart" data-rowid="' . $item->rowId . '">
                    <i class="icon icon-trash"></i>
                  </button>
                </div>
              </div>
            </div>';
          }
        $html .= '</div>';

        $cartRelatedGoodsHtml = '<div>
        <h4>похожие позиции</h4>
        <div class="grid-container">
          <div class="grid-item">
            <div class="card">
              <div class="card-header">
                <a href="#" class="card-image">
                  <img src="/assets/img/card-image.jpg" alt="пицца «Маргарита»">
                </a>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <h5>пицца</h5>
                  <h4>«Маргарита»</h4>
                  <p>моцарелла/ томатный соус/ базилик</p>
                </div>
                <div class="card-footer">
                  <p class="wrapper-price"><span>480</span><small>р.</small></p>
                  <div>
                    <button type="button" class="btn-link addToCart">
                      <i class="icon icon-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';

      $cartFooterHtml = '<div class="cart-fullfilled">
        <div class="cart-fullfilled-footer">
          <form>
            <div class="form-group">
              <div class="form-group-append">';
      if(Session::has('discount')) {
        $cartFooterHtml .= '<input type="text" name="discountcode" value="' . Session::get('discount')->code . '" class="form-control inputCoupon" placeholder="Введите промокод">
          <button type="button" class="btn btn-cancel btnRemoveCoupon">Отменить</button>';
      } else {
        $cartFooterHtml .= '<input type="text" name="discountcode" class="form-control inputCoupon" placeholder="Введите промокод">';
      }

      $subtotal = Cart::subtotal(0, '.', '');
      $cartTotalSum = $subtotal + $cartModifiersTotalSum;

      $cartFooterHtml .= '</div><span class="text-danger invalid-feedback discountcodeMessage"></span></div>
            <div class="flex">
              <p class="cart-price">к оплате: <span id="cartFooterTotalPrice">' . $cartTotalSum . ' </span><small>р.</small></p>
              <button type="submit" class="btn btn-primary btnOpenCheckout">Оформить</button>
            </div>
          </form>
        </div>
      </div>';

      $html .= $cartFooterHtml;

    } else {
      $html = '<div class="cart-empty">
        <h4>Ваша корзина пуста</h4>
        <p>Добавьте блюда и возвращайтесь!</p>
        <img src="' . asset('assets/img/empty-cart.svg') . '" alt="No Cart Items available" title="No Items in cart to checkout">
        <button type="button" class="btn btn-primary btnCloseCart">Вернуться в меню</button>
      </div>';
    }
    return $html;
  }

  public function add(Request $request) {

    $goodId = (int)$request->id;
    $good = Good::with('pictures')->find($goodId);

    if(is_null($good)) {
      return response()->json([
        'status' => 'fail',
        'message' => __('app.GoodNotFound')
      ]);
    }

    if(isset($request->modifiers) && !empty($request->modifiers) && is_array($request->modifiers)) {
      $modifiersId = (array)$request->modifiers;
      $modifiersSum = 0;
      $modifiers = Good::select('id','name','price','external_id')->whereIn('id', $modifiersId)->where('type','Modifier')->get();
      if($modifiers) {
        foreach ($modifiers as $modifier) {
          $modifiersSum += $modifier->price;
        }
      }
    }

    /* return response()->json([
      'status' => 'test',
      'message' => $modifiersSum
    ]); */

    /* if( !$good->status ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('app.OutOfStock')
      ]);
    } */

    $quantity = (int)$request->quantity ?? 1;
    $goodPicture = $good->pictures->first();
    $goodWeight = null;
    $goodFeatures = DB::select('SELECT * FROM features AS f JOIN feature_good AS fg ON f.id = fg.feature_id WHERE fg.good_id=? AND f.slug=?', [$good->id,'weight']);
    if(isset($goodFeatures[0]->value)) {
      $goodWeight = $goodFeatures[0]->value;
    }

    /* CHECK CART ITEM ALREADY */
    $cartContent = Cart::content();
    $alreadyInCart = false;
    foreach($cartContent as $item) {
      if($item->id == $goodId) {
        $alreadyInCart = true;
      }
    }
    if($alreadyInCart) {
      return response()->json([
        'status' => 'fail',
        'count' => Cart::count(),
        'message' => 'Товар уже лежит в корзине'
      ]);
    }

    Cart::add($goodId, $good->name, $quantity, $good->price, [
      'picture' => $goodPicture, 
      'external_id' => $good->external_id,
      'excerpt' => $good->excerpt,
      'weight' => $goodWeight,
      'modifiers' => isset($modifiers) ? $modifiers : null,
      'modifiersSum' => isset($modifiersSum) ? $modifiersSum : 0,
    ]);

    $rowId = null;
    $qty = 0;
    $goodRows = Cart::content()->where('id', $goodId);
    foreach ($goodRows as $row) {
      $rowId = $row->rowId;
      $qty = $row->qty;
    }

    return response()->json([
      'status' => 'success',
      'count' => Cart::count(),
      'rowId' => $rowId,
      'qty' => $qty,
      'message' => 'Блюдо <span class="text-success">добавлено</span> в корзину!'
    ]);

  }

  public function update(Request $request) {
    $rowId = $request->rowId;
    $qty = $request->qty;

    // Check quantity available in stock 
    $cartItem = Cart::get($rowId);

    $cartItemModifiersSum = 0;
    $cartItemModifiers = $cartItem->options->modifiers;
    if(count($cartItemModifiers) > 0) {
      foreach($cartItemModifiers as $cartItemModifier) {
        $cartItemModifiersSum += $cartItemModifier->price;
      }
    }

    $good = Good::find($cartItem->id);

    if($good->track_qty == 'Y') {

      if( $good->quantity < $qty ) {

        $cartModifiersTotalSum = $this->getCartModifiersTotalSum();

        return response()->json([
          'status' => 'fail',
          'count' => Cart::count(),
          'subtotal' => Cart::subtotal(0, '.', ''),
          'goodSum' => ($good->price + $cartItemModifiersSum) * $qty,
          'cartItemModifiersSum' => $cartItemModifiersSum,
          'cartModifiersTotalSum' => $cartModifiersTotalSum,
          'rowId' => $request->rowId,
          'message' => 'Request quantity ' . $qty . ' not available in stock'
        ]);

      }

    }

    Cart::update($rowId, $qty);

    $cartModifiersTotalSum = $this->getCartModifiersTotalSum();
    
    return response()->json([
      'status' => 'success',
      'count' => Cart::count(),
      'rowId' => $rowId,
      'subtotal' => Cart::subtotal(0, '.', ''),
      //'goodSum' => $good->price * $qty,
      'goodSum' => ($good->price + $cartItemModifiersSum) * $qty,
      'cartItemModifiersSum' => $cartItemModifiersSum,
      'cartModifiersTotalSum' => $cartModifiersTotalSum,
      'message' => __('app.CartUpdatedSuccessfully')
    ]);
  }

  /* REMOVE CART ITEM */
  public function remove(Request $request) {

    $rowId = $request->rowId;
    $cartItem = Cart::get($rowId);

    if(!$cartItem) {
      return response()->json([
        'status' => 'fail',
        'count' => Cart::count(),
        'message' => __('app.CartItemNotFound')
      ]);
    }

    Cart::remove($rowId);

    $cartModifiersTotalSum = $this->getCartModifiersTotalSum();
    
    return response()->json([
      'status' => 'success',
      'subtotal' => Cart::subtotal(0, '.', ''),
      'cartModifiersTotalSum' => $cartModifiersTotalSum,
      'count' => Cart::count(),
      'itemId' => $cartItem->id,
      'message' => 'Блюдо <span class="text-danger">удалено</span> из корзины!'
    ]);

  }

  /* CART DESTROY */
  public function destroy() {
    Cart::destroy();
    return response()->json([
      'status' => 'success',
      'message' => __('app.CartCompletelyCleared')
    ]);
  }

  public function schedule() {
    $setting = \App\Models\Setting::find(14);
    return response()->json([
      'status' => 'success',
      'currentTime' => date('H:i:s'),
      'currentDay' => date('l'),
      'schedule' => $setting->value
    ]);
  }

  public function getCartModifiersTotalSum() {
    $cartContent = Cart::content();
    $cartModifiersTotalSum = 0;
    if(Cart::count() > 0) {
      foreach($cartContent as $item) {
        if($item->options->modifiersSum > 0) {
          $cartModifiersTotalSum += $item->options->modifiersSum * $item->qty;
        }
      }
    }
    return $cartModifiersTotalSum;
  }

}

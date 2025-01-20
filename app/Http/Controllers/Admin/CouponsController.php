<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponsController extends Controller {

  public function index() {
    $coupons = Coupon::all();
    return view('admin.coupons.index', compact('coupons'));
  }

  public function create() {
    $currencies = [['id' => 1, 'name' => 'RUB']];
    return view('admin.coupons.create', compact('currencies'));
  }

  public function store(CouponRequest $request) {
    $request->validate();
    $params = $request->except(['_token']);
    foreach(['status','only_once'] as $fieldName) {
      if( isset($params[$fieldName]) ) {
        $params[$fieldName] = 1;
      } else {
        $params[$fieldName] = 0;
      }
    }

    if($request->has('type') && $request->type == 'percent') {
      unset($params['currency_id']);
    }

    Coupon::create($params);
    return to_route('admin.coupons.index')->with('success', __('admin.NewRecordHasBeenCreated'));
  }

  public function changestatus($id) {
    $coupon = Coupon::find($id);
    $coupon->status = !$coupon->status;
    $coupon->save();
    return to_route('admin.coupons.index')->with('success', 'Coupon status has been changed');
  }

  public function edit(Coupon $coupon) {
    $currencies = [['id' => 1, 'name' => 'RUB']];
    return view('admin.coupons.edit', compact('coupon','currencies'));
  }

  public function update(CouponRequest $request, Coupon $coupon) {
    $request->validate();
    $params = $request->except(['_token','_method']);
    foreach(['status','only_once'] as $fieldName) {
      if( isset($params[$fieldName]) ) {
        $params[$fieldName] = 1;
      } else {
        $params[$fieldName] = 0;
      }
    }

    if($request->has('type') && $request->type == 'percent') {
      $params['currency_id'] = null;
    }

    $coupon->update($params);
    return to_route('admin.coupons.index')->with('success', __('admin.RecordHasBeenUpdated'));
  }

  public function destroy($id) {
    $coupon = Coupon::find($id);
    $coupon->delete();
    return to_route('admin.coupons.index')->with('success', __('admin.RecordHasBeenDeleted'));
  }

}

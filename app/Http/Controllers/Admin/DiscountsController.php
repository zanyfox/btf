<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Discount;

class DiscountsController extends Controller {

  public function index() {
    return view('admin.discounts.index', [
      'discounts' => Discount::all()
    ]);
  }

  public function create() {
    return view('admin.discounts.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'code' => 'required',
      'discount_amount' => 'required|numeric'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    if(!empty($request->starts_at)) {
      $now = Carbon::now()->format('Y-m-d');
      $startsAt = Carbon::createFromFormat('Y-m-d', $request->starts_at);
      if( $startsAt->lte($now) ) {
        return response()->json([
          'status' => 'fail',
          'errors' => ['starts_at' => __('admin.StartDateCanNotBeLessThanCurrentTime')]
        ]);
      }
    }

    if(!empty($request->starts_at) && !empty($request->expires_at)) {
      $startsAt = Carbon::createFromFormat('Y-m-d', $request->starts_at);
      $expiresAt = Carbon::createFromFormat('Y-m-d', $request->expires_at);
      if( !$expiresAt->gt($startsAt) ) {
        return response()->json([
          'status' => 'fail',
          'errors' => ['expires_at' => __('admin.ExpireDateCanNotBeLessThanStartDate')]
        ]);
      }
    }
    
    Discount::create([
      'code' => $request->code,
      'name' => $request->name,
      'description' => $request->description,
      'max_uses' => $request->max_uses,
      'max_uses_user' => $request->max_uses_user,
      'type' => $request->type,
      'discount_amount' => $request->discount_amount,
      'min_amount' => $request->min_amount,
      'status' => $request->status == 'on' ? true : false,
      'starts_at' => $request->starts_at,
      'expires_at' => $request->expires_at,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    session()->flash('success', __('admin.DiscountSavedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.DiscountSavedSuccessfully')
    ]);
  }

  public function edit(Discount $discount) {
    return view('admin.discounts.edit', compact('discount'));
  }

  public function update(Request $request, Discount $discount) {

    $validator = Validator::make($request->all(), [
      'code' => 'required',
      'discount_amount' => 'required|numeric'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    if(!empty($request->starts_at)) {
      $now = Carbon::now()->format('Y-m-d');
      $startsAt = Carbon::createFromFormat('Y-m-d', $request->starts_at);
      if( $startsAt->lte($now) ) {
        return response()->json([
          'status' => 'fail',
          'errors' => ['starts_at' => __('admin.StartDateCanNotBeLessThanCurrentTime')]
        ]);
      }
    }

    if(!empty($request->starts_at) && !empty($request->expires_at)) {
      $startsAt = Carbon::createFromFormat('Y-m-d', $request->starts_at);
      $expiresAt = Carbon::createFromFormat('Y-m-d', $request->expires_at);
      if( !$expiresAt->gt($startsAt) ) {
        return response()->json([
          'status' => 'fail',
          'errors' => ['expires_at' => __('admin.ExpireDateCanNotBeLessThanStartDate')]
        ]);
      }
    }

    $discount->update([
      'code' => $request->code,
      'name' => $request->name,
      'description' => $request->description,
      'max_uses' => $request->max_uses,
      'max_uses_user' => $request->max_uses_user,
      'type' => $request->type,
      'discount_amount' => $request->discount_amount,
      'min_amount' => $request->min_amount,
      'status' => $request->status == 'on' ? true : false,
      'starts_at' => $request->starts_at,
      'expires_at' => $request->expires_at,
      'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    session()->flash('success', __('admin.DiscountUpdatedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.DiscountUpdatedSuccessfully')
    ]);

  }

  public function destroy(Discount $discount) {
    $discount->delete();
    //$discount->orders
    session()->flash('success', __('admin.DiscountDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.DiscountDeletedSuccessfully')
    ]);
  }

}

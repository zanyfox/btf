<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;

class PaymentMethodsController extends Controller {

  public function __construct() {
    //$this->middleware('auth:admin');
    //$this->middleware(['role:super-admin|admin', 'permission:publish-payment-methods|edit-payment-methods']);
    $this->middleware('permission:view payment methods', ['only' => ['index']]);
    $this->middleware('permission:create payment method', ['only' => ['create', 'store']]);
    $this->middleware('permission:update payment method', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete payment method', ['only' => ['destroy']]);
  }

  public function index() {
    // Retrieving All Rows from a Table
    $paymentMethods = DB::table('payment_methods')
                          ->select('id','name','code','external_id','sort','created_at')
                          ->orderBy('id', 'ASC')->get();
    /* $paymentMethodsCount = DB::table('payment_methods')->count();
    $paymentMethodsMaxSort = DB::table('payment_methods')->max('sort');
    $paymentMethodsMinSort = DB::table('payment_methods')->min('sort'); */
    /* DB::table('payment_methods')->orderBy('id', 'ASC')->chunk(2, function($paymentMethods) {
      foreach($paymentMethods as $paymentMethod) {
        echo $paymentMethod->name;
      }
    }); */
    return view('admin.payment-methods.index', [
      'paymentMethods' => $paymentMethods
    ]); 
  }

  public function create() {
    return view('admin.payment-methods.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2|max:100',
      'code' => ['required','string','min:3','max:4',new Uppercase, function($attribute,$value,$fail) {
        if($value == 'BNS') {
          $fail('The ' . $attribute . ' is invalid');
        }
      }]
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    //DB::table('payment_methods')->insertOrIgnore([
    //DB::table('payment_methods')->insertGetId([
    DB::table('payment_methods')->insert([
      'name' => $request->name,
      'code' => $request->code,
      'external_id' => $request->external_id,
      'description' => $request->description,
      'status' => $request->status == 'on' ? true : false,
      'sort' => $request->sort
    ]);

    session()->flash('success', __('admin.RecordCreatedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordSavedSuccessfully')
    ]);

  }

  public function edit($id) {

    // Determining If Records Exist
    //if( !DB::table('payment_methods')->where('id', $id)->exists() ) {
    if( DB::table('payment_methods')->where('id', $id)->doesntExist() ) {
      abort(404);
    }

    $paymentMethod = DB::table('payment_methods')->find($id);
    //$paymentMethod = DB::table('payment_methods')->where('id', $id)->first();
    //$paymentMethod = DB::table('payment_methods')->where('id', $id)->value('code');
    return view('admin.payment-methods.edit', [
      'paymentMethod' => $paymentMethod
    ]);

  }

  public function update(Request $request, $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2|max:100',
      'code' => ['required','string','min:3','max:4',new Uppercase,function($attribute,$value,$fail) {
        if($value == 'BNS') {
          $fail('The ' . $attribute . ' is invalid');
        }
      }]
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    /* DB::table('payment_methods')->where('id', $id)->updateOrInsert([
      ['code' => 'CASH'],
      [
        'name' => $request->name,
        'code' => $request->code,
        'external_id' => $request->external_id,
        'description' => $request->description,
        'status' => $request->status == 'on' ? true : false,
        'sort' => $request->sort
      ]
    ]); */

    $affected = DB::table('payment_methods')->where('id', $id)->update([
      'name' => $request->name,
      'code' => $request->code,
      'external_id' => $request->external_id,
      'description' => $request->description,
      'status' => $request->status == 'on' ? true : false,
      'sort' => $request->sort
    ]);
    
    session()->flash('success', __('admin.RecordUpdatedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]);

  }

  public function destroy($id) {

    $this->middleware('role_or_permission:super-admin|delete payment method');

    DB::table('payment_methods')->where('id', $id)->delete();

    //DB::table('payment_methods')->truncate();

    session()->flash('success', __('admin.RecordDeletedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
  }
}

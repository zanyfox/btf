<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Rubric;

class RubricsController extends Controller {

  public function index() {
    return response()->json([
      'status' => 'success',
      'rubrics' => Rubric::all()
    ]);
  }

  public function create() {
    return view('admin.rubrics.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required|min:5',
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    $rubric = new Rubric();
    $rubric->name = $request->name;
    $rubric->slug = $request->slug;
    $rubric->lang = $request->lang;
    $rubric->status = $request->status;
    $rubric->save();

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
      'name' => 'required|min:5|max:100',
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
    Rubric::destroy($id);
    return response()->noContent();
  }
}

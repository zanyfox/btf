<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DeliveryMethodsController extends Controller {

  public function index() {
    $deliveryMethods = DB::select('SELECT * FROM delivery_methods');
    return view('admin.delivery-methods.index', [
      'deliveryMethods' => $deliveryMethods
    ]); 
  }

  public function create() {
    return view('admin.delivery-methods.create');
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'code' => 'required',
      'amount' => 'required|numeric'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    session()->flash('success', __('admin.RecordSavedSuccessfully'));

    DB::insert('INSERT INTO delivery_methods (name, code, external_id, amount, status, sort) values(:name, :code, :external_id, :amount, :status, :sort)', [
      'name' => $request->name, 
      'code' => $request->code, 
      'external_id' => $request->external_id,
      'amount' => $request->amount,
      'status' => $request->status,
      'sort' => $request->sort
    ]);

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordSavedSuccessfully')
    ]);

  }

  public function edit($id) {
    $deliveryMethod = DB::select('SELECT * FROM delivery_methods WHERE id=:id', ['id' => $id]);
    return view('admin.delivery-methods.edit', [
      'deliveryMethod' => isset($deliveryMethod[0]) ? $deliveryMethod[0] : null
    ]);
  }

  public function update(Request $request, $id) {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'code' => 'required',
      'amount' => 'required|numeric'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'errors' => $validator->errors()
      ]);
    }

    DB::update('UPDATE delivery_methods SET name=:name, code=:code, external_id=:external_id, amount=:amount, status=:status, sort=:sort WHERE id=:id', [
      'id' => $id, 
      'name' => $request->name, 
      'code' => $request->code, 
      'external_id' => $request->external_id,
      'amount' => $request->amount,
      'status' => $request->status,
      'sort' => $request->sort
    ]);
    
    session()->flash('success', __('admin.RecordUpdatedSuccessfully'));

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]);
  }

  public function destroy($id) {
    DB::delete('DELETE FROM delivery_methods WHERE id=:id', ['id' => $id]);
    session()->flash('success', __('admin.RecordDeletedSuccessfully'));
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
  }

}

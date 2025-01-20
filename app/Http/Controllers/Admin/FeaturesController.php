<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class FeaturesController extends Controller {

  public function index() {

    return view('admin.features.index');
  }

  public function load() {
    return response()->json([
      'status' => 'success',
      'features' => Feature::all(),
    ]);
  }

  public function details($id) {
    return Feature::find($id);
  }

  public function store(Request $request) {
    $feature = new Feature([
      'name' => $request->name,
      'slug' => $request->slug,
      'unit' => $request->unit,
      'group' => $request->group,
      'lang' => $request->lang,
      'order_by' => $request->order_by,
      'status' => $request->status
    ]);
    $result = $feature->save();
    return response()->json([
      'status' => 'success',
      'result' => $result
    ]);
  }

  public function update(Request $request, $id) {

    $result = Feature::where('id',$id)->update([
      'name' => $request->name,
      'slug' => $request->slug,
      'unit' => $request->unit,
      'group' => $request->group,
      'lang' => $request->lang,
      'order_by' => $request->order_by,
      'status' => $request->status
    ]);

    return response()->json([
      'status' => 'success',
      'result' => $result
    ]);

  }

  public function destroy($id) {
    $result = Feature::where('id', $id)->delete();
    return response()->json([
      'status' => 'success',
      'result' => $result
    ]);
  }
  
}

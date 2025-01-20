<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller {

  public function index() {
    return view('admin.settings.index');
  }

  public function store(Request $request) {
    $setting = new Setting([
      'name' => $request->input('name'),
      'key' => $request->input('key'),
      'value' => $request->input('value'),
      'lang' => $request->input('lang'),
      'status' => (boolean)$request->input('status')
    ]);
    $result = $setting->save();
    cache()->forget('settings');
    return response()->json($result);
  }

  public function show($id) {
    $setting = Setting::find($id);
    return response()->json($setting);
  }

  public function load() {
    return response()->json(Setting::all());
  }

  public function update(Request $request, $id) {

    
    $values = [];
    if($request->input('name') && !empty($request->input('name'))) {
      $values['name'] = $request->input('name');
    }
    if($request->input('key') && !empty($request->input('key'))) {
      $values['key'] = $request->input('key');
    }
    if($request->input('value') && !empty($request->input('value'))) {
      $values['value'] = $request->input('value');
    }
    if($request->input('lang') && !empty($request->input('lang'))) {
      $values['lang'] = $request->input('lang');
    }
    if($request->input('status') && !empty($request->input('status'))) {
      $values['status'] = (boolean)$request->input('status');
    }

    $result = Setting::where('id',$id)->update($values);
    cache()->forget('settings');
    return response()->json($result);
  }

  public function delete($id) {
    $result = Setting::where('id', $id)->delete();
    cache()->forget('settings');
    return response()->json($result);
  }
}

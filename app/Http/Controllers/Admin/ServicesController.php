<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Cocur\Slugify\Slugify;
use Storage;

class ServicesController extends Controller {

  public function index() {
    return view('admin.services.index', [
      'services' => Service::all()
    ]);
  }

  public function create() {
    $services = Service::all();
    return view('admin.services.create', [
      'services' => $services
    ]);
  }

  public function store(Request $request) {

    $request->validate([
      'name' => 'required|string'
    ]);

    $service = new Service;

    $service->metatitle = $request->input('metatitle');
    $service->keywords = $request->input('keywords');
    $service->description = $request->input('description');
    $service->robots = $request->input('robots');
    $service->name = $request->input('name');

    if(empty($request->input('slug'))) {
      $slugify = new Slugify();
      $service->slug = $slugify->slugify($request->input('name'));
    } else {
      $service->slug = $request->input('slug');
    }

    $service->tagline = $request->input('tagline');
    $service->body = $request->input('body');

    $custom = $request->input('custom');
    if(!empty($custom)) {
      $custom_encoded = json_encode($custom, JSON_UNESCAPED_UNICODE);
    }

    $service->custom = isset($custom_encoded) ? $custom_encoded : '';
    $service->lang = $request->input('lang') ?? 'ru';
    $service->parent_id = $request->input('parent_id');
    $service->order_by = $request->input('order_by') ? (int)$request->input('order_by') : 1;
    $service->price = $request->input('price');
    $service->status = boolval($request->input('status'));

    if($request->hasFile('cover')) {
      $file = $request->file('cover')->store('services/cover', 'public');
      $service->cover = $file;
    }      

    if($request->hasFile('picture')) {
      $file = $request->file('picture')->store('services', 'public');
      $service->picture = $file;
    }

    $service->save();

    return redirect('/admin/services')->with('success', __('admin.RecordHasBeenAdded'));

  }

  public function edit(int $id) {
    $service = Service::findOrFail($id);
    return view('admin.services.edit', [
      'services' => Service::all(),
      'service' => $service
    ]);
  }

  public function update(Request $request, int $id) {

    $request->validate([
      'name' => 'required|string'
    ]);

    $service = Service::find($id);

    $service->metatitle = $request->input('metatitle');
    $service->keywords = $request->input('keywords');
    $service->description = $request->input('description');
    $service->robots = $request->input('robots');
    $service->name = $request->input('name');

    if(empty($request->input('slug'))) {
      $slugify = new Slugify();
      $service->slug = $slugify->slugify($request->input('name'));
    } else {
      $service->slug = $request->input('slug');
    }

    $service->tagline = $request->input('tagline');
    $service->body = $request->input('body');

    $custom = $request->input('custom');
    if(!empty($custom)) {
      $custom_encoded = json_encode($custom, JSON_UNESCAPED_UNICODE);
    }

    $service->custom = isset($custom_encoded) ? $custom_encoded : '';
    $service->lang = $request->input('lang') ?? 'ru';
    $service->parent_id = $request->input('parent_id');
    $service->order_by = $request->input('order_by') ? (int)$request->input('order_by') : 1;
    $service->price = $request->input('price');
    $service->status = boolval($request->input('status'));

    if($request->hasFile('cover')) {
      $file = $request->file('cover')->store('services/cover', 'public');
      $service->cover = $file;
    }      

    if($request->hasFile('picture')) {
      $file = $request->file('picture')->store('services', 'public');
      $service->picture = $file;
    }

    $service->save();

    return redirect('/admin/services')->with('success', __('admin.RecordUpdatedSuccessfully'));

  }

  public function destroy(int $id) {
    Color::find($id)->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
    
  }

}

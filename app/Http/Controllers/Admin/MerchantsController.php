<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantsController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $merchants = Merchant::paginate(10);
    return view('admin.merchants.index')->with('merchants', $merchants);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('admin.merchants.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $result = Merchant::create([
      'name' => $request->name,
      'email' => $request->email,
      'status' => (bool)$request->status
    ]);
    return redirect('/admin/merchants');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Merchant  $merchant
   * @return \Illuminate\Http\Response
   */
  public function show(Merchant $merchant) {
    return view('admin.merchants.show')->with('merchant', $merchant);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Merchant  $merchant
   * @return \Illuminate\Http\Response
   */
  public function edit(Merchant $merchant) {
    return view('admin.merchants.edit')->with('merchant', $merchant);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Merchant  $merchant
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Merchant $merchant) {
    $result = $merchant->update([
      'name' => $request->name,
      'email' => $request->email,
      'status' => (bool)$request->status
    ]);
    return redirect('/admin/merchants');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Merchant  $merchant
   * @return \Illuminate\Http\Response
   */
  public function destroy(Merchant $merchant) {
    $result = $merchant->delete();
    return redirect('/admin/merchants');
  }

  public function updateToken(Merchant $merchant) {
    $token = $merchant->createToken();
    session(['token' => $token]);
    print_r($token);die;
    return redirect('/admin/merchants');
  }
}

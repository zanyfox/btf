<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller {

  public function index(Request $request) {
    $messages = Message::all();
    return response()->json(['status' => 'ok', 'messages' => $messages], 200);
  }

  public function counts(Request $request) {

    $counts = Message::query()
    ->where(request('status'), '==', 'new', function ($query) {
      $query->where('status', 'new');
    })
    ->orWhere(request('status'), '==', 'read', function ($query) {
      $query->where('status', 'read');
    })
    ->count();


    /* $count = Message::count();
    if ($request->has('status')) {
      //$count = Message::where('status', $request->get('status'))->count();
    } */
    return response()->json(['status' => 'ok', 'counts' => $counts], 200);
  }

  /* public function show($id) {
    return response()->json(['status' => 'ok', 'message' => 'Messages show'], 200);
  } */

  public function store(Request $request) {
    return response()->json(['status' => 'ok', 'message' => 'Messages store'], 201);
  }

  public function update(Request $request, $id) {
    return response()->json(['status' => 'ok', 'message' => 'Messages update'], 200);
  }

  public function destroy($id) {
    return response()->json(['status' => 'ok', 'message' => 'Messages destroy'], 200);
  }

  public function changeStatus($id) {
    return response()->json(['status' => 'ok', 'message' => 'Messages changeStatus'], 200);
  }

}

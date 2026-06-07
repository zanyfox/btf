<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller {

  public function index(Request $request) {
    $messages = Message::query()
      //->with('user.name', 'user.surname')
      ->latest('created_at')
      ->when(request('status'), function ($query) {
        return request('status') === 'all' ? $query : $query->where('status', '=', request('status'));
      })
      ->paginate(5);


    //$messages = Message::all();
    return response()->json(['status' => 'ok', 'messages' => $messages], 200);
  }

  public function messageStatuses() {

    $statuses = [
      ['name' => 'Новые', 'value' => 'new', 'color' => 'danger'],
      ['name' => 'Прочитанные', 'value' => 'read', 'color' => 'success'],
    ];

    $data = collect($statuses)->map(function ($status) {
      return [
        'name' => $status['name'],
        'value' => $status['value'],
        'count' => Message::where('status', $status['value'])->count(),
        'color' => $status['color'],
      ];
    });

    return response()->json([
      'status' => 'ok',
      'messageStatuses' => $data
    ], 200);
  }

  public function destroy($id) {
    Message::find($id)->delete();
    return response()->noContent();
  }

  public function changeStatus($id) {
    return response()->json(['status' => 'ok', 'message' => 'Messages changeStatus'], 200);
  }



}

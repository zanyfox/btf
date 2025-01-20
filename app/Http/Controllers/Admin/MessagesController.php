<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller {
  public function index(Request $request) {

    $query = DB::table('messages')->orderBy('created_at', 'DESC');
    if(!empty($request->get('search'))) {
      $query = $query->where('name','like','%' . $request->search . '%');
      $query = $query->orWhere('email','like','%' . $request->search . '%');
      $query = $query->orWhere('phone','like','%' . $request->search . '%');
    }
    $messages = $query->paginate(25);
    $messages->withPath('/admin/messages');
    return view('admin/messages/index', compact('messages'));
  }

  public function show(int $id) {
    $message = DB::table('messages')->find($id);
    DB::table('messages')->where('id', $id)->update(['status' => 'read']);
    return view('admin/messages/show', compact('message'));
  }

}

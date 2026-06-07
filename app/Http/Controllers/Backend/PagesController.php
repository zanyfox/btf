<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;

class PagesController extends Controller {

  public function index() {
    return response()->json(['status' => 'ok', 'pages' => Page::all()]);
  }

  public function show($id) {
    $page = Page::find($id);
    if (!$page) {
      return response()->json(['status' => 'error', 'message' => 'Page not found'], 404);
    }
    return response()->json(['status' => 'ok', 'page' => $page], 200);
  }

  public function store(Request $request) {

    request()->validate([
      'title' => 'required|string|min:3|max:255',
      'slug' => 'required|string|min:3|max:255|unique:pages,slug',
    ]);

    $page = Page::create([
      'title' => $request->title,
      'slug' => $request->slug,
    ]);
    if (!$page) {
      return response()->json(['status' => 'error', 'message' => 'Page not created'], 500);
    }
    return response()->json(['status' => 'ok', 'message' => 'Page created', 'page' => $page], 201);
  }

  public function update(Request $request, $id) {

    request()->validate([
      'title' => 'required|string|min:3|max:255',
      'slug' => 'required|string|min:3|max:255|unique:pages,slug,' . $id,
    ]);

    $page = Page::find($id);
    if (!$page) {
      return response()->json(['status' => 'error', 'message' => 'Page not found'], 404);
    }
    $page->update([
      'title' => request('title'),
      'slug' => $request->slug,
    ]);
    return response()->json(['status' => 'ok', 'message' => 'Page updated', 'page' => $page]);
  }

  // Change user status
  /* public function changeStatus(Request $request, $id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
    $user->update([
      'role_id' => $request->role,
    ]);
    return response()->json(['status' => 'ok', 'user' => $user]);
  } */

  public function destroy($id) {
    $page = Page::find($id);
    if (!$page) {
      return response()->json(['status' => 'error', 'message' => 'Page not found'], 404);
    }
    $page->delete();
    return response()->json(['status' => 'ok', 'message' => 'Page deleted'], 200);
  }

}

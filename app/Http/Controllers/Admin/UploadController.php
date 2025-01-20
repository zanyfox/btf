<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller {

  public function __invoke(Request $request) {

    if(!empty($_FILES) && $request->file) {

      $tempDir = 'temp/';
      if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
      }

      $tempPath = public_path($tempDir);
      $file = $request->file;

      $ext = $file->getClientOriginalExtension();
      $tempFilename = sha1(uniqid()) . '.' . $ext;
      $file->move($tempPath, $tempFilename);

      return response()->json([
        'status' => 'success',
        'tempFilename' => $tempFilename,
        'message' => __('admin.PictureUploadedSuccessfully')
      ]);

    }
    return response()->json([
      'status' => 'fail',
      'message' => __('admin.PictureUploadedFailed')
    ]);
  }

}

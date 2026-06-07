<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class ProfileController extends Controller {

  public function index() {
    return response()->json([
      'success' => true,
      'user' => auth()->user()->only(['id','name','surname','email','phone','picture','role_id','status'])
    ], 200);
  }

  // Update profile
  public function update(Request $request) {

    $user = auth()->user(); //$user = auth('web')->user();

    /* $this->validate($request, [
      'name' => 'required|string|min:2|max:191',
      'email' => 'bail|required|string|email|max:191|unique:users,email,' . $user->id,
      'password' => 'sometimes|required|string|min:6',
      'phone' => 'nullable|string|min:6|max:20',
    ]); */

    $validator = Validator::make($request->all(), [
      'name' => ['required','string','min:2','max:191'],
      'email' => ['required','string','email','max:191', Rule::unique('users')->ignore($user->id)],
      'phone' => ['nullable','string','max:20'],
      'currentPassword' => ['nullable'],
      'newPassword' => ['nullable','min:8','max:100'],
      'newPasswordConfirm' => ['same:newPassword'],
      //'picture' => 'required|mime:jpeg,png,jpg,gif,svg|max:2048',
      //'password' => 'required|string|min:8',
      //'status' => 'required|boolean',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $userData = [
      'name' => $request->name,
      'surname' => $request->surname,
      'email' => $request->email,
      'phone' => $request->phone,
      'status' => $request->status,
    ];

    // Update user password
    if(!empty($request->currentPassword)) {
      if( Hash::check($request->currentPassword, $user->password) && $request->newPassword !== '' &&  $request->newPassword === $request->newPasswordConfirm) {
        $userData['password'] = Hash::make($request->newPassword); //  bcrypt($request->newPassword);
        //$request->merge(['password' => Hash::make($request->newPassword)]);
      }
    }

    // Update user picture
    $currentPicture = $user->picture;
    if( $request->picture != $currentPicture ) {
      $fileName = time() . '.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];

      $manager = new ImageManager(new Driver());
      $image = $manager->read($request->picture);
      $image->save(public_path('uploads/users/' . $fileName), 100);

      // Delete old picture
      if(File::exists( public_path('uploads/users/' . $currentPicture) )) {
        File::delete(public_path('uploads/users/' . $currentPicture));
      }

      $userData['picture'] = $fileName;

      //$request->picture = $fileName;
      //$request->merge(['picture' => $fileName]);

    }

    $user->update($userData); // $user->fill($userData)->save(); // $user->update($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Profile updated successfully',
      'user' => $user
    ], 200);
  }

  public function uploadPicture(Request $request) {

    $validator = Validator::make($request->all(), [
      'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if( $validator->fails() ) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.ValidationWentWrong'),
        'errors' => $validator->errors()
      ]);
    }

    $userId = auth()->user()->id;
    $user = User::find($userId);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }

    if( $request->hasFile('picture') ) {
      $file = $request->file('picture');

      //$path = $file->store('images', 'public');
      /* $previousPath = $user->getRawOriginal('picture');
      $link = Storage::disk('public')->put('users', $file);
      Storage::delete('uploads/users/' . $previousPath);
      $user->update(['picture' => $link]); */

      $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
      $file->move(public_path('uploads/users'), $filename);
      $user->update(['picture' => $filename]);
      //$request->user()->update(['picture' => $filename]);
      return response()->json(['success' => true, 'picture' => $filename]);
    }
  }

  public function removePicture() {
    $userId = auth()->user()->id;
    $user = User::find($userId);
    if (!$user) {
      return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }

    if(file_exists( public_path('uploads/users/' . $user->picture) )) {
      unlink(public_path('uploads/users/' . $user->picture));
    }

    $user->update(['picture' => '']);
    return response()->json(['success' => true, 'message' => 'Picture removed']);
  }

}

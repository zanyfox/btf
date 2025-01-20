<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\User;
use App\Models\CustomerAddress;

class AccountController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
		if(!Auth::check()) {
			return redirect()->action([\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create']);
		}
	}

	public function index() {
		$user = User::find(Auth::user()->id);
		//$user = User::find(Auth::id());
		print_r($user);die;
		//dd($user);
		//$orders = Auth::user()->orders()->orderBy('created_at', 'DESC')->get();
		return view('account.index', ['user' => $user]);
	}

	public function orders($id = null) {

		
		//print_r($user);die;
		
		if(!$id) {
			$orders = Auth::user()->orders()->orderBy('created_at', 'DESC')->get();
			//$orders = Order::where(['user_id' => Auth::user()->id])->orderBy('created_at', 'DESC')->get();
			/* return response()->json([
				'status' => 'success',
				'orders' => $orders
			]); */
			return view('account.orders', ['orders' => $orders]);
		}

		$order = Order::where(['id' => $id, 'user_id' => auth()->user()->id])->first();

		if($order) {
			return response()->json([
				'status' => 'success',
				'order' => $order
			]);
		} else {
			return response()->json([
				'status' => 'fail',
				'message' => __('account.NoOrderFound')
			]);
		}
	}

	public function profile() {
		return view('account.profile', ['user' => Auth::user()]);
	}

	public function updateProfile(Request $request) {

		$userId = Auth::id();

		$validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'email' => 'required|email|unique:users,email,' . $userId . ',id',
      'phone' => 'nullable'
    ]);

		if( $validator->passes() ) {

			User::find($userId)->update([
				'name' => $request->name,
				'email' => $request->email,
				'phone' => $request->phone,
				'address' => $request->address
			]);
	
			session()->flash('success', __('app.ProfileUpdatedSuccessfully'));
			return response()->json([
				'status' => 'success',
				'message' => __('app.ProfileUpdatedSuccessfully')
			]);

    }

    session()->flash('fail', 'Something went wrong');
		return response()->json([
			'status' => 'fail',
			'message' => 'Something went wrong',
			'errors' => $validator->errors()
		]);

	}

	public function changePassword( Request $request ) {

		if( $request->input() ) {

			$validator = Validator::make($request->all(), [
				'old_password' => 'required',
				'new_password' => 'required|min:6',
				'confirm_password' => 'required|same:new_password'
			]);
	
			if( $validator->passes() ) {
	
				$userId = Auth::user()->id;
				$user = $request->user() ? $request->user() : User::select('id','password')->where('id', $userId)->first();
				if( !Hash::check($request->old_password, $user->password)  ) {
					session()->flash('fail', __('app.YourOldPasswordIsIncorrectPleaseTryAgain'));
					return response()->json([
						'status' => 'fail',
						'message' => __('app.YourOldPasswordIsIncorrectPleaseTryAgain')
					]);
				}

				$user->password = Hash::make($request->new_password);
				$user->save();
		
				session()->flash('success', __('app.YouHaveSuccessfullyChangedYourPassword'));
				return response()->json([
					'status' => 'success',
					'message' => __('app.YouHaveSuccessfullyChangedYourPassword')
				]);
	
			} else {
				return response()->json([
					'status' => 'fail',
					'errors' => $validator->errors()
				]);
			}

		}

		return view('account.change-password');
	}

	public function loadCustomerAddresses() {
		//$customerAddresses = CustomerAddress::where('user_id', Auth::user()->id)->get()->toArray();
		$user = User::with('customerAddress')->where('id', Auth::user()->id)->first()->toArray();
		$customerAddresses = $user['customer_address'];
		//print_r($customerAddresses); die;
		
		if(count($customerAddresses) > 0) {
			for($i = 0; $i < count($customerAddresses); $i++) {
				$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['city'] . ', ул. ' . $customerAddresses[$i]['street_name'];
				if( !empty($customerAddresses[$i]['house']) ) {
					$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['fulladdress'] . ', д.' . $customerAddresses[$i]['house'];
				}
				if( !empty($customerAddresses[$i]['building']) ) {
					$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['fulladdress'] . ', к.' . $customerAddresses[$i]['building'];
				}
				if( !empty($customerAddresses[$i]['entrance']) ) {
					$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['fulladdress'] . ', подъезд ' . $customerAddresses[$i]['entrance'];
				}
				if( !empty($customerAddresses[$i]['floor']) ) {
					$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['fulladdress'] . ', этаж ' . $customerAddresses[$i]['floor'];
				}
				if( !empty($customerAddresses[$i]['flat']) ) {
					$customerAddresses[$i]['fulladdress'] = $customerAddresses[$i]['fulladdress'] . ', кв.' . $customerAddresses[$i]['flat'];
				}
			}
		}
		return response()->json([
			'status' => 'success',
			'addresses' => $customerAddresses
		]);
	}

	public function getCustomerAddresses($id) {
		$customerAddress = CustomerAddress::where(['id' => $id, 'user_id' => Auth::user()->id])->first();

		if($customerAddress) {
			return response()->json([
				'status' => 'success',
				'address' => $customerAddress
			]);
		}

		return response()->json([
			'status' => 'fail',
			'message' => __('app.RecordNotFound')
		]);

	}

	public function addCustomerAddress(Request $request) {
		if( $request->input() ) {

			$validator = Validator::make($request->all(), [
				'city' => 'required',
				'street_id' => 'required'
			]);

			if( $validator->passes() ) {
				CustomerAddress::create([
          'user_id' => Auth::user()->id,
          'name' => $request->name,
          'country_id' => 179,
          'city' => $request->city,
          'street_id' => $request->street_id,
          'street_name' => $request->street_name,
          'house' => $request->house,
          'building' => $request->building,
          'entrance' => $request->entrance,
          'floor' => $request->floor,
          'flat' => $request->flat,
          'doorphone' => $request->doorphone
        ]);

				return response()->json([
					'status' => 'success',
					'message' => __('app.CustomerAddressAddedSuccessfully')
				]);
	
			} else {
				return response()->json([
					'status' => 'fail',
					'errors' => $validator->errors()
				]);
			}

		}
	}

	public function updateCustomerAddress(Request $request, int $id) {

		if( $request->input() ) {

			$validator = Validator::make($request->all(), [
				'city' => 'required',
				'street_id' => 'required'
			]);

			if( $validator->passes() ) {

				$result = CustomerAddress::where(['id' => $id, 'user_id' => Auth::user()->id])->update([
					'name' => $request->name,
					'country_id' => 179,
					'city' => $request->city,
					'street_id' => $request->street_id,
					'street_name' => $request->street_name,
					'house' => $request->house,
					'building' => $request->building,
					'entrance' => $request->entrance,
					'floor' => $request->floor,
					'flat' => $request->flat,
					'doorphone' => $request->doorphone
				]);

				return response()->json([
					'status' => 'success',
					'message' => __('app.CustomerAddressUpdatedSuccessfully')
				]);
	
			} else {
				return response()->json([
					'status' => 'fail',
					'errors' => $validator->errors()
				]);
			}

		}
	}

	public function removeCustomerAddress(Request $request) {
		$result = CustomerAddress::where(['id' => $request->id, 'user_id' => Auth::user()->id])->delete();
		if($result) {
			return response()->json([
				'status' => 'success',
				'data' => $result,
				'id' => $request->id
			]);
		}

		return response()->json([
			'status' => 'fail',
			'message' => __('app.SomethingWentWrong')
		]);
		
	}

	public function getStreets() {
		$streets = \App\Models\Street::get();
		if($streets) {
			return response()->json([
				'status' => 'success',
				'streets' => $streets
			]);
		}		
	}

	public function logout() {
		//return redirect()->action([\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']);
    Auth::guard()->logout();
    return redirect()->route('home');
  }

}

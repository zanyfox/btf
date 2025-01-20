<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller {

  public function index(Request $request) {

    $query = DB::table('payments')->orderBy('created_at', 'DESC');
    if(!empty($request->get('search'))) {
      $query = $query->where('clientid','like','%' . $request->search . '%');
      $query = $query->orWhere('client_email','like','%' . $request->search . '%');
      $query = $query->orWhere('client_phone','like','%' . $request->search . '%');
      //$query = $query->whereBetween('sum', [0, 100000000]);
      //$query = $query->orWhereBetween('sum', [0, 100000000]);
      //$query = $query->whereDate('created_at', '2024-06-17');
    }
    $payments = $query->paginate(25);
    $payments->withPath('/admin/payments');
    return view('admin/payments/index', compact('payments'));
  }

  
  public function show(int $id) {
    $payment = DB::table('payments')->find($id);
    return view('admin/payments/show', compact('payment'));
  }

  public function getHttpLog(int $id) {
    $result = app()->call('\App\Http\Controllers\PaymentController@httplogbyid');
    return response()->json([
      'status' => 'success',
      'result' => $result
    ]);
  }

  public function getPaymentInfo($id) {
    $result = app()->call('\App\Http\Controllers\PaymentController@paymentbyid', ['id' => $id]);
    
    /* if( isset($result[0]) ) {
      $payment = Payment::where('paymentid', $id)->first();
      $payment->sum = isset($result[0]['pay_amount']) ? $result[0]['pay_amount'] : null;
      $payment->refund_amount = isset($result[0]['refund_amount']) ? $result[0]['refund_amount'] : null;
      $payment->ps_id = isset($result[0]['payment_system_id']) ? $result[0]['payment_system_id'] : null;
      $payment->bankname = isset($result[0]['site_description']) ? $result[0]['site_description'] : '';
      $payment->bankcode = isset($result[0]['system_description']) ? $result[0]['system_description'] : '';
      $payment->repeat_counter = isset($result[0]['repeat_counter']) ? $result[0]['repeat_counter'] : null;
      $payment->APPROVAL_CODE = isset($result[0]['APPROVAL_CODE']) ? $result[0]['APPROVAL_CODE'] : null;
      $payment->RRN = isset($result[0]['RRN']) ? $result[0]['RRN'] : null;
      $payment->save();
    } */
    return response()->json([
      'status' => 'success',
      'result' => $result
    ]);
  }

}

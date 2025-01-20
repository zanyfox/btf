<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\CustomerAddress;
use App\Models\Payment;
use App\Mail\InvoiceOrderMailable;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdersController extends Controller {

  public function index(Request $request) {
    $orders = Order::latest('orders.created_at')
      ->select('orders.*','users.name')
      ->leftJoin('users','users.id','orders.user_id');

    if($request->get('search') != '') {
      $orders->where('users.name','like','%' . $request->search . '%');
      $orders->orWhere('users.email','like','%' . $request->search . '%');
      $orders->orWhere('users.phone','like','%' . $request->search . '%');
      $orders->orWhere('orders.id','=', $request->search);
      $orders->orWhere('orders.external_id','=', $request->search);
    }

    $orders->when($request->date != null, function($q) use($request) {
      return $q->whereDate('orders.created_at', $request->date);
    })->when($request->status != null, function($q) use($request) {
      return $q->where('orders.status', $request->status);
    });
    //$orders-whereNotNull('orders.user_id');
    $orders = $orders->withTrashed()->paginate(100);
    return view('admin.orders.index', compact('orders'));
  }

  public function create() {}

  public function store(Request $request) {

    /* $server = DB::table('servers')->where('id',$request->server_id)->first();
    if($server->max_connections >= 3) {
      return back()->with('warning', 'Max connections of this server');
    }
 */
    $request->validate([
      'user_id' => 'required',
      'status' => 'required',
      'sum' => 'integer',
    ]);

    $order = Order::create([
      'user_id' => $request->user_id,
      'status' => $request->status ?? 'new',
      'sum' => $request->sum ?? 0,
    ]);

    event(new \App\Events\NewOrderCreated($order));

    if($request->has('goods')) {
      $order->goods()?->attach( $request->goods );
    }

    Session::flash('success', 'New order has been created');
    return to_route('admin.orders.index');
  }

  public function edit(int $id) {
    return $this->show($id);
  }
  public function show(int $id) {

    activity()->log('Look mum, I logged something');

    //$order = Order::select('orders.*','countries.name as countryName')->leftJoin('countries','countries.id','orders.country_id')->find($id);
    //$order = Order::with('customer','items','goods')->findOrFail($id);
    $order = Order::with('items')->whereHas('items', function($q) use($id) {
      //return $q->where('order_id', $id); 
      return $q->where('quantity', '>', 0);
    }
    )
    //->withSum('items', 'price')->withCount('items')
    ->findOrFail($id);
    //print_r($order); die;
    //$orderItems = OrderItem::where('order_id', $order->id)->get();
    $deliveryMethods = DeliveryMethod::all();
    $paymentMethods = PaymentMethod::all();
    //print_r($order->user_id); die;
    $customerAddress = CustomerAddress::where('user_id', $order->user_id)->first();
    $payment = Payment::where('orderid', $order->id)->first();
    //print_r($customerAddress); die;
    return view('admin.orders.show', [
      'order' => $order,
      //'orderItems' => $orderItems,
      'deliveryMethods' => $deliveryMethods,
      'paymentMethods' => $paymentMethods,
      'customerAddress' => $customerAddress,
      'payment' => $payment,
    ]);

  }

  public function update(Request $request, int $id) {

    $request->validate([
      'user_id' => 'required'
    ]);
    $order = Order::find($id);
    $order->user_id = $request->user_id;
    $order->server_id = $request->server_id;
    $order->status = $request->status;
    $order->sum = $request->sum;
    $order->save();

    if($request->has('goods')) {
      $order->goods()?->sync( $request->goods );
    }

    Session::flash('success', 'New order has been updated');
    return to_route('admin.orders.index');
  }

  public function destroy(int $id) {
    $order = Order::find($id);
    if($order->items()) {
      $order->items()->delete();
    }
    $order->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.NewOrderHasBeenDeleted')
    ]);
  }

  public function changeStatus(Request $request, int $id) {
    $order = Order::find($id);
    if(!$order) {
      return response()->json([
        'status' => 'fail',
        'message' => 'admin.RecordNotFound'
      ]);
    }
    $order->status = $request->status;

    $message = __('admin.RecordStatusUpdated');

    if($request->status == 'shipped') {
      $order->shipped_at = date('Y-m-d H:i:s');
      $message .= '. Дата доставки выставлена';
    }

    $order->save();

    return response()->json([
      'status' => 'success',
      'message' => $message
    ]);
  }

  public function viewInvoice(int $id) {
    $order = Order::findOrFail($id);
    return view('admin.orders.invoice', compact('order'));
  }

  public function downloadInvoice(int $id) {
    $order = Order::findOrFail($id);
    $data = ['order' => $order];
    $pdf = Pdf::loadView('admin.orders.invoice', $data);
    $todayDate = \Carbon\Carbon::now()->format('d-m-Y');
    return $pdf->download('invoice' . $order->id . '-' . $todayDate . '.pdf');
  }

  public function sendInvoice(int $id) {
    try {
      $order = Order::findOrFail($id);
      Mail::to($order->email)->send(new InvoiceOrderMailable($order));
      return redirect('admin/orders/' . $order->id . '/edit')->with('success',__('admin.InvoiceMailHasBeenSent'));
    } catch(\Exception $e) {
      return redirect('admin/orders/' . $order->id . '/edit')->with('fail',__('admin.SomethingWentWrong'));
    }
  }

  public function addItem($orderId, $goodId) {
    $order = Order::findOrFail($orderId);
    if($order->goods()->contains($goodId)) {
      $pivotRow = $order->goods()->where('good_id', $goodId)->first()->pivot;
      $pivotRow->quantity++;
      $pivotRow->update();
    } else {
      $order->goods()->attach($goodId);
    }
  }

  public function removeItem($orderId, $goodId) {
    $order = Order::findOrFail($orderId);
    if($order->goods()->contains($goodId)) {
      $pivotRow = $order->goods()->where('good_id', $goodId)->first()->pivot;
      if($pivotRow->quantity < 2) {
        $order->goods()->deattach($goodId); 
      } else {
        $pivotRow->quantity--;
        $pivotRow->update();
      }
    }
  }

  public function export() {}

}

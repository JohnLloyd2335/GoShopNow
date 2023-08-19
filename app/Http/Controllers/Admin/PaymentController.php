<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function __construct()
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
    }

    public function create(Request $request){
        
        $validated = Validator::make($request->all(), [
            'order_id' => ['required']
        ]);

        if($validated->fails()){
            return redirect(route('orders.index'))->with('error','There was an error');
        }

        $order = Order::select('amount')->where('id',$request->order_id)->get();
        $payment = Payment::where('order_id',$request->order_id)->get();

        $xendit_payment_params = [
            'external_id' => $payment[0]->external_id,
            'payer_email' => auth()->user()->email,
            'description' => 'Order with total of ₱'.$order[0]->amount,
            'amount' => $order[0]->amount,
            'success_redirect_url' => 'http://127.0.0.1:8000/my-orders',
            'failure_redirect_url' => 'http://127.0.0.1:8000/my-orders'
        ];

        $createInvoice = \Xendit\Invoice::create($xendit_payment_params);

        $payment[0]->update([
            'checkout_link' => $createInvoice['invoice_url'],
            'status' => 'Paid'
        ]); 

        $order = Order::where('id',$request->order_id)->get();

        $order[0]->update([
            'status' => 'Processing'
        ]);

        session()->flash('success', 'Payment Successful');

        return redirect($createInvoice['invoice_url']);
    }
}

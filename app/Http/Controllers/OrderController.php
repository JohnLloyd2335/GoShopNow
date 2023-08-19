<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;
use Xendit\Xendit;


class OrderController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
    }


    public function index(Request $request)
    {


        if ($request->ajax()) {

            $data = Order::with(['orderItems', 'payment'])
                ->select('id', 'status', 'amount','created_at')
                ->where('user_id', auth()->user()->id)
                ->orderByDesc('created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_items', function ($row) {
                    $html = "";
                    foreach($row->orderItems as $order_items){
                        $product = Product::select('name')->where('id',$order_items->product_id)->get();

                        $html .=  "<div class='gap-1'><p>";
                        $html .= $product[0]->name." (".$order_items->size.") (".$order_items->quantity." qty.) - ₱". $order_items->total_price ."</p>";
                    }
                    $html .= "</div>";

                    return $html;
                })
                ->addColumn('amount', function ($row) {
                    return "₱".$row->amount;
                })
                ->addColumn('payment_status', function ($row) {
                    return $row->payment->status;
                })
                ->addColumn('order_date', function($row) {
                    return Carbon::parse($row->created_at)->format('Y-M-d h:i:s A');
                })
                ->addColumn('actions', function($row) {
                    $paymentRoute = route('payments');
                    $cancelPaymentRoute = route('cancelOrder');
                    $paymentBtn = '<button type="submit" class="btn btn-primary"><i class="fa-solid fa-wallet"></i></button>';
                    $cancelBtn = '<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-x"></i></button>';
                    
                    if (in_array($row->status,['Processing','Shipped','Delivered','Cancelled'])) {
                        $disable = 'disabled';
                        $paymentBtn = '<button type="submit" class="btn btn-primary" '.$disable.'><i class="fa-solid fa-wallet"></i></button>'; 
                        $cancelBtn = '<button type="submit" class="btn btn-danger" '.$disable.'><i class="fa-solid fa-x"></i></button>';
                    }

                    $html = '<div class="d-flex align-items-center justify-content-around">
                                <form method="POST" action="'.$paymentRoute.'">
                                    '.csrf_field().'
                                    <input class="form-control" type="hidden" name="order_id" value="'.$row->id.'" />
                                    '.$paymentBtn.'
                                </form>

                                <form method="POST" action="'.$cancelPaymentRoute.'">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <input class="form-control" type="hidden" name="order_id" value="'.$row->id.'" />
                                    '.$cancelBtn.'
                                </form>
                                
                               
                            </div>';
                    return $html;
                })
                ->rawColumns(['order_items','amount','payment_status','order_date','actions'])
                ->make(true);
        }

        return view('customer.order');
    }



    public function create()
    {

        $cart = Cart::where('user_id', auth()->user()->id)->with(['cart_item'])->get();

        $amount = 0;
        foreach ($cart[0]->cart_item as $cart_item) {
            $product = Product::select('price')->where('id', $cart_item->product_id)->get();
            $price = (int)$product[0]->price * (int)$cart_item->quantity;
            $amount += $price;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => 'Pending',
            'amount' => $amount
        ]);

        foreach ($cart[0]->cart_item as $cart_item) {
            $product = Product::select('price')->where('id', $cart_item->product_id)->get();
            $total_price = (int)$product[0]->price * (int)$cart_item->quantity;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart_item->product_id,
                'size' => $cart_item->size,
                'quantity' => $cart_item->quantity,
                'price' => $product[0]->price,
                'total_price' => $total_price
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'checkout_link' => '',
            'external_id' => Str::uuid(),
            'payer_email' => auth()->user()->email,
            'status' => 'Unpaid',
            'amount' => $amount
        ]);

        return redirect(route('orders.index'))->with('success', 'Order Placed');
    }

    public function cancelled(Request $request){

        $validated = Validator::make($request->all(), [
            'order_id' => ['required']
        ]);

        if($validated->fails()){
            return redirect(route('orders.index'))->with('error','There was an error');
        }

        $order = Order::where('id',$request->order_id)->get();

        $order[0]->update([
            'status' => 'Cancelled'
        ]);

        return redirect(route('orders.index'))->with('success','Order Successfully Cancelled');

    }
}

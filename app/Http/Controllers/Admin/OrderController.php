<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Order::with(['orderItems', 'user', 'payment'])
                ->select('id', 'status', 'user_id', 'amount', 'created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_items', function ($row) {
                    $html = "";
                    foreach ($row->orderItems as $order_items) {
                        $product = Product::select('name')->where('id', $order_items->product_id)->get();

                        $html .=  "<div class='gap-1'><p>";
                        $html .= $product[0]->name . " (" . $order_items->size . ") (" . $order_items->quantity . " qty.) - ₱" . $order_items->total_price . "</p>";
                    }
                    $html .= "</div>";

                    return $html;
                })
                ->addColumn('customer_info', function ($row) {
                    $customer = User::with('mobile_number', 'address')->where('id', $row->user_id)->get();

                    $html = "<p>" . $customer[0]->name . "</p><p>" . $customer[0]->mobile_number->mobile_number . " " . $customer[0]->address->city_municipality . ", " . $customer[0]->address->province . ", " . $customer[0]->address->region . " (" . $customer[0]->address->postal_code . ")</p>";

                    return $html;
                })
                ->addColumn('amount', function ($row) {
                    return "₱" . $row->amount;
                })
                ->addColumn('payment_status', function ($row) {
                    return $row->payment->status;
                })
                ->addColumn('order_date', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-M-d h:i:s A');
                })
                ->addColumn('actions', function ($row) {
                    // $editBtn = '<button type="submit" class="btn btn-primary"><span class="mdi mdi-pencil"></span></button>';
                    $editRoute = route('adminOrders.edit',$row->id);

                    // $html = '<div class="d-flex align-items-center justify-content-around">
                    //             <form method="GET" action="' . $editRoute . '">
                    //                 ' . csrf_field() . '
                    //                 ' . method_field('GET') . '
                    //                 <input class="form-control" type="hidden" name="order_id" value="' . $row->id . '" />
                    //                 ' . $editBtn . '
                    //             </form>
                    //         </div>';
                    // return $html;

                    return "<a href='".$editRoute."' class='btn btn-primary'><span class='mdi mdi-pencil'></span></a>";
                })
                ->rawColumns(['order_items', 'amount', 'payment_status', 'order_date', 'customer_info', 'actions'])
                ->make(true);
        }

        return view('admin.order.index');
    }


    public function edit(Request $request){

        $order = Order::select('id','status')->findOrFail($request->id);

        return view('admin.order.edit',compact('order'));

    }

    public function update(Request $request, string $id){

        $validator = Validator::make($request->all(),[
            'status' => ['required']
        ]);

        if($validator->fails()){
            return redirect(route('admin.order.index'));
        }

        $order = Order::where('id',$id)->findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect(route('adminOrders.index'))->with('success','Order Status Successfully Updated');
    }
}

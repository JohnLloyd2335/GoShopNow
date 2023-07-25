<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function create(Request $request, $id)
    {
        $product = Product::with(['stock'])->findOrFail($id);

        $matchingStock = $product->stock->first(function ($stock) use ($request) {
            return $stock->size_name === $request->input('size');
        });

        if (!$matchingStock) {
            return redirect(route('showProduct', $id))->with('error', 'Selected Size is not available for this Product');
        }

        $selectedQuantity = $request->input('quantity');

        if ($matchingStock->quantity === 0) {
            return redirect(route('showProduct', $id))->with('error', 'Product Stock is not available');
        } elseif ($matchingStock->quantity < $selectedQuantity) {
            return redirect(route('showProduct', $id))->with('error', 'Selected Quantity must be less than or equal to Product Stocks');
        }

        $userCart = Cart::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);

        $existingCartItem = CartItem::where('cart_id', $userCart->id)
            ->where('product_id', $product->id)
            ->where('size', $request->input('size'))
            ->first();

        if (!$existingCartItem) {
            // New record
            CartItem::create([
                'cart_id' => $userCart->id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity'),
                'size' => $request->input('size')
            ]);

            return redirect(route('showProduct', $id))->with('success', 'Product Successfully Added to Cart');
        }

        // Existing record, update the quantity
        $newQuantity = (int)$existingCartItem->quantity + (int)$request->input('quantity');

        $existingCartItem->update([
            'quantity' => $newQuantity
        ]);

        return redirect(route('showProduct', $id))->with('success', 'Product Successfully Added to Cart');
    }

    public function show(){

        $user_cart_id = Cart::select('id')->where('user_id',auth()->user()->id)->pluck('id');

        $user_cart_items = CartItem::whereIn('cart_id',$user_cart_id)->with(['product'])->paginate(5);

        $total = 0;

        foreach($user_cart_items as $cart_item){
            $total +=  $cart_item->quantity * $cart_item->product->price;
        }

        
        return view('customer.cart',compact('user_cart_items','total'));

    }

    public function destroy(Request $request ,$id){

        $validated = Validator::make($request->all(),[
            'cart_id' => 'required|numeric',
            'cart_item_id' => 'required|numeric'
        ]);


        $cart = Cart::with('cart_item')->findOrFail($request->input('cart_id'));


        $matching_cart = $cart->cart_item->first(function($cart_item) use ($request){
            return $cart_item->id == $request->input('cart_item_id');
        });


        $cart_item = CartItem::findOrFail($matching_cart->id);
        $cart_item->delete();

        return redirect(route('showCart'))->with('success','Item Successfully Removed from Cart');
    }
}

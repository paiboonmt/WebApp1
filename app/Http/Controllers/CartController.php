<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        $products = DB::table('products')->get();
        $cart = Session::get('cart', []);

        $total = 0;

        // Loop through each item and calculate total price (quantity * price)
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return view('ticket',compact('products','cart','total'));
    }

    public function addToCart( Request $request){
        $cart = session()->get('cart', []);
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = DB::table('products')->where('id',$productId)->first();
            $cart[$productId] = [
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
        return to_route('ticket');
    }

    public function updateCart(Request $request) {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity;
        if (isset($cart[$productId])) {
            if ($quantity > 0) {
                $cart[$productId]['quantity'] ++ ;
            } else {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    public function remove(Request $request) {

        $productId = $request->product_id;
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            if ( $quantity == 2 ) {
                $cart[$productId]['quantity'] --  ;
            } elseif ( $quantity == 1 ){
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] -- ;
            }
            session()->put('cart', $cart);
        }

        return to_route('ticket');
    }

    public function checkout() {

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        // Proceed with checkout logic here

        Session::forget('cart'); // Clear the cart

        return to_route('ticket');
    }
}

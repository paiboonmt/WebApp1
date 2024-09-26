<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

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
        $productId = $request->id;
        $quantity = $request->quantity;
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = DB::table('products')->where('id',$productId)->first();
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
        return to_route('ticket');
    }

    public function updateCart(Request $request , string $id) {
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
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return view('checkout',compact('cart','total'));
    }

    public function cancelcart() {
        $cart = Session::get('cart', []);
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('sub');
        Session::forget('tax');
        Session::forget('tax3');
        Session::forget('sub_total');
        return to_route('ticket');
    }

    public function addDiscount(Request $request){
        $request->validate([
            'discount' => 'required'
        ]);
        $tax = $request->discount;
        $cart = session()->get('cart');
        $discount = $request->discount;
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        $discount = ( $total * $discount) / 100;
        $sub = $total - $discount;
        session(['discount' => $discount, 'sub' => $sub , 'tax' => $tax]);
        return to_route('cart_checkout');
    }

    public function removeDiscount(){
        Session::forget('discount');
        Session::forget('sub');
        return to_route('cart_checkout');
    }

    public function addTax(Request $request){

        $tax = $request->session()->get('tax');
        $sub = $request->session()->get('sub');
        $cart = session()->get('cart');
        $tax3 = ($sub * $tax) / 100 ;
        $sub_total = $sub + $tax3;

        session(['tax3' => $tax3, 'sub_total' => $sub_total]);
        return to_route('cart_checkout');

    }
}

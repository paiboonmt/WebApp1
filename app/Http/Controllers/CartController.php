<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\CartItem;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $products = DB::table('products')->get();
        $cart = Session::get('cart', []);
        $total = 0;
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

        $payments = DB::table('payment')->get();

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return view('checkout',compact('cart','total','payments'));
    }

    public function cancelcart() {
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('sub');
        Session::forget('tax');
        Session::forget('tax3');
        Session::forget('sub_total');
        Session::forget('sub_discount');
        Session::forget('payment');
        return to_route('ticket');
    }

    public function addDiscount(Request $request){
        $request->validate([
            'discount' => 'required'
        ]);
        $sub_discount = $request->discount;
        $cart = session()->get('cart');
        $discount = $request->discount;
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        $discount = ( $total * $discount) / 100;
        $sub = $total - $discount;
        session(['discount' => $discount, 'sub' => $sub , 'sub_discount' => $sub_discount]);
        return to_route('cart_checkout');
    }

    public function removeDiscount(){
        Session::forget('discount');
        Session::forget('sub');
        return to_route('cart_checkout');
    }

    public function addTax(Request $request){

        if ( $request->sub != 0) {
            $tax3 = $request->tax3;
            $sub = $request->sub;
            $tax3 = $sub * $tax3 / 100;
            $sub = $sub + $tax3;
            session(['tax3' => $tax3, 'sub' => $sub]);
            return to_route('cart_checkout');
        } else {
            $tax3 = $request->tax3;
            $sub = $request->sub;
            $tax3 = $sub * $tax3 / 100;
            $sub = $sub + $tax3;
            session(['tax3' => $tax3, 'sub' => $sub]);
            return to_route('cart_checkout');
        }

        
    }

    public function removeTex(Request $request){
        $tax3 = $request->tax3;
        $sub  = $request->sub;
        $sub = $sub - $tax3;
        Session::forget('tax3');
        // Session::forget('sub');
        session(['sub' => $sub]);
        return to_route('cart_checkout');
    }

    public function addPayment(Request $request){
        $payment = $request->payment;
        session(['payment'=>$payment]);
        return to_route('cart_checkout');
    }

    public function removePayment(){
        Session::forget('payment');
        return to_route('cart_checkout');
    }

    public function removeAll(){
        // dd(session()->all());
        Session::forget('payment');
        Session::forget('sub_discount');
        Session::forget('sub');
        Session::forget('tax3');
        Session::forget('discount');
        return to_route('cart_checkout');
    }
}

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

        $vat7 = DB::table('payment')->where('value','=','7')->get();
        $vat3 = DB::table('payment')->where('value','=','3')->get();

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return view('checkout',compact('cart','total','payments','vat7','vat3'));
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

        // dd($request);

        $total = $request->total;

        $request->validate([
            'payment_value' => 'required',
            'pay_name' => 'required'
        ]);

        if ( $request->payment_value == 7) {
            // dd($request->pay_name,$request->payment_value , $total);
            $vat = ( $total * $request->payment_value) / 100 ;
            $total = $total + $vat;
            session([
                'vat' => $vat,
                'total' => $total,
                'pay_name' => $request->pay_name,
                'payment_value' => $request->payment_value,
            ]);

            return to_route('cart_checkout');

        } if ( $request->payment_value == 3) {
            // dd($request->pay_name,$request->payment_value , $total);
            $vat = ( $total * $request->payment_value) / 100 ;
            $total = $total + $vat;
            session([
                'vat' => $vat,
                'total' => $total,
                'pay_name' => $request->pay_name,
                'payment_value' => $request->payment_value,
            ]);
            return to_route('cart_checkout');

        } else {
            dd($request->pay_name,$request->payment_value);
        }

    }

    public function removePayment(){
        Session::forget('vat');
        Session::forget('total');
        Session::forget('pay_name');
        Session::forget('payment_value');
        Session::forget('vat_sub');
        Session::forget('sub_total');
        return to_route('cart_checkout');
    }

    public function removeAll(){
        // dd(session()->all());
        Session::forget('payment');
        Session::forget('sub_discount');
        Session::forget('sub');
        Session::forget('tax3');
        Session::forget('discount');
        Session::forget('sub_total');
        Session::forget('sub_payment');
        return to_route('cart_checkout');
    }

    public function addSubPayment(Request $request){
        $sub_payment = $request->sub_payment;
        $pay_name = $request->pay_name;
        $total = $request->total;
        $vat_sub = ($total * $sub_payment)/100;
        $sub_total = $total + $vat_sub;
        session([
            'sub_pay_name' => $pay_name,
            'sub_payment' => $sub_payment,
            'vat_sub' => $vat_sub,
            'sub_total' => $sub_total,
        ]);
        return to_route('cart_checkout');
    }

    public function removeSubPayment(){
        Session::forget('sub_pay_name');
        Session::forget('sub_payment');
        Session::forget('vat_sub');
        Session::forget('sub_total');
        return to_route('cart_checkout');
    }

    public function cancelcart() {
        // dd(session()->all());
        Session::forget('cart');
        Session::forget('vat_sub');
        Session::forget('sub_pay_name');
        Session::forget('sub_payment');
        Session::forget('payment_value');
        Session::forget('pay_name');
        Session::forget('total');
        Session::forget('discount');
        Session::forget('sub');
        Session::forget('vat');
        Session::forget('tax');
        Session::forget('tax3');
        Session::forget('sub_total');
        Session::forget('sub_discount');
        Session::forget('payment');
        return to_route('ticket');
    }

    public function complete(Request $request){

        // dd($request->total,session()->all());

        // "_token" => "YKvJFRgIgmgNDv91dfDjYadhhFwNDoDIUd1GdTag"
        // "_flash" => array:2 [▶]
        // "_previous" => array:1 [▶]
        // "login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d" => 1
        // "cart" => array:1 [▶]

        // "pay_name" => "Cash"
        // "payment_value" => "7"
        // "vat" => 315
        // "total" => 4815

        // "sub_pay_name" => "VisaCard"
        // "sub_payment" => "3"
        // "vat_sub" => 144.45
        // "sub_total" => 4959.45

        // payment
        $Origin_total = $request->input('total');
        $pay_name = session()->get('pay_name');
        $payment_value = session()->get('payment_value');
        $vat = session()->get('vat');
        $total = session()->get('total');

        // sub_payment
        $sub_pay_name = session()->get('sub_pay_name');
        $sub_payment = session()->get('sub_payment');
        $vat_sub = session()->get('vat_sub');
        $sub_total = session()->get('sub_total');

        // dd($payment_value);

        $cart = session()->get('cart');
        foreach (  $cart as $item) {

            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        Session::forget('cart');
        Session::forget('vat');
        Session::forget('total');
        Session::forget('pay_name');
        Session::forget('payment_value');

        return to_route('ticket');
    }
}

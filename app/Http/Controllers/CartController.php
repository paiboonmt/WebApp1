<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Cart_orders;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
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

        $cardNumber = Carbon::now()->format('dmYHis');

        return view('checkout',compact('cart','total','payments','vat7','vat3','cardNumber'));
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

        $total = $request->total;

        $request->validate([
            'payment_value' => 'required',
            'pay_name' => 'required'
        ]);

        // dd($request->input(), session()->all());

        $discount = session()->get('discount');
        $total = $total - $discount;

        if ( session('sub_discount') ) {

            if ( $request->payment_value == 7) {

                $vat = ( $total * $request->payment_value) / 100 ;
                $total = $total + $vat;
                session([
                    'vat' => $vat,
                    'total' => $total,
                    'pay_name' => $request->pay_name,
                    'payment_value' => $request->payment_value,
                ]);
                return to_route('cart_checkout');

            }elseif ( $request->payment_value == 3) {

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
        } else {
            if ( $request->payment_value == 7) {
                $vat = ( $total * $request->payment_value) / 100 ;
                $total = $total + $vat;
                session([
                    'vat' => $vat,
                    'total' => $total,
                    'pay_name' => $request->pay_name,
                    'payment_value' => $request->payment_value,
                ]);

                return to_route('cart_checkout');

            } elseif ( $request->payment_value == 3) {
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

        $request->validate([
            'customer' => 'required',
            'total' => 'required',
        ]);

        // dd(session()->all());

        $cardNumber = $request->cardNumber;
        $customer = $request->customer;
        $comment = $request->comment;
        $sdate = $request->sdate;
        $edate = $request->edate;
        $price = $request->total;

        $pay_name = session('pay_name');

        $sub_pay_name = session('sub_pay_name');

        $discount = session('discount'); // 60.0

        $sub = session('sub'); // 1940.0
        $sub_discount = session('sub_discount'); // 3%


        if (session('payment_value') == 3 && session('sub_payment') == 7) {

            $vat3 = session('payment_value');
            $vat7 = session('sub_payment');

        } elseif (session('payment_value') == 7 && session('sub_payment') == 3) {

            $vat7 = session('payment_value');
            $vat3 = session('sub_payment');

        } elseif ( session('payment_value') == 3) {

            $vat3 = session('payment_value');
            $vat7 = 0;

        } elseif (session('payment_value') == 7) {

            $vat7 = session('payment_value');
            $vat3 = 0;

        } else {

            $vat3 = 0;
            $vat7 = 0;

        }


        $total = session('total'); // 1998.2
        $pay_name = session('pay_name'); // VisaCard
        $payment_value = session('payment_value'); // 3

        // payment
        $Origin_total = $request->input('total');
        $vat = session()->get('vat');

        $sub_pay_name = session()->get('sub_pay_name');
        $sub_payment = session()->get('sub_payment');
        $vat_sub = session()->get('vat_sub');
        $sub_total = session()->get('sub_total'); // ยอดรวมทั้งหมด

        Cart_orders::create([
            'ref_order_id' => $cardNumber,
            'customer' => $customer,
            'payment' => $pay_name,
            'payment_value' => $payment_value,
            'discount' => $discount,
            'discount_value' => $sub_discount,
            'vat3' => $vat3,
            'vat7' => $vat7,
            'price' => $price,
            'comment' => $comment,
            'sdate' => $sdate,
            'edate' => $edate,
            'total' => $total,
            'user' => Auth::user()->name,
        ]);


        // sub_payment


        // dd($payment_value);
        // $cart = session()->get('cart');
        // foreach ($cart as $item) {
        //     CartItem::create([
        //         'user_id' => Auth::id(),
        //         'product_id' => $item['id'],
        //         'product_name' => $item['name'],
        //         'price' => $item['price'],
        //         'quantity' => $item['quantity'],
        //     ]);
        // }

        Session::forget('cart');
        Session::forget('discount');
        Session::forget('sub');
        Session::forget('sub_discount');
        Session::forget('vat');
        Session::forget('total');
        Session::forget('pay_name');
        Session::forget('payment_value');
        Session::forget('sub_pay_name');
        Session::forget('sub_payment');
        Session::forget('vat_sub');
        Session::forget('sub_total');

        return to_route('ticket')->with('success','Save data Successfully.');
    }
}

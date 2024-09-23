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
        return view('ticket',compact('products','cart'));
    }

    public function addToCart( Request $request){

        // dd($request);
        $cart = session()->get('cart',[]);
        $item = [
            'id' => $request->input('id'),
            'product' => $request->input('product'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity', 1)
        ];

        dd($item);





        $cart = Session::get('cart', []);
        $item = DB::table('products')
            ->where('id',$id)
            ->get();
   

        // dd($cart);

        // If item exists in cart, increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Otherwise, add new item
            $cart[$id] = [
                "product_name" => $item[0]->product_name,
                "quantity" => 1,
                "price" => $item[0]->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('ticket')->with('success', 'Order placed successfully!');
    }   
}

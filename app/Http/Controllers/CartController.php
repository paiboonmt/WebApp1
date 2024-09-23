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

        $cart = session()->get('cart', []);

        // Get the product ID and quantity from the request
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        // If the item is already in the cart, update the quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Fetch the product from the database (optional)
            $product = DB::table('products')->where('id',$productId)->first();

            // dd($product);

            // Add the new item to the cart
            $cart[$productId] = [
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        return to_route('ticket');


    }

    // Remove item from cart
    public function remove(Request $request) {

        $cart = session()->get('cart', []);
        // Get the product ID and quantity from the request
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            if ($quantity > 0) {
                // Update the quantity
                $cart[$productId]['quantity'] = $quantity;
            } else {
                // Remove the item from the cart if quantity is 0
                unset($cart[$productId]);
            }

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            return to_route('ticket');
        }


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

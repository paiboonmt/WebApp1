<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_orders_details;

class OrderDetailsController extends Controller
{
    public function destroy(Request $request , string $id){

        dd($request);

        $data = Cart_orders_details::findOrFail($id);

        dump($data , $request);

        dd($data->id);

        // "id" => 2
        // "order_id" => "04102024081539"
        // "product_id" => "122"
        // "product_name" => "Airport Pick-up"
        // "price" => "850.00"
        // "quantity" => 1
        // "total" => "44820.45"
        // "date" => "2024-10-04"
        // "created_at" => "2024-10-04 08:15:41"
        // "updated_at" => "2024-10-04 08:15:41"

    }
}

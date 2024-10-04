<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart_orders;
use App\Models\Cart_orders_details;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index() {
        $ticketReport = Cart_orders::all();
        return view('report_index',compact('ticketReport'));
    }

    public function dastroy($id) {
        $item = Cart_orders::findOrFail($id);
        $item->delete();
        return to_route('report_index')->with('success', 'Item deleted successfully');
    }

    public function viewBill( string $id){
        $data = DB::table('cart_orders')
            ->join('cart_orders_details' , 'cart_orders.ref_order_id' , '=' , 'cart_orders_details.order_id')
            ->select('cart_orders.*','cart_orders_details.*')
            ->where('cart_orders.id',$id)
            ->get();
        return view('view_bill',compact('data'));
    }

    public function edite(string $order_id){
        $data = DB::table('cart_orders')
        ->join('cart_orders_details' , 'cart_orders.ref_order_id' , '=' , 'cart_orders_details.order_id')
        ->select('cart_orders.*','cart_orders_details.*')
        ->where('cart_orders.ref_order_id',$order_id)
        ->get();
        return view('editeBill',compact('data'));
    }
}

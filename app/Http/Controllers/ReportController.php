<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart_orders;

class ReportController extends Controller
{
    public function index() {
        $ticketReport = Cart_orders::get();
        return view('report_index',compact('ticketReport'));
    }

    public function dastroy($id){

        $Order = Cart_orders::find($id);
        $Order->delete();

        return view('report_index')->with('success','Delete data success fully');
    }
}

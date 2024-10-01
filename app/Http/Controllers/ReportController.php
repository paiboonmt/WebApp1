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
}

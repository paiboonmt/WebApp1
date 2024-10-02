<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart_orders;

class ReportController extends Controller
{
    public function index() {
        $ticketReport = Cart_orders::limit(1)->get();
        return view('report_index',compact('ticketReport'));
    }

    public function dastroy($id) {
        $item = Cart_orders::findOrFail($id);
        $item->delete();
        return to_route('report_index')->with('success', 'Item deleted successfully');
    }
}

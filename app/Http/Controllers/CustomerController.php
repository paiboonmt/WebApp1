<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){
        $Customers = DB::table('member')
            ->join('products','member.package','=','products.id')
            ->where('status_code',['4'])
            // ->limit(10)
            ->get();
        return view('customers',compact('Customers'));
    }
}

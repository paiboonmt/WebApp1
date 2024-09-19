<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $dataFighters = DB::table('member')
            ->where('status_code','3')
            ->count();

        $fighterAvtive = DB::table('member')
            ->where('status_code','3')
            ->where('exp_date','>=', date('Y-m-d'))
            ->count();

        $dataCustomer = DB::table('member')
            ->whereIn('status_code',['4','2'])
            ->count();

        $customerActive = DB::table('member')
            ->whereIn('status_code',['4','2'])
            ->where('exp_date','>=', date('Y-m-d'))
            ->count();

        return view('dashboard',compact('dataFighters','fighterAvtive','dataCustomer','customerActive'));
    }
}

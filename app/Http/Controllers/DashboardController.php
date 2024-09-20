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

        $typeTrainings = DB::table('member')
            ->select('type_training')
            ->selectRaw('count(type_training) as cc ')
            ->where('status_code','3')
            ->where('exp_date','>=', date('Y-m-d'))
            ->groupBy('type_training')
            ->orderByDesc('cc')
            ->paginate(5);

        $countProducts = DB::table('products')
            ->select('products.product_name', DB::raw('COUNT(products.id) as product_count'))
            ->join('member', 'products.id', '=', 'member.package')
            ->where('member.status_code', '4')
            ->where('member.exp_date', '>=', date('Y-m-d'))
            ->orderByDesc('product_count')
            ->groupBy('products.product_name')
            ->paginate(5);

        $countNationality = DB::table('member')
            ->select('member.nationalty', DB::raw('COUNT(member.id) as count'))
            ->where('status_code', '3')
            ->orderByDesc('count')
            ->groupBy('nationalty')
            ->limit(5)
            ->get();
        $countCheckin = DB::table('totel')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('dashboard',compact('countProducts','dataFighters','fighterAvtive','dataCustomer','customerActive','typeTrainings','countNationality','countCheckin'));
    }
}

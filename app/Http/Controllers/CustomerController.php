<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){
        $Customers = DB::table('member')
            ->join('products','member.package','=','products.id')
            ->where('status_code','4')
            ->select('member.*','products.product_name')
            ->limit(10)
            ->orderByDesc('member.id')
            ->get();
        return view('customers',compact('Customers'));
    }

    public function show( string $id){
        $data = DB::table('member')
            ->join('products','member.package','=','products.id')
            ->where('member.id',$id)
            ->select('member.*','products.product_name')
            ->get();

        //กำหนดหมายเลขบัตร
        $m_card = $data[0]->m_card;
        //กำหนดวันเกิด
        $birthday = $data[0]->birthday;
        //สร้างอ็อบเจกต์ Datetime สำหรับวันเกิด
        $birthdate = new DateTime($birthday);
        //สร้างอ็อบเจกต์ Datetime สำหรับวันปัจจุบัน
        $today = new DateTime('today');
        //คำนวนความแตกต่างระหว่างวันเกิดและวันที่ปัจจุบัน
        $age = $birthdate->diff($today)->y;

        // --------------------------------------
        // คำนวนสมาชิกวันหมดอายุ
        // กำหนดวันหมดอายุ

        $date = date('Y-m-d');
        $exp_date = $data[0]->exp_date;

        $startDate = Carbon::create($date);
        $endDate = Carbon::create($exp_date);

        $exp = (int) $startDate->diffInDays($endDate);

        $files = DB::table('tb_files')
            ->where('product_id',$id)
            ->get();

        $times = DB::table('tb_time')
            ->where('ref_m_card',$m_card)
            ->get();

        return view('customer_show',compact('data','age','exp','files','times'));
    }
}

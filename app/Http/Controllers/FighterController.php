<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FighterController extends Controller
{
    public function index(){
        $Fighters = DB::table('member')
            ->where('group','fighter')
            // ->limit(100)
            ->orderByDesc('id')
            ->get();
        return view('fighters', compact('Fighters'));
    }

    public function show( string $id ){
        $data = DB::table('member')
            ->where( 'id', $id )
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

        return view('fighter_show',compact('data','age','files','times','exp'));
    }
}

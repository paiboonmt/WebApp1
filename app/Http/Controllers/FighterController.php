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
            ->limit(10)
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

    public function create(){
        $dataNationality = DB::table('tb_nationality')->get();
        return view('fighter_create',compact('dataNationality'));
    }

    public function store( Request $request ){

        dump($request);

        // "_token" => "fdmYCYaNUGe7nzaWPYaao9HIfEcZXFFQx42vgri2"
        // "m_card" => "1234"
        // "passport" => "1234"
        // "sex" => "Male"
        // "fname" => "Paiboon Yaniwong"
        // "Email" => "it@dev.tiger"
        // "phone" => "1169"
        // "fightname" => "Thanos"
        // "nationalty" => "Croatian / Croatia"
        // "birthday" => "1985-09-18"
        // "emergency" => "1169"
        // "sta_date" => "2024-09-01"
        // "exp_date" => "2024-10-01"
        // "type_training" => "Temporary"
        // "comment" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, quam!"
        // "accom" => "Lorem ipsum dolor sit amet."

        // return to_route('fighters');
    }

}

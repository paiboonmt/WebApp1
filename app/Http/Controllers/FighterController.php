<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FighterController extends Controller
{
    public function index(){
        $Fighters = DB::table('member')
            ->where('group','fighter')
            ->limit(5)
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

    public function store( Request $request ) : RedirectResponse {

        $request->validate([
            'm_card' => 'required|unique:fighters,m_card',
            'p_visa' => 'required',
            'sex' => 'required',
            'fname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'fightname' => 'required',
            'nationality' => 'required',
            'birthday' => 'required',
            'emergency' => 'required',
            'sta_date' => 'required',
            'exp_date' => 'required',
            'type_training' => 'required',
            'comment' => 'required',
            'accom' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $newName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('image/fighter/'),$newName);

                $fighter = new Fighter;
                $fighter->m_card = $request->m_card;
                $fighter->p_visa = $request->p_visa;
                $fighter->sex = $request->sex;
                $fighter->fname = $request->fname;
                $fighter->email = $request->email;
                $fighter->phone = $request->phone;
                $fighter->fightname = $request->fightname;
                $fighter->nationality = $request->nationality;
                $fighter->birthday = $request->birthday;
                $fighter->emergency = $request->emergency;
                $fighter->sta_date = $request->sta_date;
                $fighter->exp_date = $request->exp_date;
                $fighter->type_training = $request->type_training;
                $fighter->comment = $request->comment;
                $fighter->accom = $request->accom;
                $fighter->image = $newName;

                $fighter->save();

        }


        return to_route('manage');
    }

}

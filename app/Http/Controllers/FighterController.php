<?php

namespace App\Http\Controllers;

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
        return view('fighter_show',compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\User;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index(){
        $dataFighter = Fighter::all();
        $Users = User::all();
        return view('manage',compact('dataFighter','Users'));
    }


}

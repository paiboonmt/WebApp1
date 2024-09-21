<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index(){

        $dataFighter = Fighter::all();

        return view('manage',compact('dataFighter'));
    }
}

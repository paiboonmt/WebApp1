<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $Users = User::all();
        return view('Users' , compact('Users'));
    }
}

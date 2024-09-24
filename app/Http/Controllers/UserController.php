<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(Request $request , string $id){
        $User = User::find($id);
        $User->role = $request->role;
        $User->save();
        return to_route('manage');
    }

}

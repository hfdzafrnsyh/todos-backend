<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //  
    public function index(){
        $user = User::with('getRoleRelation')->get();
        return response()->json(['users' => $user] , 200);
    }

    public function getUserTodo(){
        
        $userTodo = User::with('getUserTodo')->get();
        return response()->json(['data' => $userTodo], 200);
    }

    public function detail($id){
        $user = User::find($id);
        return response()->json(['users' => $user]);
    }


}

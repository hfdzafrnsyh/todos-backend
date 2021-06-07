<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;

class UsersRoleController extends Controller
{
    //
    public function index(){

        $userRole = UserRole::all();
        return response()->json(['user_role' => $userRole] , 200);
    }

    public function store(Request $request){
        $userRole = UserRole::create($request->all());
        return response()->json(['user_role' => $userRole], 201);
    }

    public function update(Request $request, UserRole $usersrole){
        $usersrole->update($request->all());
        return response()->json(['user_role' => $usersrole], 200);
    }
}

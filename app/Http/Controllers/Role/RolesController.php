<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    //

    
    public function index(){

        $role = Role::all();
        return response()->json(['role' => $role], 200);

    }

    public function store(Request $request){
        $role = Role::create($request->all());
        return response()->json(["role" => $role], 201);

    }


    public function detail($roles){
        $role = Role::find($roles);
        return response()->json(['role' => $role],200);
    }
    

    public function update(Request $request ,Role $role){
        $role->update($request->all());
        return response()->json([$role , 200]);
    }

    public function delete(Role $role){
        $role->delete();
        return response()->json(['message' => "Delete Successfully"]);
    }

}

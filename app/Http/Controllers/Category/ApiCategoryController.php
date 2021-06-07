<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ApiCategoryController extends Controller
{
    //

    public function index(){
        
        $categories = Category::all();
        return response()->json(['data' => $categories], 200);
    }

    public function store(Request $request){
        $categories = Category::create($request->all());
        return response()->json(['data' => $categories] , 201);
    }

    public function detail(Category $category){
        $categories = Category::find($category);
        return response()->json(['data' => $categories] , 200);
    }



    public function update(Request $request , Category $category){
        $category->update($request->all());
        return response()->json([$category , 200]);
    }

    public function delete( Category $category){
        $category->delete();
        return response()->json(["message" => "Delete Successfully"]);
    }

    public function categoryWithTodo(){
        $categories = Category::with('getCategoryWithTodo')->get();
        return response()->json(['data' => $categories], 200);
    }
}

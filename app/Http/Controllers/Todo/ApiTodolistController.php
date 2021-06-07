<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todolist;
use App\Models\Category;
use Validator;

class ApiTodolistController extends Controller
{
    //

    public function index(){
        $todos = Todolist::all();
        return response()->json(["todos" => $todos] , 200);
    }

    public function store(Request $request){
        $todos = Todolist::create($request->all());
        return response()->json(["todos" => $todos] , 201);
    }

    public function detail($todos){
        $todo = Todolist::find($todos);
        return response()->json(['todos' => $todo], 200);
    }

    public function update(Request $request , Todolist $todos){
        $todos->update($request->all());
        return response()->json([$todos , 200]);
    }

    public function delete(Todolist $todos){
        $todos->delete();
        return response()->json(["message" => "Delete Successfully"]);
    }


    // Join Table

    public function getTodoByCategoryId($todo){
      

        /* Query Builder */
        // $todos = DB::table('categories')
        // ->join('todolists' , 'categories.id' , "=" , 'todolists.category_id')
        // ->where('categories.id' , $category->id)
        // ->get();

        $todos = Category::find($todo)->getTodo;

        return response()->json(['data' => $todos] , 200);

    }

    public function detailTodoByCategoryId(Category $category , Todolist $todos){

        $todo = DB::table("categories")
        ->join('todolists' , 'categories.id' , "=" , 'todolists.category_id')
        ->where('categories.id' , $category->id)
        ->where('todolists.id' , $todos->id)
        ->get();

        // $todo = $category->with('getDetailTodo')->get();

        if($todo){
            return response()->json(['data' => $todo] , 200);
        }else{
            return response()->json(['message' => 'Id Tidak ditemukan'] , 404);
        }


        return response()->json(['data' => $todo] , 200);

    }

    public function storeTodoByCategoryId(Request $request , Category $category){
    
        $todos = Todolist::create([
            "title" => $request['title'],
            'record_todo' => $request['record_todo'],
            'user_id' => $request['user_id'],
            'category_id' => $category->id
        ]);

        return response()->json(['data' => $todos] , 201);
  
    }


    public function updateTodoByCategoryId(Request $request , Category $category ,$todos ){
     
        $todo = Todolist::find($todos);    

        if($todo){
            $todo->update([
                "title" => $request['title'],
                'record_todo' => $request['record_todo'],
                'user_id' => $request['user_id'],
                'category_id' => $category->id
            ]);
    
            return response()->json(['data' , $todo] , 200);
        }else{
            return response()->json(["message" => "Id tidak ditemukan!"] , 404);
        }
    }



    public function deleteTodoByCategoryId(Category $category ,Todolist $todos){
     
        DB::table('todolists')
        ->join('categories' , 'categories.id' ,'=' , 'todolists.category_id')
        ->where('categories.id' , $category->id)
        ->where('todolists.id' , $todos->id)
        ->delete();

        return response()->json(['message' => "Delete Success"]);
    }

}

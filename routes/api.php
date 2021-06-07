<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Category\ApiCategoryController;
use App\Http\Controllers\Todo\ApiTodolistController;
use App\Http\Controllers\Role\RolesController;
use App\Http\Controllers\Users\UsersRoleController;
use App\Http\Controllers\Users\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth
Route::post("/register" , [AuthController::class, 'register']);
Route::post("/login" , [AuthController::class , 'login']);

Route::group(['middleware' => 'auth:api'] , function(){
  
    // Auth
      Route::post('/logout' , [AuthController::class , 'logout']);

        // category
        Route::get('/category' , [ApiCategoryController::class , 'index']);
        Route::get('/categorywithtodo' , [ApiCategoryController::class, 'categoryWithTodo']);
        Route::post('/category/add' , [ApiCategoryController::class , 'store']);
        Route::get('/category/{category}' , [ApiCategoryController::class , 'detail']);
        Route::put('/category/{category}' , [ApiCategoryController::class , 'update']);
        Route::delete('/category/{category}' , [ApiCategoryController::class , 'delete']);
    
        // todos
        Route::get('/todos' , [ApiTodolistController::class , 'index']);
        Route::post('/todos/add' , [ApiTodolistController::class , 'store']);
        Route::get('/todos/{todos}' , [ApiTodolistController::class , 'detail']);
        Route::put('/todos/{todos}' , [ApiTodolistController::class , 'update']);
        Route::delete('/todos/{todos}' , [ApiTodolistController::class , 'delete']);
    
        // get todo by categoryId
        Route::get('/category/{category}/todos' , [ApiTodolistController::class , 'getTodoByCategoryId']);
        Route::get('/category/{category}/todos/{todos}' , [ApiTodolistController::class , 'detailTodoByCategoryId']);
        Route::post('/category/{category}/todos/add' , [ApiTodolistController::class , 'storeTodoByCategoryId']);
        Route::put('/category/{category}/todos/{todos}' , [ApiTodolistController::class , 'updateTodoByCategoryId']);
        Route::delete('/category/{category}/todos/{todos}' , [ApiTodolistController::class , 'deleteTodoByCategoryId']);
    
    
        // role
        Route::get('/role' , [RolesController::class, 'index']);
        Route::post('/role/add' , [RolesController::class, 'store']);
        Route::get('/role/{role}' , [RolesController::class , 'detail']);
        Route::put('/role/{role}' , [RolesController::class , 'update']);
        Route::delete('/role/{role}' , [RolesController::class , 'delete']);
    
        // user role
        Route::get('/usersrole' , [UsersRoleController::class , 'index']);
        Route::post('/usersrole/add' , [UsersRoleController::class, 'store']);
        Route::put('/usersrole/{usersrole}' , [UsersRoleController::class , 'update']);
        
    
        //user 
        Route::get('/users' , [UsersController::class , 'index']);
        Route::get('/users/todos' , [UsersController::class , 'getUserTodo']);
        Route::get('/users/{id}' , [UsersController::class , 'detail']);
       

});






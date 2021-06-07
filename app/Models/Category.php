<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    

    public function getTodo(){
        return $this->hasMany(Todolist::class);
    }

    public function getCategoryWithTodo(){
        return $this->hasOne(Todolist::class , "category_id" , "id");
    }


}

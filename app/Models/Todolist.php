<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Todolist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' , 'record_todo' , 'user_id' , 'category_id' ] ;   



        public function category(){
            return $this->belongsTo(Category::class);
        }

}

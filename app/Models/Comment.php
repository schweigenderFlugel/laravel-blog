<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    # Los comentarios pertenecen a la clase User
    public function user(){
        return $this->belongsTo(User::class); 
    }

    # Los comentarios pertenecen a la clase Artículo 
    public function articles(){
        return $this->belongsTo(Article::class); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    # Relación de uno a muchos con artículos. 
    public function articles(){
        return $this->hasMany(Article::class); 
    }

    public function getRouteKeyName()
    {
        return 'slug'; 
    }

}

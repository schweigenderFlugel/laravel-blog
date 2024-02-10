<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    # Para evitar que se asignen propiedades de forma masiva. Esto es contrario al $fillable que se encunetra en el archivo User.php
    protected $guarded = [
        'id', 
        'created_at', 
        'updated_at'
    ];

    # Relación de uno a uno (inverso)
    public function user(){
        return $this->belongsTo(User::class); 
    }

}



<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # Crear un perfil al momento de registrar el usuario
    protected static function boot(){
        parent::boot(); 
        // Asignar perfil al registrar usuario
        static::created(function($user){
            $user->profile()->create(); 
        });
    }

    # Relación de uno a uno (user-profile). También existe la relación de modo inverso (véase Profile.php)
    public function profile(){
        return $this->hasOne(Profile::class); # Tiene una sola relación con la clase Profile
    }

    # Relación de uno a muchos
    public function articles(){
        return $this->hasMany(Article::class); # Puede tener una o más relaciones con la clase Article
    }

    # Relación de uno a muchos
    public function comments(){
        return $this->hasMany(Comment::class); # Puede tener uno o más relaciones con la clase Comment
    }

    public function adminlte_image(){
        return asset('storage/'. Auth::user()->profile->photo); 
    }

    public function petitions(){
        return $this->hasOne(Petition::class); # Tiene una sola relación con la clase Profile
    }

}

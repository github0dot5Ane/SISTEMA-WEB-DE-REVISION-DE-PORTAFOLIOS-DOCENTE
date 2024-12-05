<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function isAdmin()
    {
        return $this->es_administrador;
    }

    public function isRevisor()
    {
        return $this->es_revisor;
    }

    public function isDocente()
    {
        return !$this->es_administrador && !$this->es_revisor;
    }

    public function isActive()
    {
        return $this->activo;
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'es_administrador',
        'es_revisor',
        'activo',
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
        'password' => 'hashed',
        'es_administrador' => 'boolean',
        'es_revisor' => 'boolean',
        'email_verified_at' => 'datetime',
        
    ];
}

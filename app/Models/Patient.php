<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Patient extends Model implements JWTSubject
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'sex',
        'birth_date',
        'age',
        'occupation',
        'phone',
        'user_id',
        'image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
         public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

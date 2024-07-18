<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['name','email','password','admin_id','jamaah_id','master_id', 'telp'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed'];
    protected $with = ['admin', 'jamaah', 'master'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function jamaah(){
        return $this->belongsTo(Jamaah::class);
    }
    public function master(){
        return $this->belongsTo(Master::class);
    }
    public function kas(){
        return $this->hasMany(Kas::class);
    }

}

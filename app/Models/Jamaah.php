<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'masjid_id'];
    protected $with = ['masjid'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function masjid(){
        return $this->belongsTo(Masjid::class);
    }
}

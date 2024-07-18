<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'masjid_id', 'name', 'phone', 'address', 'status', 'nominal'];
    protected $with = ['masjid', 'user'];

    public function masjid() {
        return $this->belongsTo(Masjid::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}

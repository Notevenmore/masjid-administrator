<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorypengeluaran extends Model
{
    use HasFactory;
    protected $fillable = ['masjid_id', 'nama'];
    protected $with = ['masjid'];

    public function masjid() {
        return $this->belongsTo(Masjid::class);
    }
}

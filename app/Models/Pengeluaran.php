<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = ['jumlah', 'tanggal', 'masjid_id', 'keterangan'];
    protected $with = ['masjid'];

    public function masjid(){
        return $this->belongsTo(Masjid::class);
    }

}

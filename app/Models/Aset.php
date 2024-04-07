<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = ['masjid_id','name', 'jumlah', 'satuan', 'kondisi'];
    protected $with = ['masjid'];

    public function masjid(){
        return $this->belongsTo(Masjid::class);
    }
}

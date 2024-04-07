<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasikegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'masjid_id', 'gambar', 'name', 'deskripsi', 'penanggungjawab', 'dokumen', 'alamat'];
    protected $with = ['masjid'];

    public function masjid(){
        return $this->belongsTo(Masjid::class);
    }
}

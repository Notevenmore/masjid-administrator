<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location', 'subdistrict', 'cityorregency', 'province'];

    public function scopeFilter($query, array $filters){
        return $query->where('province', 'like', '%'.$filters['province'].'%')
                     ->where('cityorregency', 'like', '%'.$filters['city'].'%')
                     ->where('subdistrict', 'like', '%'.$filters['subdistrict'].'%')
                     ->where('name', 'like', '%'.$filters['mosquename'].'%');
    }

    public function jamaah(){
        return $this->hasMany(Jamaah::class);
    }

    public function aset(){
        return $this->hasMany(Aset::class);
    }

    public function pemasukan(){
        return $this->hasMany(Pemasukan::class);
    }
    
    public function pengeluaran(){
        return $this->hasMany(Pengeluaran::class);
    }

    public function kas(){
        return $this->hasMany(Kas::class);
    }

    public function laporankeuangan(){
        return $this->hasMany(Laporankeuangan::class);
    }

    public function informasikegiatan(){
        return $this->hasMany(Informasikegiatan::class);
    }
}

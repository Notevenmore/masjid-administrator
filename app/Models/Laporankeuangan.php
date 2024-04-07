<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporankeuangan extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'pemasukan_id', 'pengeluaran_id', 'masjid_id'];
    protected $with = ['admin', 'pemasukan', 'pengeluaran', 'masjid'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function pemasukan(){
        return $this->belongsTo(Pemasukan::class);
    }

    public function pengeluaran(){
        return $this->belongsTo(Pengeluaran::class);
    }

    public function masjid(){
        return $this->belongsTo(Masjid::class);
    }

    public function scopeTable($query){
        return $query->leftJoin('pemasukans', 'laporankeuangans.pemasukan_id', '=', 'pemasukans.id')
                     ->leftJoin('pengeluarans', 'laporankeuangans.pengeluaran_id', '=', 'pengeluarans.id')
                     ->orderByRaw('COALESCE(pemasukans.tanggal, pengeluarans.tanggal) ASC');
    }

    public function scopeFilter($query, $start, $end){
        if($start && $end){
            return $query->where(function ($query) use ($start, $end) {
                $query->whereBetween('pemasukans.tanggal', [$start, $end])
                      ->orWhereBetween('pengeluarans.tanggal', [$start, $end]);
            });
        }elseif($start){
            return $query->where(function ($query) use ($start) {
                $query->where('pemasukans.tanggal', '>=', $start)
                      ->orWhere('pengeluarans.tanggal', '>=', $start);
            });
        }elseif($end){
            return $query->where(function ($query) use ($end) {
                $query->where('pemasukans.tanggal', '<', $end)
                      ->orWhere('pengeluarans.tanggal', '<', $end);
            });
        }

        return $query;
    }
}

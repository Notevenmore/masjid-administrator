<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grafikpengeluaran extends Model
{
    use HasFactory;

    public function pengeluaran(){
        return $this->hasMany(Pengeluaran::class);
    }
}

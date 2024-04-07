<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grafikpemasukan extends Model
{
    use HasFactory;

    public function pemasukan(){
        return $this->hasMany(Pemasukan::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasikegiatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('alamat');
            $table->foreignIdFor(App\Models\Masjid::class);
            $table->string('gambar')->nullable();
            $table->string('name');
            $table->text('deskripsi');
            $table->string('penanggungjawab');
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasikegiatans');
    }
};

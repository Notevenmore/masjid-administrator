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
        Schema::create('laporankeuangans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Admin::class);
            $table->foreignIdFor(\App\Models\Pemasukan::class)->nullable();
            $table->foreignIdFor(\App\Models\Pengeluaran::class)->nullable();
            $table->foreignIdFor(\App\Models\Masjid::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporankeuangans');
    }
};

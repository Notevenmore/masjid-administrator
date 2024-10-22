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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Admin::class);
            $table->foreignIdFor(App\Models\Master::class);
            $table->foreignIdFor(App\Models\Jamaah::class);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telp');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

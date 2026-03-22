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
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->id('id_pelaporan');

            $table->string('nis');
            $table->unsignedBigInteger('id_category');

            $table->string('lokasi', 50);
            $table->string('ket', 50);

            $table->timestamps();

            // FK
            $table->foreign('nis')
                ->references('nis')->on('siswa')
                ->onDelete('cascade');

            $table->foreign('id_category')
                ->references('id_category')->on('category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};

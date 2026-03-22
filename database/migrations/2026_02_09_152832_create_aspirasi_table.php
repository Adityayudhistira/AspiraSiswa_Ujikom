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
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');

            $table->unsignedBigInteger('id_pelaporan');
            $table->unsignedBigInteger('id_category');

            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])
                ->default('Menunggu');

            $table->text('feedback')->nullable();

            $table->timestamps();

            // FK
            $table->foreign('id_pelaporan')
                ->references('id_pelaporan')
                ->on('input_aspirasi')
                ->onDelete('cascade');

            $table->foreign('id_category')
                ->references('id_category')
                ->on('category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};

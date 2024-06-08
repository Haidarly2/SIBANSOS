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
        Schema::create('m_penerima', function (Blueprint $table) {
            $table->id('id_penerima');
            $table->unsignedBigInteger('id_bansos')->index();
            $table->unsignedBigInteger('id_warga')->index();
            $table->integer('pendapatan');
            $table->integer('pln');
            $table->integer('pdam');
            $table->integer('status_kesehatan');
            $table->integer('status_rumah');
            $table->string('status');
            $table->double('skoredas');
            $table->double('skoresaw');
            $table->timestamps();

            $table->foreign('id_bansos')->references('id_bansos')->on('m_bansos');
            $table->foreign('id_warga')->references('id_warga')->on('m_warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_penerima');
    }
};

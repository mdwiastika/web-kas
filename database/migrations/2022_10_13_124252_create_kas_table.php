<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id('id_kas');
            $table->string('jenis');
            $table->integer('nominal');
            $table->timestamp('tanggal_kas');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('kondisi_kas', ['Masuk', 'Keluar']);
            $table->string('keterangan')->default('Tidak Ada Keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('kategori_id');                
            $table->string('kode');                
            $table->string('nama');                
            $table->text('deskripsi');                
            $table->double('qty',12,2)->default(0);                
            $table->string('satuan');
            $table->double('harga',12,2)->default(0);                
            $table->string('status');
            $table->foreign('kategori_id')->references('id')->on('kategoris');
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
        Schema::dropIfExists('produks');
    }
}

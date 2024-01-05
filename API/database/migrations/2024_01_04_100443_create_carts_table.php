<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('pembeli');
            $table->string('no_invoice');
            $table->string('status_cart');
            $table->string('status_pembayaran');
            $table->double('subtotal', 12, 2)->default(0)->nullable();
            $table->double('diskon', 12, 2)->default(0)->nullable();
            $table->double('total', 12, 2)->default(0)->nullable();
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
        Schema::dropIfExists('carts');
    }
}

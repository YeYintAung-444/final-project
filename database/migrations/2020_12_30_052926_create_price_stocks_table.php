<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('pc_price');
            $table->string('dozen_price');
            $table->string('set_price');
            $table->integer('pcs_count');
            $table->integer('dozens_count');
            $table->integer('sets_count');
            $table->timestamps();
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_stocks');
    }
}

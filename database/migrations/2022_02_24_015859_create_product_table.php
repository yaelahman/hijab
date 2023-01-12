<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_category')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('whatsapp')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('status')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();

            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}

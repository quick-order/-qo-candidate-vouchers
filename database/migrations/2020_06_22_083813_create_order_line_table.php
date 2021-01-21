<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')
                ->nullable();
            $table->integer('order_id')
                ->unsigned();
            $table->integer('product_id')
                ->unsigned()
                ->nullable();
            $table->integer('amount_each');
            $table->integer('amount_total');
            $table->integer('quantity');
            $table->timestamps();

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders');

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_lines');
    }
}

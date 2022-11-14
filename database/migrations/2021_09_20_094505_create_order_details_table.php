<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                    ->constrained('products')
                    ->onDelete('cascade');
            $table->foreignId('order_id')
                    ->constrained('orders')
                    ->onDelete('cascade');
            $table->string('product_name', 100);
            $table->decimal('price', 18, 2);
            $table->integer('quantity');
            $table->string('color_id',2)->nullable();
            $table->string('size_id',2)->nullable();
            $table->decimal('total_price', 18, 2);
            $table->softDeletes();
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
        Schema::dropIfExists('order_details');
    }
}

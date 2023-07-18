<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('code');
            $table->string('barcode');
            $table->enum('status', ['imported', 'out_of_stock']);
            $table->timestamp('imported_t');
            $table->string('url');
            $table->string('product_name');
            $table->bigIncrements('id');       
            $table->string('quantity');
            $table->text('categories');
            $table->text('packaging');
            $table->string('brands');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
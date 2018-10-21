<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vp_products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->float('product_price');
            $table->string('product_image');
            $table->string('product_warranty');
            $table->string('product_accessories');
            $table->string('product_condition');
            $table->string('product_promotion');
            $table->tinyInteger('product_status');
            $table->text('product_description');
            $table->tinyInteger('product_featured');
            $table->integer('product_category')->unsigned();
            $table->foreign('product_category')
                ->references('category_id')
                ->on('vp_categories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('vp_products');
    }
}

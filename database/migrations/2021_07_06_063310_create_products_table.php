<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_name_hin');
            $table->string('product_slug_en');
            $table->string('product_slug_hin');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tag_en');
            $table->string('product_tag_hin');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_hin')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_hin');
            $table->float('selling_price');
            $table->float('discount_price')->nullable();
            $table->text('short_description_en');
            $table->text('short_description_hin');
            $table->longText('long_description_en');
            $table->longText('long_description_hin');
            $table->string('product_thambnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
}

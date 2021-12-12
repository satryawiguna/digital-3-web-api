<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('product_type_id');
            $table->dateTime('publish');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->string('year', 5)->nullable();
            $table->tinyInteger('rating', false, false)->default(0);
            $table->string('director', 50)->nullable();
            $table->string('duration', 25)->nullable();
            $table->string('media_type')->nullable();
            $table->text('actors')->nullable();
            $table->tinyInteger('status', false, false)->default(0)->comment('0: draft, 1: publish, 2: pendding');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_type_id')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}

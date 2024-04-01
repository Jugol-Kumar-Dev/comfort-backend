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
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('description')->nullable();
            $table->longText('details')->nullable();

            $table->mediumText('warranty')->nullable();
            $table->longText('features')->nullable();
            $table->longText('video_url')->nullable();


            $table->string('sku')->nullable();
            $table->integer('stock')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();

            $table->json('variations')->nullable();
            $table->json('variationOptions')->nullable();

            $table->string('photo')->nullable();
            $table->string('root')->nullable();
            $table->integer('price');
            $table->integer('discount');
            $table->string('size')->default(0);
            $table->enum('status', ['active','inactive'])->default('active');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Una receta tendrá varios productos
         */
        Schema::create('recipe_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained(); # Código de la receta
            $table->foreignId('product_id')->constrained(); # Código del producto
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
        Schema::dropIfExists('recipe_products');
    }
};

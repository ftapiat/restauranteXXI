<?php

use App\Models\Recipe;
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
        Schema::create('table_client_dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_client_id')->constrained();
            $table->foreignId('dish_id')->constrained((new Recipe())->getTable()); # "Plato", se refiere a la receta
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
        Schema::dropIfExists('table_client_dishes');
    }
};

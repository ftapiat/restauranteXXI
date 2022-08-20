<?php

use App\Models\User;
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
        $userTable = (new User())->getTable();

        Schema::create('orders', function (Blueprint $table) use ($userTable){
            $table->id();
            $table->foreignId('table_id')->constrained();
            $table->foreignId('client_id')->constrained($userTable); # Es un usuario
            $table->foreignId('waiter_id')->constrained($userTable); # Mesero
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
        Schema::dropIfExists('orders');
    }
};

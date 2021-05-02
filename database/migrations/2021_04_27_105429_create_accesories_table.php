<?php

use App\Models\Accesories;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesories', function (Blueprint $table) {
            $table->id();
            $table->integer('accesories_list')->unsigned();
            $table->integer('quantity');
            $table->integer('remaining');
            $table->decimal('amount',18,8);
            $table->decimal('rate',18,8);
            $table->string('trx_id');
            $table->string('status')->default(Accesories::ACTIVE);
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
        Schema::dropIfExists('accesories');
    }
}

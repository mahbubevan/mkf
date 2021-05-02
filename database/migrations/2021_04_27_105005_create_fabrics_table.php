<?php

use App\Models\Fabric;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('yards',18,8)->default(0);
            $table->decimal('amount',18,8)->default(0);
            $table->decimal('rate',18,8)->default(0);
            $table->string('trx_id');
            $table->integer('expected_pant');
            $table->boolean('status')->default(Fabric::AVAIL);
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
        Schema::dropIfExists('fabrics');
    }
}

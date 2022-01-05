<?php

use App\Models\SubContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('buyer_name');
            $table->text('details');
            $table->integer('quantity');
            $table->decimal('rate',18,2);
            $table->decimal('total_amount',18,2);
            $table->string('status')->default(SubContract::PENDING);
            $table->string('work_status')->default(SubContract::CUTTING);
            $table->string('payment_status')->default(SubContract::UNPAID);
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
        Schema::dropIfExists('sub_contracts');
    }
}

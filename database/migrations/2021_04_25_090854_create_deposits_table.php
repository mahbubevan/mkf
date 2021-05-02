<?php

use App\Models\Deposit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->string('method_name')->nullable();
            $table->decimal('amount', 18, 8)->default(0);
            $table->string('currency')->nullable();
            $table->decimal('convertion_rate', 18, 8)->default(0);
            $table->decimal('new_amount', 18, 8)->default(0);
            $table->decimal('charge', 18, 8)->default(0);
            $table->decimal('final_amount', 18, 8)->default(0);
            $table->string('status')->default(Deposit::PENDING);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}

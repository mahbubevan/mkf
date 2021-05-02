<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('currency')->nullable();
            $table->longText('mail')->nullable();
            $table->decimal('deposit_charge', 18, 8)->nullable();
            $table->decimal('withdraw_charge', 18, 8)->nullable();
            $table->decimal('transfer_charge', 18, 8)->nullable();
            $table->string('registration_status')->nullable();
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
        Schema::dropIfExists('settings');
    }
}

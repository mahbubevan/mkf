<?php

use App\Models\SalarySheet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_sheets', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unsigned();
            $table->integer('working_days')->unsigned();
            $table->integer('working_hours')->unsigned();
            $table->decimal('salary',18,8);
            $table->boolean('status')->default(SalarySheet::NOT_PAID);
            $table->string('trx_id');
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
        Schema::dropIfExists('salary_sheets');
    }
}

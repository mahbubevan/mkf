<?php

use App\Models\Attendance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unsigned();
            $table->boolean('attendance')->default(Attendance::PRESENT);
            $table->time('entry')->nullable();
            $table->time('exit_time')->nullable();
            $table->string('entry_remarks')->nullable();
            $table->string('exit_remarks')->nullable();
            $table->string('absent_remarks')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}

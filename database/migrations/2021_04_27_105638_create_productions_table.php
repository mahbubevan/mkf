<?php

use App\Models\Production;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->integer('fabric_id')->unsigned();
            $table->longText('accesories_count');
            $table->longText('sizes');
            $table->string('code');
            $table->text('pattern_name')->nullable();
            $table->string('model_name')->nullable();
            $table->string('image');
            $table->integer('pant_quantity');
            $table->integer('stock')->default(0);
            $table->decimal('ex_p_cost', 18, 8)->default(0);
            $table->decimal('ex_sale', 18, 8)->default(0);
            $table->boolean('status')->default(Production::CUTTING);
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
        Schema::dropIfExists('productions');
    }
}

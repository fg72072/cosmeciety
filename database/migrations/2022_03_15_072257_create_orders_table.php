<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('status');
            $table->float('subtotal');
            $table->float('tax')->nullable()->default(0);
            $table->float('discount')->nullable()->default(0);
            $table->float('grand_total');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile');
            $table->string('address');
            $table->string('country_id');
            $table->string('city_id');
            $table->string('postal_code');
            $table->softDeletes();
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
}

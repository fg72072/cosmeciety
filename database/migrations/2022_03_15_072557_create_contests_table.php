<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('banner');
            $table->string('title');
            $table->text('description');
            $table->float('entry_fee');
            $table->string('contest_start_date')->nullable();
            $table->string('contest_end_date')->nullable();
            $table->string('acceptance_date')->nullable();
            $table->string('post_live_date')->nullable();
            $table->string('announce_date')->nullable();
            $table->string('status')->enum(['0','1'])->default('0')->nullable();
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
        Schema::dropIfExists('contests');
    }
}

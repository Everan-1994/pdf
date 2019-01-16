<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('count_id');
            $table->char('month', 2);
            $table->integer('pension')->default(0)->comment('养老');
            $table->integer('medical')->default(0)->comment('医疗');
            $table->integer('unemployment')->default(0)->comment('失业');
            $table->integer('work_injury')->default(0)->comment('工伤');
            $table->integer('fertility')->default(0)->comment('生育');
            $table->string('status')->nullable()->comment('缴费状态');
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
        Schema::dropIfExists('statistics');
    }
}

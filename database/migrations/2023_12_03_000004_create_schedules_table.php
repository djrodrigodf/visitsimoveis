<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('broker');
            $table->string('boker_mail');
            $table->string('buyer');
            $table->string('buyer_mail');
            $table->datetime('schedule');
            $table->string('address');
            $table->string('buyer_signature')->nullable();
            $table->string('broker_signature')->nullable();
            $table->string('file')->nullable();
            $table->longText('time_stamp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

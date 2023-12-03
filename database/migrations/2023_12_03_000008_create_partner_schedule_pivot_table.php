<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerSchedulePivotTable extends Migration
{
    public function up()
    {
        Schema::create('partner_schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id', 'schedule_id_fk_9268050')->references('id')->on('schedules')->onDelete('cascade');
            $table->unsignedBigInteger('partner_id');
            $table->foreign('partner_id', 'partner_id_fk_9268050')->references('id')->on('partners')->onDelete('cascade');
        });
    }
}

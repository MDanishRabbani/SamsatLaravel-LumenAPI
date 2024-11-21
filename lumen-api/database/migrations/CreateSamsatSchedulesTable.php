<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamsatSchedulesTable extends Migration
{
    public function up() {
        Schema::create('samsat_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('samsat_id');
            $table->string('day');
            $table->string('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->foreign('samsat_id')->references('id')->on('samsat')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('samsat_schedules');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('samsat_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('samsat_id')->constrained('samsat')->onDelete('cascade');
            $table->string('day');
            $table->string('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
        });
    }

    public function down()
    {
        Schema::dropIfExists('samsat_schedules');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('route', function (Blueprint $table) {
            $table->id();
            $table->string('route_name',100)->nullable();
            $table->string('start_point',100)->nullable();
            $table->string('start_time',100)->nullable();
            $table->string('end_point',100)->nullable();
            $table->string('end_time',100)->nullable();
            $table->decimal('distance',5,2)->nullable();
            $table->integer('estimated_time')->nullable();
            $table->enum('status',['active','inactive'])->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route');
    }
};
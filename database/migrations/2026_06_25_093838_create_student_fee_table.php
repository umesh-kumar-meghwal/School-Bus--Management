<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_fee', function (Blueprint $table) {
            $table->id();
            $table->string('st_email',100)->nullable();
            $table->string('stop_name',100)->nullable();
            $table->string('total_fee',100)->nullable();
            $table->integer('deposit_fee')->nullable();
            $table->integer('due_fee')->nullable();
            $table->string('date',100)->nullable();
            $table->string('time',100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('father_name',100)->nullable();
            $table->string('mother_name',100)->nullable();
            $table->string('mobile',100)->nullable();
            $table->string('guardians_mobile',100)->nullable();
            $table->string('depart_name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('route_name',100)->nullable();
            $table->string('stop_name',100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('photo',100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
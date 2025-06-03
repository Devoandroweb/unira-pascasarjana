<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->enum('position', ['lecturer', 'educators']);
            $table->enum('is_user', [0, 1]);
            $table->string('phone');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('google_scholar')->nullable();
            $table->string('sinta')->nullable();
            $table->string('journal')->nullable();
            $table->string('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};

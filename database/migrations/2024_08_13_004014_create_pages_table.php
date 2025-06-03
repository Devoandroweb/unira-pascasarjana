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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->text('video')->nullable();
            $table->text('table')->nullable();
            $table->enum('type', ['static','dynamic'])->default('dynamic');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_active', ['0', '1'])->default('1')->comment('1 Active 0 Inactive');
            $table->integer('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

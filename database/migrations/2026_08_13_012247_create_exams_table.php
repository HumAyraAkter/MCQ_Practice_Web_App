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
    Schema::create('exams', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->text('description')->nullable();
        $table->integer('duration_minutes');
        $table->decimal('positive_mark', 5, 2)->default(1);
        $table->decimal('negative_mark', 5, 2)->default(0);
        $table->boolean('is_premium')->default(false);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

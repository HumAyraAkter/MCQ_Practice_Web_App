<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'admin'])->default('student')->after('email');
            $table->enum('account_type', ['free', 'premium'])->default('free')->after('role');
            $table->string('institution')->nullable()->after('account_type');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'account_type', 'institution']);
        });
    }
};
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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('streak_count')->default(0);
            $table->date('last_transaction_date')->nullable();
            $table->boolean('is_public')->default(false);
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['streak_count', 'last_transaction_date', 'is_public']);
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};

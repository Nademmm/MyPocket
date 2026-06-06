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
        // Improvements for transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
            $table->index(['user_id', 'transaction_date']);
            $table->index('type');
        });

        // Improvements for targets table
        Schema::table('targets', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
            $table->index(['user_id', 'deadline']);
            $table->index('status');
        });

        // Improvements for reminders table
        Schema::table('reminders', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
            $table->index(['user_id', 'remind_date']);
            $table->index('is_active');
        });

        // Improvements for saving_diaries table
        Schema::table('saving_diaries', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
            $table->index(['user_id', 'diary_date']);
        });

        // Improvements for users table - ensure decimal consistency
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('total_saved', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['user_id', 'transaction_date']);
            $table->dropIndex(['type']);
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['user_id', 'deadline']);
            $table->dropIndex(['status']);
        });

        Schema::table('reminders', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['user_id', 'remind_date']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('saving_diaries', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['user_id', 'diary_date']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('total_saved', 12, 2)->change();
        });
    }
};

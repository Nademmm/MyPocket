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
        // 1. Users table (Consolidated)
        Schema::table('users', function (Blueprint $table) {
            // Check if columns exist before adding (to avoid errors if they are already there)
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'admin'])->default('user')->after('email');
            }
            if (!Schema::hasColumn('users', 'total_saved')) {
                $table->decimal('total_saved', 15, 2)->default(0)->after('role');
            }
            if (!Schema::hasColumn('users', 'level')) {
                $table->integer('level')->default(1)->after('total_saved');
            }
        });

        // 2. Categories table
        // Already exists, just ensure it's correct
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (!Schema::hasColumn('categories', 'icon')) {
                    $table->string('icon')->nullable()->after('name');
                }
            });
        }

        // 3. Transactions table (Improved)
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                // Ensure decimal precision
                $table->decimal('amount', 15, 2)->change();
                
                // Add SoftDeletes if not exists
                if (!Schema::hasColumn('transactions', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        // 4. Targets table (Improved)
        if (Schema::hasTable('targets')) {
            Schema::table('targets', function (Blueprint $table) {
                $table->decimal('target_amount', 15, 2)->change();
                $table->decimal('current_amount', 15, 2)->default(0)->change();
                
                if (!Schema::hasColumn('targets', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        // 5. Reminders table (Improved)
        if (Schema::hasTable('reminders')) {
            Schema::table('reminders', function (Blueprint $table) {
                if (!Schema::hasColumn('reminders', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        // 6. Saving Diaries table (Improved)
        if (Schema::hasTable('saving_diaries')) {
            Schema::table('saving_diaries', function (Blueprint $table) {
                if (!Schema::hasColumn('saving_diaries', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down for this consolidated migration
    }
};

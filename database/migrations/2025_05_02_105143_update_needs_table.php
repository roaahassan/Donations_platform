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
        Schema::table('needs', function (Blueprint $table) {
            // التحقق من وجود العمود قبل إضافته
            if (!Schema::hasColumn('needs', 'need_type')) {
                $table->string('need_type')->default('need')->after('isUrgent');
            }

            if (!Schema::hasColumn('needs', 'national_id')) {
                $table->string('national_id', 20)->unique()->nullable(false)->after('need_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('needs', function (Blueprint $table) {
            // Revert the changes
            // حذف حقل رقم الهوية
            $table->dropColumn('national_id');
            // حذف حقل نوع الحوجة
            $table->dropColumn('need_type');
        });
    }
};
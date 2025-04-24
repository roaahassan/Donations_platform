<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDonationsTable extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // تعديل الحقل amount لتحديد الدقة
            $table->decimal('amount', 10, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // إعادة الحقل إلى حالته الأصلية
            $table->decimal('amount')->change();
        });
    }
}
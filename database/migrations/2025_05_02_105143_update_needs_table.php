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
            $table->string('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->string('status')->default('pending')->change();
            $table->decimal('amount', 10, 2)->nullable(false)->change();
            $table->decimal('collected_amount', 10, 2)->default(0)->change();
            $table->string('image_path')->nullable()->change();
            $table->string('supp_doc')->nullable()->change();
            $table->boolean('isUrgent')->default(false)->change();
            $table->date('rqst_date')->nullable(false)->change();

            // إضافة حقل نوع الحوجة
            $table->string('need_type')->default('need')->after('isUrgent'); // القيم الافتراضية: 'need' أو 'project'
             // إضافة حقل رقم الهوية
             $table->string('national_number')->unique()->after('need_type'); // يمكن أن يكون null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('needs', function (Blueprint $table) {
            // Revert the changes
            $table->string('title')->change();
            $table->text('description')->change();
            $table->string('status')->change();
            $table->decimal('amount')->change();
            $table->decimal('collected_amount')->change();
            $table->string('image_path')->change();
            $table->string('supp_doc')->change();
            $table->boolean('isUrgent')->change();
            $table->date('rqst_date')->change();

            // حذف حقل نوع الحوجة
            $table->dropColumn('need_type');
        });
    }
};
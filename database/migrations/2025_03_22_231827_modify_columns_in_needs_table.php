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
            $table->decimal('collected_amount')->nullable()->default(0)->change();
            $table->string('image_path')->nullable()->change();
            $table->string('supp_doc')->nullable()->change();
            $table->boolean('isUrgent')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('needs', function (Blueprint $table) {
            $table->decimal('collected_amount')->default(0)->change();
            $table->string('image_path')->nullable()->change();
            $table->string('supp_doc')->nullable()->change();
            $table->boolean('isUrgent')->default(false)->change();
        });
    }
};
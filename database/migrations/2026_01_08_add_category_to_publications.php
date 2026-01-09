<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk menambahkan kategori artikel
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
return new class extends Migration
{
    /**
     * Menambahkan kolom category
     */
    public function up(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->string('category', 100)->default('General')->after('featured_image');
            $table->index('category'); // Index untuk filter cepat
        });
    }

    /**
     * Rollback - hapus kolom category
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropColumn('category');
        });
    }
};
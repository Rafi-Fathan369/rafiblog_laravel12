<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel publications
 * Struktur kustom untuk sistem blog NexaBlog
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel publications
     * Tabel ini menyimpan semua artikel/konten blog
     */
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            // Primary Key
            $table->id('publication_id');
            
            // Kolom Konten Utama
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->longText('content');
            
            // Metadata Publikasi
            $table->string('author_name', 150)->default('Rafi Fathan Gandari');
            $table->string('author_nim', 50)->default('C2383207002');
            $table->date('published_date')->nullable();
            
            // Featured Image
            $table->string('featured_image', 255)->nullable(); // Path gambar artikel
            
            // Status Publikasi (draft/publish)
            $table->enum('publication_status', ['draft', 'publish'])->default('draft');
            
            // Fitur Tambahan (SEO & Analytics)
            $table->text('excerpt')->nullable(); // Ringkasan artikel
            $table->integer('view_count')->default(0); // Jumlah view
            $table->integer('reading_time')->nullable(); // Estimasi waktu baca (menit)
            
            // Timestamps Laravel
            $table->timestamps();
            $table->softDeletes(); // Soft delete untuk safety
            
            // Indexes untuk optimasi query
            $table->index('publication_status');
            $table->index('published_date');
            $table->index('slug');
        });
    }

    /**
     * Rollback migration - menghapus tabel publications
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
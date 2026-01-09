<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Seeder untuk mengisi data awal tabel publications
 * Berisi artikel sample yang realistis dan profesional
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class PublicationSeeder extends Seeder
{
    /**
     * Data sample artikel untuk Rafi Blog
     */
    public function run(): void
    {
        
        $imagePath = public_path('images/articles');
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0755, true);
        }

        $publications = [
            [
                'title' => 'Memahami Arsitektur MVC dalam Pengembangan Web Modern',
                'slug' => 'memahami-arsitektur-mvc-dalam-pengembangan-web-modern',
                'content' => '<h2>Pendahuluan</h2><p>Model-View-Controller (MVC) adalah pola arsitektur yang memisahkan aplikasi menjadi tiga komponen utama: Model (data dan logika bisnis), View (tampilan pengguna), dan Controller (penghubung antara Model dan View).</p><h2>Keuntungan MVC</h2><p>Dengan menggunakan MVC, kode menjadi lebih terorganisir, mudah di-maintain, dan memungkinkan kolaborasi tim yang lebih baik. Laravel sendiri menerapkan pattern MVC secara konsisten di seluruh framework-nya.</p><h2>Implementasi di Laravel</h2><p>Laravel menyediakan struktur folder yang jelas: Models di app/Models, Views di resources/views, dan Controllers di app/Http/Controllers. Setiap komponen memiliki tanggung jawab yang spesifik dan terpisah.</p><p>Pemisahan ini membuat aplikasi lebih scalable dan testable. Developer dapat bekerja pada bagian yang berbeda tanpa mengganggu komponen lainnya.</p>',
                'excerpt' => 'Pelajari bagaimana pattern MVC membuat aplikasi web lebih terstruktur dan mudah di-maintain dengan studi kasus Laravel framework.',
                'published_date' => '2026-01-05',
                'publication_status' => 'publish',
                'reading_time' => 5,
                'view_count' => 142,
                'featured_image' => 'articles/mvc-architecture.jpg',
                'category' => 'Laravel'
            ],
            [
                'title' => 'Laravel Migration: Database Version Control untuk Developer',
                'slug' => 'laravel-migration-database-version-control-untuk-developer',
                'content' => '<h2>Apa itu Migration?</h2><p>Migration adalah sistem version control untuk database. Dengan migration, kita bisa mendefinisikan struktur database menggunakan kode PHP, sehingga mudah dibagikan dan di-track perubahannya.</p><h2>Keunggulan Migration</h2><p>Migration memungkinkan tim development bekerja dengan database schema yang konsisten. Setiap perubahan struktur database tercatat dengan baik dan bisa di-rollback jika diperlukan.</p><h2>Best Practices</h2><p>Gunakan naming convention yang jelas, pisahkan migration per fitur, dan selalu buat rollback method. Jangan modifikasi migration yang sudah di-commit ke production.</p><p>Laravel migration juga mendukung berbagai tipe kolom dan constraint, membuat pengelolaan database menjadi lebih profesional dan enterprise-ready.</p>',
                'excerpt' => 'Migration adalah fitur powerful Laravel untuk mengelola database schema dengan version control yang profesional.',
                'published_date' => '2026-01-03',
                'publication_status' => 'publish',
                'reading_time' => 4,
                'view_count' => 98,
                'featured_image' => 'articles/laravel-migration.jpg',
                'category' => 'Laravel'
            ],
            [
                'title' => 'Blade Templating: Membuat UI yang Reusable dan Efisien',
                'slug' => 'blade-templating-membuat-ui-yang-reusable-dan-efisien',
                'content' => '<h2>Pengenalan Blade</h2><p>Blade adalah templating engine bawaan Laravel yang powerful dan mudah digunakan. Dengan syntax yang clean, Blade memungkinkan kita menulis template HTML dengan logika PHP tanpa menulis tag PHP yang kompleks.</p><h2>Fitur Utama</h2><p>Blade menyediakan template inheritance, components, slots, dan berbagai directive yang mempercepat development. Sistem layouting Blade memungkinkan pembuatan template yang modular dan reusable.</p><h2>Performance</h2><p>Meskipun menggunakan syntax tambahan, Blade di-compile menjadi PHP murni dan di-cache, sehingga tidak ada performance overhead. Blade views bahkan bisa lebih cepat karena optimasi yang dilakukan Laravel.</p>',
                'excerpt' => 'Pelajari cara menggunakan Blade templating engine untuk membuat view yang modular, reusable, dan high-performance.',
                'published_date' => '2026-01-01',
                'publication_status' => 'publish',
                'reading_time' => 6,
                'view_count' => 176,
                'featured_image' => 'articles/blade-templating.jpg',
                'category' => 'Web Development'
            ],
            [
                'title' => 'Middleware Laravel: Gatekeeper untuk Aplikasi Anda',
                'slug' => 'middleware-laravel-gatekeeper-untuk-aplikasi-anda',
                'content' => '<h2>Konsep Middleware</h2><p>Middleware adalah layer yang berdiri di antara request dan response. Middleware berfungsi sebagai filter yang bisa memeriksa, memodifikasi, atau menolak HTTP request sebelum mencapai controller.</p><h2>Use Cases</h2><p>Middleware sangat berguna untuk authentication, authorization, logging, CORS handling, dan validasi request. Laravel sudah menyediakan beberapa middleware bawaan yang siap pakai.</p><h2>Custom Middleware</h2><p>Membuat custom middleware sangat mudah dengan artisan command. Kita bisa mendefinisikan logika spesifik untuk kebutuhan aplikasi, seperti checking role user atau rate limiting API.</p><p>Middleware dapat di-assign ke route individual, route group, atau bahkan globally untuk seluruh aplikasi.</p>',
                'excerpt' => 'Middleware adalah komponen penting dalam Laravel untuk filtering HTTP request dan protecting aplikasi routes.',
                'published_date' => '2025-12-30',
                'publication_status' => 'publish',
                'reading_time' => 5,
                'view_count' => 203,
                'featured_image' => 'articles/middleware-laravel.jpg',
                'category' => 'Laravel'
            ],
            [
                'title' => 'Eloquent ORM: Database Made Easy dengan Active Record Pattern',
                'slug' => 'eloquent-orm-database-made-easy-dengan-active-record-pattern',
                'content' => '<h2>Tentang Eloquent</h2><p>Eloquent adalah Object-Relational Mapping (ORM) milik Laravel yang mengimplementasikan Active Record pattern. Dengan Eloquent, bekerja dengan database menjadi semudah bekerja dengan object PHP.</p><h2>Keunggulan Eloquent</h2><p>Query menjadi lebih readable dan maintainable. Eloquent menyediakan method chaining yang elegant untuk building complex queries tanpa menulis raw SQL.</p><h2>Relationships</h2><p>Eloquent mendukung berbagai tipe relationship: one-to-one, one-to-many, many-to-many, dan polymorphic relations. Eager loading dan lazy loading membuat query optimization menjadi mudah.</p><p>Fitur soft deletes, timestamps otomatis, dan attribute casting membuat development lebih produktif dan code lebih clean.</p>',
                'excerpt' => 'Eloquent ORM membuat interaksi dengan database menjadi intuitive dengan Active Record pattern dan method chaining yang elegant.',
                'published_date' => '2025-12-28',
                'publication_status' => 'draft',
                'reading_time' => 7,
                'view_count' => 0,
                'featured_image' => 'articles/eloquent-orm.jpg',
                'category' => 'Database'
            ]
        ];

        // Insert data ke database
        foreach ($publications as $publication) {
            DB::table('publications')->insert([
                'title' => $publication['title'],
                'slug' => $publication['slug'],
                'content' => $publication['content'],
                'excerpt' => $publication['excerpt'],
                'author_name' => 'Rafi Fathan Gandari',
                'author_nim' => 'C2383207002',
                'published_date' => $publication['published_date'],
                'publication_status' => $publication['publication_status'],
                'reading_time' => $publication['reading_time'],
                'view_count' => $publication['view_count'],
                'featured_image' => $publication['featured_image'],
                'category' => $publication['category'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Generate placeholder images (optional - untuk development)
        $this->generatePlaceholderImages();
    }

    /**
     * Generate placeholder images untuk development
     */
    private function generatePlaceholderImages()
    {
        $imagePath = public_path('images/articles');
        $images = [
            'mvc-architecture.jpg',
            'laravel-migration.jpg',
            'blade-templating.jpg',
            'middleware-laravel.jpg',
            'eloquent-orm.jpg'
        ];

        // Jika imagemagick atau GD tersedia, bisa generate placeholder
        // Untuk sekarang, kita buat file kosong sebagai placeholder
        foreach ($images as $image) {
            $filePath = $imagePath . '/' . $image;
            if (!file_exists($filePath)) {
                // Create a simple placeholder file
                touch($filePath);
            }
        }
    }
}
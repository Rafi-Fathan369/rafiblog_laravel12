
## Identitas Mahasiswa

**Nama:** Rafi Fathan Gandari  
**NIM:** C2383207002  
**Kelas:** PTI 5A  
**Mata Kuliah:** Pemrograman Internet  
**Dosen:** Taofik Muhammad, M.Kom  

## Deskripsi

Rafi Blog adalah aplikasi web blog yang saya buat menggunakan framework Laravel. Project ini dibuat untuk Ujian Akhir Semester (UAS) mata kuliah Pemrograman Internet.
Tujuan dari project ini adalah untuk menerapkan materi yang sudah dipelajari selama perkuliahan, khususnya tentang pembuatan aplikasi web berbasis database menggunakan konsep MVC. Menggunakan migration untuk basis data dan Seeder untuk data awal


## Fitur Utama

**Area Publik:**
- Homepage dengan grid layout artikel dan featured images
- Real-time search artikel
- Filter berdasarkan 8 kategori
- Detail artikel dengan related posts
- Dark/Light mode toggle dengan persistence
- Fully responsive (mobile, tablet, desktop)
- Animasi smooth dan particle effects

**Area Admin:**
- Dashboard dengan statistik real-time
- CRUD artikel lengkap
- Upload featured image (JPEG, PNG, GIF, WEBP - max 2MB)
- 8 kategori: Laravel, PHP, JavaScript, Web Development, Database, Tutorial, Tips & Tricks, General
- Search dan filter artikel
- Status Draft/Publish
- Preview sebelum publish
- Auto slug generation
- Auto reading time calculation

## Teknologi

- **Framework:** Laravel 12
- **PHP:** 8.2+
- **Database:** MySQL / MariaDB
- **Frontend:** Blade Template Engine + Tailwind CSS 
- **Icons:** Heroicons
- **Fonts:** Google Fonts - Inter


## Struktur Database

**Tabel:** publications

Kolom utama: publication_id (PK), title, slug, content, excerpt, featured_image, category, author_name, author_nim, published_date, publication_status, view_count, reading_time, timestamps, soft deletes

## Instalasi

1. Clone repository
```bash
git clone https://github.com/username/rafi-blog.git
cd rafi-blog
```

2. Install dependencies
```bash
composer install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database
```
Buat database: nexablog_db
Edit .env sesuai konfigurasi lokal
```

5. Migrasi dan seeding
```bash
php artisan migrate
php artisan db:seed --class=PublicationSeeder
```

6. Set permission (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache public/images
```

7. Jalankan aplikasi
```bash
php artisan serve
```

Akses di http://localhost:8000



Login di: http://localhost:8000/admin/login

## Keunikan Implementasi

- Nama tabel custom: `publications` (bukan posts)
- Primary key: `publication_id` (bukan id)
- 3 controller terpisah: FrontendController, AdminPanelController, ContentManagementController
- Custom middleware: AdminAccessMiddleware
- Custom animations: float, glow, shimmer, gradient-shift, particle effects
- Search terintegrasi dengan filter kategori
- Eloquent scopes: published(), draft(), latest(), category()
- Image management lengkap: upload, replace, delete
- Soft delete implementation
- View counter otomatis
- Dark mode dengan localStorage

## Arsitektur MVC

**Model:** Publication.php dengan Eloquent ORM, scopes, accessors, mutators

**View:** Blade templates terpisah untuk frontend (public) dan admin

**Controller:** 
- FrontendController: Handle public pages
- AdminPanelController: Authentication & dashboard
- ContentManagementController: CRUD operations

## Testing Checklist

- Homepage dan responsiveness
- Search functionality
- Category filter
- Article detail page
- Dark/light mode toggle
- Admin login
- Create article dengan image upload
- Edit article dan replace image
- Delete article
- View counter increment
- Pagination
- Form validation
- CSRF protection
- Middleware protection

## Troubleshooting

**Gambar tidak muncul:**
```bash
mkdir -p public/images/articles
chmod -R 775 public/images
```

**Kalo Up gagal:**
Check php.ini: upload_max_filesize = 2M, post_max_size = 3M

**Migration error:**
```bash
php artisan migrate:fresh
php artisan db:seed
```



## Jadi 

Project ini menerapkan:
- Arsitektur MVC konsisten
- Database Migration dan Seeder
- Eloquent ORM advanced features
- File upload dengan validation
- Session-based authentication
- Custom middleware untuk authorization
- Responsive design dengan Tailwind CSS
- JavaScript animations dan DOM manipulation
- Clean code dan documentation

## Kontak

**Rafi Fathan Gandari**  
NIM: C2383207002  
Email: rafifathangandari09@gmail.com 

GitHub: github.com/Rafi-Fathan369

## Lisensi

Project untuk Ujian Akhir Semester - Pemrograman Internet  
Fakultas Keguruan dan Ilmu Pendidikan  
Universitas Muhammadiyah Tasikmalaya

Copyright 2026 Rafi Fathan Gandari

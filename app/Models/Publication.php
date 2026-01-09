<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Model Publication untuk Rafi Blog
 * Mengelola data artikel/konten blog dengan featured image
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class Publication extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel database
     */
    protected $table = 'publications';

    /**
     * Primary key kustom
     */
    protected $primaryKey = 'publication_id';

    /**
     * Kolom yang dapat diisi mass assignment
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'author_name',
        'author_nim',
        'published_date',
        'publication_status',
        'reading_time',
        'view_count',
        'featured_image',
        'category'
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'published_date' => 'date',
        'view_count' => 'integer',
        'reading_time' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Default values
     */
    protected $attributes = [
        'author_name' => 'Rafi Fathan Gandari',
        'author_nim' => 'C2383207002',
        'publication_status' => 'draft',
        'view_count' => 0,
        'category' => 'General'
    ];

    /**
     * Event boot - auto generate slug dari title
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug sebelum create
        static::creating(function ($publication) {
            if (empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
            }
            
            // Auto-calculate reading time (rata-rata 200 kata per menit)
            if (empty($publication->reading_time)) {
                $wordCount = str_word_count(strip_tags($publication->content));
                $publication->reading_time = max(1, ceil($wordCount / 200));
            }
        });

        // Update slug jika title berubah
        static::updating(function ($publication) {
            if ($publication->isDirty('title') && !$publication->isDirty('slug')) {
                $publication->slug = Str::slug($publication->title);
            }
            
            // Recalculate reading time jika content berubah
            if ($publication->isDirty('content') && !$publication->isDirty('reading_time')) {
                $wordCount = str_word_count(strip_tags($publication->content));
                $publication->reading_time = max(1, ceil($wordCount / 200));
            }
        });
    }

    /**
     * Scope: Hanya artikel yang sudah publish
     */
    public function scopePublished($query)
    {
        return $query->where('publication_status', 'publish')
                    ->whereNotNull('published_date')
                    ->where('published_date', '<=', now());
    }

    /**
     * Scope: Hanya draft
     */
    public function scopeDraft($query)
    {
        return $query->where('publication_status', 'draft');
    }

    /**
     * Scope: Order by latest published date
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_date', 'desc')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Scope: Filter by category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get available categories
     */
    public static function getCategories(): array
    {
        return [
            'Laravel' => 'Laravel',
            'PHP' => 'PHP',
            'JavaScript' => 'JavaScript',
            'Web Development' => 'Web Development',
            'Database' => 'Database',
            'Tutorial' => 'Tutorial',
            'Tips & Tricks' => 'Tips & Tricks',
            'General' => 'General'
        ];
    }

    /**
     * Get category badge color
     */
    public function getCategoryColorAttribute(): string
    {
        $colors = [
            'Laravel' => 'bg-red-500',
            'PHP' => 'bg-indigo-500',
            'JavaScript' => 'bg-yellow-500',
            'Web Development' => 'bg-green-500',
            'Database' => 'bg-blue-500',
            'Tutorial' => 'bg-purple-500',
            'Tips & Tricks' => 'bg-pink-500',
            'General' => 'bg-gray-500'
        ];
        
        return $colors[$this->category] ?? 'bg-gray-500';
    }

    /**
     * Accessor: Format tanggal publikasi ke Indonesia
     */
    public function getFormattedDateAttribute()
    {
        if (!$this->published_date) {
            return 'Belum dipublikasi';
        }
        
        return $this->published_date->locale('id')->isoFormat('D MMMM Y');
    }

    /**
     * Accessor: Excerpt otomatis jika kosong
     */
    public function getExcerptAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        
        // Generate excerpt dari content (150 karakter pertama)
        $cleanContent = strip_tags($this->content);
        return Str::limit($cleanContent, 150);
    }

    /**
     * Method: Increment view count
     */
    public function incrementViews()
    {
        $this->increment('view_count');
    }

    /**
     * Method: Check apakah artikel sudah publish
     */
    public function isPublished(): bool
    {
        return $this->publication_status === 'publish' 
            && $this->published_date 
            && $this->published_date->isPast();
    }

    /**
     * Method: Get URL artikel
     */
    public function getUrlAttribute(): string
    {
        return route('article.show', $this->slug);
    }

    /**
     * Accessor: Get full image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }
        
        // Jika sudah full URL (http/https)
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            return $this->featured_image;
        }
        
        // Path relatif dari public
        return asset($this->featured_image);
    }

    /**
     * Method: Check apakah memiliki featured image
     */
    public function hasImage(): bool
    {
        return !empty($this->featured_image) && file_exists(public_path($this->featured_image));
    }

    /**
     * Method: Get image path untuk deletion
     */
    public function getImagePath(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }
        
        return public_path($this->featured_image);
    }
}
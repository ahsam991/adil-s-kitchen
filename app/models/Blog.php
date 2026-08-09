<?php
/**
 * Blog Model
 */

class Blog extends Model {
    protected $table = 'blogs';
    protected $fillable = ['title', 'slug', 'content', 'image', 'status', 'published_at', 'is_active'];

    public function findBySlug(string $slug): ?array {
        return $this->firstWhere('slug', $slug);
    }
}

<?php
/**
 * Category Model
 */

class Category extends Model {
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'description', 'image', 'sort_order', 'is_active'];

    public function findBySlug(string $slug): ?array {
        return $this->firstWhere('slug', $slug);
    }
}

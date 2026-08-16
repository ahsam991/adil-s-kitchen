<?php
/**
 * Product Model
 */

class Product extends Model {
    protected $table = 'products';
    protected $fillable = ['category_id', 'name', 'slug', 'sku', 'short_description', 'description', 'price', 'sale_price', 'stock', 'weight', 'image', 'featured', 'best_seller', 'status', 'seo_title', 'seo_description', 'is_active'];

    public function findBySlug(string $slug): ?array {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.slug = :slug AND p.deleted_at IS NULL LIMIT 1";
        return $this->db->fetchOne($sql, ['slug' => $slug]);
    }

    public function getFeatured(int $limit = 8): array {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.featured = 1 AND p.status = 'active' AND p.deleted_at IS NULL
                ORDER BY p.created_at DESC LIMIT {$limit}";
        return $this->db->fetchAll($sql);
    }

    public function getBestSellers(int $limit = 8): array {
        $sql = "SELECT p.*, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.best_seller = 1 AND p.status = 'active' AND p.deleted_at IS NULL
                ORDER BY p.created_at DESC LIMIT {$limit}";
        return $this->db->fetchAll($sql);
    }

    public function getRelated(int $categoryId, int $excludeProductId, int $limit = 4): array {
        $sql = "SELECT p.*, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :category_id AND p.id != :exclude_id AND p.status = 'active' AND p.deleted_at IS NULL
                ORDER BY RAND() LIMIT {$limit}";
        return $this->db->fetchAll($sql, ['category_id' => $categoryId, 'exclude_id' => $excludeProductId]);
    }
}

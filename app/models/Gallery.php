<?php
/**
 * Gallery Model
 */

class Gallery extends Model {
    protected $table = 'gallery';
    protected $fillable = ['title', 'image', 'category', 'featured', 'sort_order', 'is_active'];
}

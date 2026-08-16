<?php
/**
 * OrderItem Model
 */

class OrderItem extends Model {
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'product_name', 'quantity', 'price', 'total', 'options', 'is_active'];
}

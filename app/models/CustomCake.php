<?php
/**
 * CustomCake Model
 */

class CustomCake extends Model {
    protected $table = 'custom_cakes';
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_phone', 'shape', 'flavor',
        'weight', 'cream_type', 'decoration', 'photo', 'occasion', 'cake_message',
        'delivery_date', 'budget', 'notes', 'status', 'is_active'
    ];
}

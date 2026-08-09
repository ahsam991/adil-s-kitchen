<?php
/**
 * ContactMessage Model
 */

class ContactMessage extends Model {
    protected $table = 'contact_messages';
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'status', 'is_active'];
}

<?php
/**
 * Setting Model
 */

class Setting extends Model {
    protected $table = 'settings';
    protected $fillable = ['setting_key', 'setting_value', 'is_active'];

    public static function get(string $key, $default = null) {
        $db = Database::getInstance();
        $res = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = :key AND deleted_at IS NULL LIMIT 1", ['key' => $key]);
        return $res ? $res['setting_value'] : $default;
    }

    public static function set(string $key, $value): void {
        $db = Database::getInstance();
        $existing = $db->fetchOne("SELECT id FROM settings WHERE setting_key = :key LIMIT 1", ['key' => $key]);
        if ($existing) {
            $db->update('settings', ['setting_value' => $value, 'updated_at' => date('Y-m-d H:i:s')], "setting_key = :key", ['key' => $key]);
        } else {
            $db->insert('settings', ['setting_key' => $key, 'setting_value' => $value, 'created_at' => date('Y-m-d H:i:s')]);
        }
    }
}

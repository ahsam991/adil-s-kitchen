<?php
/**
 * Inventory Model
 */

class Inventory extends Model {
    protected $table = 'inventory';
    protected $fillable = ['item_name', 'unit', 'current_stock', 'alert_stock', 'is_active'];

    public function logStock(int $inventoryId, string $type, float $quantity, ?string $notes = null): int {
        return $this->db->insert('inventory_logs', [
            'inventory_id' => $inventoryId,
            'type' => $type,
            'quantity' => $quantity,
            'notes' => $notes,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}

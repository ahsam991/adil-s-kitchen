<?php
/**
 * Base Model Class
 * All models extend this class with repository pattern support
 */

class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $hidden = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function find(int $id): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id AND deleted_at IS NULL";
        return $this->db->fetchOne($sql, ['id' => $id]);
    }

    public function findAll(array $conditions = [], string $orderBy = 'created_at DESC', int $limit = null): array {
        $sql = "SELECT * FROM {$this->table} WHERE deleted_at IS NULL";
        $params = [];

        foreach ($conditions as $column => $value) {
            $sql .= " AND {$column} = :{$column}";
            $params[$column] = $value;
        }

        $sql .= " ORDER BY {$orderBy}";

        if ($limit !== null) {
            $sql .= " LIMIT {$limit}";
        }

        return $this->db->fetchAll($sql, $params);
    }

    public function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $filteredData = $this->filterFillable($data);
        return $this->db->insert($this->table, $filteredData);
    }

    public function update(int $id, array $data): int {
        $data['updated_at'] = date('Y-m-d H:i:s');

        $filteredData = $this->filterFillable($data);
        return $this->db->update($this->table, $filteredData, "{$this->primaryKey} = :id", ['id' => $id]);
    }

    public function delete(int $id): int {
        return $this->db->softDelete($this->table, (string) $id);
    }

    public function forceDelete(int $id): int {
        return $this->db->delete($this->table, "{$this->primaryKey} = :id", ['id' => $id]);
    }

    public function count(array $conditions = []): int {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE deleted_at IS NULL";
        $params = [];

        foreach ($conditions as $column => $value) {
            $sql .= " AND {$column} = :{$column}";
            $params[$column] = $value;
        }

        $result = $this->db->fetchOne($sql, $params);
        return (int) ($result['count'] ?? 0);
    }

    public function paginate(int $page = 1, int $perPage = 12, array $conditions = [], string $orderBy = 'created_at DESC'): array {
        $offset = ($page - 1) * $perPage;

        $whereClause = '';
        $params = [];

        foreach ($conditions as $column => $value) {
            $whereClause .= " AND {$column} = :{$column}";
            $params[$column] = $value;
        }

        $countSql = "SELECT COUNT(*) as count FROM {$this->table} WHERE deleted_at IS NULL {$whereClause}";
        $total = (int) ($this->db->fetchOne($countSql, $params)['count'] ?? 0);

        $sql = "SELECT * FROM {$this->table} WHERE deleted_at IS NULL {$whereClause} ORDER BY {$orderBy} LIMIT {$perPage} OFFSET {$offset}";
        $items = $this->db->fetchAll($sql, $params);

        return [
            'items' => $items,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => (int) ceil($total / max(1, $perPage)),
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $total),
        ];
    }

    public function where(string $column, string $operator, $value, string $orderBy = 'created_at DESC'): array {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} :value AND deleted_at IS NULL ORDER BY {$orderBy}";
        return $this->db->fetchAll($sql, ['value' => $value]);
    }

    public function firstWhere(string $column, $value): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = :value AND deleted_at IS NULL LIMIT 1";
        return $this->db->fetchOne($sql, ['value' => $value]);
    }

    protected function filterFillable(array $data): array {
        if (empty($this->fillable)) {
            return $data;
        }

        return array_intersect_key($data, array_flip($this->fillable));
    }

    protected function hideSensitive(array $data): array {
        foreach ($this->hidden as $field) {
            unset($data[$field]);
        }
        return $data;
    }
}

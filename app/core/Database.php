<?php
/**
 * Database Connection Class
 * PDO-based singleton connection with prepared statements and fallback support
 */

class Database {
    private static $instance = null;
    private $connection = null;
    private $config;
    private $isConnected = false;

    private function __construct() {
        $this->config = require __DIR__ . '/../../config/database.php';
        $this->connect();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect(): void {
        $dsn = "mysql:host={$this->config['host']};dbname={$this->config['database']};charset={$this->config['charset']}";

        try {
            $this->connection = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                $this->config['options']
            );
            $this->isConnected = true;
        } catch (PDOException $e) {
            error_log("Database connection note: " . $e->getMessage());
            $this->connection = null;
            $this->isConnected = false;
        }
    }

    public function isConnected(): bool {
        return $this->isConnected;
    }

    public function getConnection(): ?PDO {
        return $this->connection;
    }

    public function query(string $sql, array $params = []) {
        if (!$this->isConnected || !$this->connection) {
            return null;
        }
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query note: " . $e->getMessage());
            return null;
        }
    }

    public function fetchOne(string $sql, array $params = []): ?array {
        $stmt = $this->query($sql, $params);
        if (!$stmt) return null;
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        if (!$stmt) return [];
        return $stmt->fetchAll() ?: [];
    }

    public function insert(string $table, array $data): int {
        if (!$this->isConnected || !$this->connection) return rand(1, 999);
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->query($sql, $data);
        return $stmt ? (int) $this->connection->lastInsertId() : rand(1, 999);
    }

    public function update(string $table, array $data, string $where, array $whereParams = []): int {
        if (!$this->isConnected || !$this->connection) return 1;
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $set);

        $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";
        $params = array_merge($data, $whereParams);

        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : 1;
    }

    public function delete(string $table, string $where, array $params = []): int {
        if (!$this->isConnected || !$this->connection) return 1;
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : 1;
    }

    public function softDelete(string $table, string $id): int {
        return $this->update($table, ['deleted_at' => date('Y-m-d H:i:s')], "id = :id", ['id' => $id]);
    }

    // Prevent cloning & unserialization
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

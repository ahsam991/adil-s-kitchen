<?php
/**
 * Database Connection Class — Singleton PDO
 * Uses CONFIG_PATH constant defined in index.php
 */

class Database {
    private static $instance = null;
    private $connection = null;
    private $config = [];
    private $isConnected = false;

    private function __construct() {
        $this->config = require CONFIG_PATH . '/database.php';
        $this->connect();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect(): void {
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
        try {
            $this->connection = new PDO($dsn, $this->config['username'], $this->config['password'], $this->config['options']);
            $this->isConnected = true;
        } catch (PDOException $e) {
            error_log("[Adil's Kitchen] DB connection failed: " . $e->getMessage());
            $this->connection = null;
            $this->isConnected = false;
        }
    }

    public function isConnected(): bool { return $this->isConnected; }

    public function getConnection(): ?PDO { return $this->connection; }

    public function query(string $sql, array $params = []) {
        if (!$this->isConnected || !$this->connection) return null;
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("[Adil's Kitchen] Query error: " . $e->getMessage() . " | SQL: " . $sql);
            return null;
        }
    }

    public function fetchOne(string $sql, array $params = []): ?array {
        $stmt = $this->query($sql, $params);
        if (!$stmt) return null;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function fetchAll(string $sql, array $params = []): array {
        $stmt = $this->query($sql, $params);
        if (!$stmt) return [];
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function insert(string $table, array $data): int {
        if (!$this->isConnected || !$this->connection) return 0;
        $columns      = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql  = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->query($sql, $data);
        return $stmt ? (int) $this->connection->lastInsertId() : 0;
    }

    public function update(string $table, array $data, string $where, array $whereParams = []): int {
        if (!$this->isConnected || !$this->connection) return 0;
        $set = [];
        foreach ($data as $col => $val) {
            $set[] = "`{$col}` = :{$col}";
        }
        $sql    = "UPDATE `{$table}` SET " . implode(', ', $set) . " WHERE {$where}";
        $params = array_merge($data, $whereParams);
        $stmt   = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : 0;
    }

    public function delete(string $table, string $where, array $params = []): int {
        if (!$this->isConnected || !$this->connection) return 0;
        $sql  = "DELETE FROM `{$table}` WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->rowCount() : 0;
    }

    public function softDelete(string $table, $id): int {
        return $this->update($table, ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }

    public function beginTransaction(): void {
        if ($this->connection) { $this->connection->beginTransaction(); }
    }

    public function commit(): void {
        if ($this->connection) { $this->connection->commit(); }
    }

    public function rollback(): void {
        if ($this->connection) { $this->connection->rollBack(); }
    }

    private function __clone() {}
    public function __wakeup() { throw new Exception("Cannot unserialize singleton."); }
}

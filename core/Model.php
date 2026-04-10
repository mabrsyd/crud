<?php

require_once __DIR__ . "/../config/Database.php";

// Kelas dasar model yang berisi operasi CRUD umum.
abstract class Model
{
    protected PDO $conn;
    protected string $table = "";

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // Mengambil semua data pada tabel aktif.
    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Mengambil satu data berdasarkan ID.
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();

        return $data !== false ? $data : null;
    }

    // Menghapus data berdasarkan ID.
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(["id" => $id]);
    }
}

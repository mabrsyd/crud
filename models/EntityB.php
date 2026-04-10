<?php

require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../config/StarterPack.php";

// Model untuk master data sisi B pada relasi.
class EntityB extends Model
{
    protected string $table = "";

    public function __construct()
    {
        parent::__construct();
        $this->table = StarterPackConfig::table("entityB");
    }

    // Menyimpan data entityB baru.
    public function create(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nama) VALUES (:nama)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "nama" => $data["nama"],
        ]);
    }

    // Mengubah data entityB berdasarkan ID.
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE {$this->table} SET nama = :nama WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "id" => $id,
            "nama" => $data["nama"],
        ]);
    }
}

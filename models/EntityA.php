<?php

require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../config/StarterPack.php";

// Model untuk master data sisi A pada relasi.
class EntityA extends Model
{
    protected string $table = "";

    public function __construct()
    {
        parent::__construct();
        $this->table = StarterPackConfig::table("entityA");
    }

    // Menyimpan data entityA baru.
    public function create(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nama) VALUES (:nama)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "nama" => $data["nama"],
        ]);
    }

    // Mengubah data entityA berdasarkan ID.
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

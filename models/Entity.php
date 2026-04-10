<?php

require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../config/StarterPack.php";

class Entity extends Model
{
    protected string $table = "";

    public function __construct()
    {
        parent::__construct();
        $this->table = StarterPackConfig::table("entity");
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nama, keterangan) VALUES (:nama, :keterangan)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "nama" => $data["nama"],
            "keterangan" => $data["keterangan"] ?? null,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE {$this->table} SET nama = :nama, keterangan = :keterangan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "id" => $id,
            "nama" => $data["nama"],
            "keterangan" => $data["keterangan"] ?? null,
        ]);
    }
}

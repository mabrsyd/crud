<?php

require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../config/StarterPack.php";

class EntityA extends Model
{
    protected string $table = "";

    public function __construct()
    {
        parent::__construct();
        $this->table = StarterPackConfig::table("entityA");
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO {$this->table} (nama) VALUES (:nama)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "nama" => $data["nama"],
        ]);
    }

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

<?php

require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../config/StarterPack.php";

// Model relasi untuk membaca data join dan menyimpan transaksi relasi.
class Relation extends Model
{
    protected string $table = "";

    public function __construct()
    {
        parent::__construct();
        $this->table = StarterPackConfig::table("relation");
    }

    // Mengambil data relasi lengkap dengan nama dari tabel master A dan B.
    public function allWithJoin(): array
    {
        $tableEntityA = StarterPackConfig::table("entityA");
        $tableEntityB = StarterPackConfig::table("entityB");
        $fkEntityA = StarterPackConfig::relationColumn("entityAColumn");
        $fkEntityB = StarterPackConfig::relationColumn("entityBColumn");
        $tanggalColumn = StarterPackConfig::relationColumn("dateColumn");

        $sql = "
            SELECT
                r.id,
                r.{$fkEntityA} AS entity_a_id,
                r.{$fkEntityB} AS entity_b_id,
                r.{$tanggalColumn} AS tanggal,
                a.nama AS nama_a,
                b.nama AS nama_b
            FROM {$this->table} r
            INNER JOIN {$tableEntityA} a ON a.id = r.{$fkEntityA}
            INNER JOIN {$tableEntityB} b ON b.id = r.{$fkEntityB}
            ORDER BY r.id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Mengambil opsi dropdown untuk master A.
    public function getEntityA(): array
    {
        $tableEntityA = StarterPackConfig::table("entityA");
        $sql = "SELECT id, nama FROM {$tableEntityA} ORDER BY nama ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Mengambil opsi dropdown untuk master B.
    public function getEntityB(): array
    {
        $tableEntityB = StarterPackConfig::table("entityB");
        $sql = "SELECT id, nama FROM {$tableEntityB} ORDER BY nama ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Menyimpan relasi baru sesuai konfigurasi kolom dinamis.
    public function create(array $data): bool
    {
        $fkEntityA = StarterPackConfig::relationColumn("entityAColumn");
        $fkEntityB = StarterPackConfig::relationColumn("entityBColumn");
        $tanggalColumn = StarterPackConfig::relationColumn("dateColumn");

        $sql = "
            INSERT INTO {$this->table} ({$fkEntityA}, {$fkEntityB}, {$tanggalColumn})
            VALUES (:{$fkEntityA}, :{$fkEntityB}, :{$tanggalColumn})
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $fkEntityA => $data[$fkEntityA],
            $fkEntityB => $data[$fkEntityB],
            $tanggalColumn => $data[$tanggalColumn],
        ]);
    }
}

<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Relation.php";
require_once __DIR__ . "/../helpers/Validator.php";
require_once __DIR__ . "/../helpers/Debug.php";
require_once __DIR__ . "/../config/StarterPack.php";

// Controller untuk data relasi (join + dropdown + simpan relasi).
class RelationController extends Controller
{
    private Relation $model;

    public function __construct()
    {
        $this->model = new Relation();
    }

    // Menampilkan daftar relasi dengan hasil JOIN.
    public function index(): void
    {
        $items = $this->model->allWithJoin();
        $moduleLabel = StarterPackConfig::label("relation");

        $this->view("relation/index", [
            "title" => "Data " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "entityALabel" => StarterPackConfig::label("entityA"),
            "entityBLabel" => StarterPackConfig::label("entityB"),
            "items" => $items,
        ]);
    }

    // Menampilkan form relasi beserta data dropdown dari master A dan B.
    public function create(): void
    {
        $moduleLabel = StarterPackConfig::label("relation");
        $entityAOptions = $this->model->getEntityA();
        $entityBOptions = $this->model->getEntityB();
        $entityAField = StarterPackConfig::relationColumn("entityAColumn");
        $entityBField = StarterPackConfig::relationColumn("entityBColumn");
        $dateField = StarterPackConfig::relationColumn("dateColumn");

        // Contoh debugging data dropdown.
        if (isset($_GET["debug"]) && $_GET["debug"] === "1") {
            Debug::dd([
                "entityA" => $entityAOptions,
                "entityB" => $entityBOptions,
            ]);
        }

        $this->view("relation/create", [
            "title" => "Tambah " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "entityALabel" => StarterPackConfig::label("entityA"),
            "entityBLabel" => StarterPackConfig::label("entityB"),
            "entityAOptions" => $entityAOptions,
            "entityBOptions" => $entityBOptions,
            "entityAField" => $entityAField,
            "entityBField" => $entityBField,
            "dateField" => $dateField,
        ]);
    }

    // Memproses simpan relasi baru dari form create.
    public function store(): void
    {
        $moduleLabel = StarterPackConfig::label("relation");
        $moduleLabelLower = strtolower($moduleLabel);
        $entityAField = StarterPackConfig::relationColumn("entityAColumn");
        $entityBField = StarterPackConfig::relationColumn("entityBColumn");
        $dateField = StarterPackConfig::relationColumn("dateColumn");

        $data = [
            $entityAField => trim($_POST[$entityAField] ?? ""),
            $entityBField => trim($_POST[$entityBField] ?? ""),
            $dateField => trim($_POST[$dateField] ?? ""),
        ];

        $errors = Validator::required($data, [$entityAField, $entityBField, $dateField]);
        if (!empty($errors)) {
            Debug::dd($errors);
            $this->redirect($this->buildUrl("create", "Semua field wajib diisi."));
        }

        $success = $this->model->create($data);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil ditambahkan."
            : "Gagal menambahkan data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    // Menghapus data relasi berdasarkan ID.
    public function delete(int $id = 0): void
    {
        $moduleLabel = StarterPackConfig::label("relation");
        $moduleLabelLower = strtolower($moduleLabel);

        if ($id <= 0) {
            $this->redirect($this->buildUrl("index", "ID tidak valid."));
        }

        $success = $this->model->delete($id);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil dihapus."
            : "Gagal menghapus data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    private function buildUrl(string $action, string $message = "", ?int $id = null): string
    {
        $url = BASE_URL . "?controller=relation&action=" . $action;

        if ($id !== null) {
            $url .= "&id=" . $id;
        }

        if ($message !== "") {
            $url .= "&message=" . urlencode($message);
        }

        return $url;
    }
}

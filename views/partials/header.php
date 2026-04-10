<?php
// Partial header: menyiapkan judul, menu, dan style umum seluruh halaman.
$pageTitle = $title ?? "MVC Template SKKNI";
$currentController = $_GET["controller"] ?? "entity";
$message = $_GET["message"] ?? "";

$appTitle = class_exists("StarterPackConfig")
    ? StarterPackConfig::APP_TITLE
    : "Template MVC SKKNI";

$labelEntity = class_exists("StarterPackConfig")
    ? StarterPackConfig::label("entity")
    : "Entity";

$labelEntityA = class_exists("StarterPackConfig")
    ? StarterPackConfig::label("entityA")
    : "Entity A";

$labelEntityB = class_exists("StarterPackConfig")
    ? StarterPackConfig::label("entityB")
    : "Entity B";

$labelRelation = class_exists("StarterPackConfig")
    ? StarterPackConfig::label("relation")
    : "Relation";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <style>
        :root {
            --bg: #f1f5f9;
            --card: #ffffff;
            --primary: #0f766e;
            --primary-dark: #115e59;
            --danger: #b91c1c;
            --text: #0f172a;
            --muted: #475569;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #e2e8f0 0%, #f8fafc 240px);
            color: var(--text);
        }

        .container {
            width: min(1100px, 92%);
            margin: 0 auto;
        }

        .site-header {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .nav-wrap {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 0;
        }

        .site-header h1 {
            margin: 0;
            font-size: 18px;
        }

        nav {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
        }

        nav a.active,
        nav a:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .page {
            padding: 20px 0 28px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 18px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
        }

        .card-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .card-head h2 {
            margin: 0;
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border: 0;
            border-radius: 8px;
            padding: 8px 14px;
            background: var(--primary);
            color: #ffffff;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #64748b;
            color: #ffffff;
        }

        .btn-danger {
            background: var(--danger);
            color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid var(--border);
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px;
            font: inherit;
            margin-bottom: 12px;
        }

        .alert {
            margin: 0 0 16px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #ecfeff;
            border: 1px solid #a5f3fc;
            color: #155e75;
        }

        .site-footer {
            border-top: 1px solid var(--border);
            color: var(--muted);
            background: var(--card);
            padding: 14px 0;
        }

        @media (max-width: 768px) {
            .card-head {
                flex-direction: column;
                align-items: flex-start;
            }

            th,
            td {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <h1><?= htmlspecialchars($appTitle); ?></h1>
            <nav>
                <a class="<?= $currentController === "entity" ? "active" : ""; ?>" href="<?= BASE_URL; ?>?controller=entity&action=index"><?= htmlspecialchars($labelEntity); ?></a>
                <a class="<?= $currentController === "entityA" ? "active" : ""; ?>" href="<?= BASE_URL; ?>?controller=entityA&action=index"><?= htmlspecialchars($labelEntityA); ?></a>
                <a class="<?= $currentController === "entityB" ? "active" : ""; ?>" href="<?= BASE_URL; ?>?controller=entityB&action=index"><?= htmlspecialchars($labelEntityB); ?></a>
                <a class="<?= $currentController === "relation" ? "active" : ""; ?>" href="<?= BASE_URL; ?>?controller=relation&action=index"><?= htmlspecialchars($labelRelation); ?></a>
            </nav>
        </div>
    </header>

    <main class="container page">
        <?php if ($message !== ""): ?>
            <p class="alert"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>

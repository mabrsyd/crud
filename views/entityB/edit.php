<?php require_once __DIR__ . "/../partials/header.php"; ?>

<?php $item = $item ?? ["id" => 0, "nama" => ""]; ?>
<?php $moduleLabel = $moduleLabel ?? "Entity B"; ?>

<section class="card">
    <h2><?= htmlspecialchars($title ?? ("Ubah " . $moduleLabel)); ?></h2>

    <form method="POST" action="<?= BASE_URL; ?>?controller=entityB&action=update">
        <input type="hidden" name="id" value="<?= (int) $item["id"]; ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($item["nama"]); ?>" required>

        <div class="actions">
            <button class="btn" type="submit">Update</button>
            <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=entityB&action=index">Kembali</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>

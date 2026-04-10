<?php require_once __DIR__ . "/../partials/header.php"; ?>

<!-- Halaman form ubah data entity. -->

<?php $item = $item ?? ["id" => 0, "nama" => "", "keterangan" => ""]; ?>
<?php $moduleLabel = $moduleLabel ?? "Entity"; ?>

<section class="card">
    <h2><?= htmlspecialchars($title ?? ("Ubah " . $moduleLabel)); ?></h2>

    <form method="POST" action="<?= BASE_URL; ?>?controller=entity&action=update">
        <input type="hidden" name="id" value="<?= (int) $item["id"]; ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($item["nama"]); ?>" required>

        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="4"><?= htmlspecialchars($item["keterangan"] ?? ""); ?></textarea>

        <div class="actions">
            <button class="btn" type="submit">Update</button>
            <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=entity&action=index">Kembali</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>

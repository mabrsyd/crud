<?php require_once __DIR__ . "/../partials/header.php"; ?>

<?php $moduleLabel = $moduleLabel ?? "Entity B"; ?>

<section class="card">
    <h2><?= htmlspecialchars($title ?? ("Tambah " . $moduleLabel)); ?></h2>

    <form method="POST" action="<?= BASE_URL; ?>?controller=entityB&action=store">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Contoh: Kategori" required>

        <div class="actions">
            <button class="btn" type="submit">Simpan</button>
            <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=entityB&action=index">Kembali</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>

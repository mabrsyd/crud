<?php require_once __DIR__ . "/../partials/header.php"; ?>

<!-- Halaman form tambah relasi dengan dropdown dinamis. -->

<?php $entityAOptions = $entityAOptions ?? []; ?>
<?php $entityBOptions = $entityBOptions ?? []; ?>
<?php $moduleLabel = $moduleLabel ?? "Relation"; ?>
<?php $entityALabel = $entityALabel ?? "Entity A"; ?>
<?php $entityBLabel = $entityBLabel ?? "Entity B"; ?>
<?php $entityAField = $entityAField ?? "entity_a_id"; ?>
<?php $entityBField = $entityBField ?? "entity_b_id"; ?>
<?php $dateField = $dateField ?? "tanggal"; ?>

<section class="card">
    <h2><?= htmlspecialchars($title ?? ("Tambah " . $moduleLabel)); ?></h2>

    <form method="POST" action="<?= BASE_URL; ?>?controller=relation&action=store">
        <label for="<?= htmlspecialchars($entityAField); ?>"><?= htmlspecialchars($entityALabel); ?></label>
        <select id="<?= htmlspecialchars($entityAField); ?>" name="<?= htmlspecialchars($entityAField); ?>" required>
            <option value="">-- pilih --</option>
            <?php foreach ($entityAOptions as $entityA): ?>
                <option value="<?= (int) $entityA["id"]; ?>"><?= htmlspecialchars($entityA["nama"]); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="<?= htmlspecialchars($entityBField); ?>"><?= htmlspecialchars($entityBLabel); ?></label>
        <select id="<?= htmlspecialchars($entityBField); ?>" name="<?= htmlspecialchars($entityBField); ?>" required>
            <option value="">-- pilih --</option>
            <?php foreach ($entityBOptions as $entityB): ?>
                <option value="<?= (int) $entityB["id"]; ?>"><?= htmlspecialchars($entityB["nama"]); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="<?= htmlspecialchars($dateField); ?>">Tanggal</label>
        <input type="date" id="<?= htmlspecialchars($dateField); ?>" name="<?= htmlspecialchars($dateField); ?>" required>

        <div class="actions">
            <button class="btn" type="submit">Simpan</button>
            <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=relation&action=index">Kembali</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>

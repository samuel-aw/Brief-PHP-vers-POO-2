<?php if (!empty($errors)): ?>
    <div class="flash error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= h($formAction) ?>">
    <label>
        Titre
        <input type="text" name="title" value="<?= h($resource->title) ?>" required>
    </label>

    <label>
        Type
        <input type="text" name="type" value="<?= h($resource->type) ?>" required>
    </label>

    <label>
        Statut
        <select name="status">
            <?php foreach (App\Resource::STATUSES as $value => $label): ?>
                <option value="<?= h($value) ?>" <?= $resource->status === $value ? 'selected' : '' ?>>
                    <?= h($label) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Emprunteur
        <input type="text" name="borrower" value="<?= h($resource->borrower) ?>">
    </label>

    <button type="submit"><?= h($submitLabel) ?></button>

</form>
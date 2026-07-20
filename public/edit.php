<?php

session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$statement = $pdo->prepare('SELECT * FROM resources WHERE id = :id');
$statement->execute(['id' => $id]);
$resource = $statement->fetch();

if (!$resource) {
    set_flash('error', 'Ressource introuvable.');
    redirect('index.php');
}

$flash = get_flash();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier une ressource</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main>
    <h1>Modifier une ressource</h1>

    <?php if ($flash): ?>
        <div class="flash <?= h($flash['type']) ?>"><?= h($flash['message']) ?></div>
    <?php endif; ?>

    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?= (int) $resource['id'] ?>">

        <label>
            Titre
            <input type="text" name="title" value="<?= h($resource['title']) ?>" required>
        </label>

        <label>
            Type
            <input type="text" name="type" value="<?= h($resource['type']) ?>" required>
        </label>

        <label>
            Statut
            <select name="status">
                <?php $statuts = ['disponible' => 'Disponible', 'emprunte' => 'Emprunté', 'maintenance' => 'Maintenance']; ?>
                <?php foreach ($statuts as $valeur => $libelle): ?>
                    <option value="<?= h($valeur) ?>" <?= $resource['status'] === $valeur ? 'selected' : '' ?>>
                        <?= h($libelle) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Emprunteur
            <input type="text" name="borrower" value="<?= h($resource['borrower']) ?>">
        </label>

        <button type="submit">Mettre à jour</button>
    </form>

    <p><a href="index.php">Retour à la liste</a></p>
</main>
</body>
</html>

<?php

session_start();

require __DIR__ . '/../includes/functions.php';

$flash = get_flash();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ajouter une ressource</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main>
    <h1>Ajouter une ressource</h1>

    <?php if ($flash): ?>
        <div class="flash <?= h($flash['type']) ?>"><?= h($flash['message']) ?></div>
    <?php endif; ?>

    <form method="post" action="store.php">
        <label>
            Titre
            <input type="text" name="title" required>
        </label>

        <label>
            Type
            <input type="text" name="type" required>
        </label>

        <label>
            Statut
            <select name="status">
                <option value="disponible">Disponible</option>
                <option value="emprunte">Emprunté</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </label>

        <label>
            Emprunteur
            <input type="text" name="borrower">
        </label>

        <button type="submit">Enregistrer</button>
    </form>

    <p><a href="index.php">Retour à la liste</a></p>
</main>
</body>
</html>

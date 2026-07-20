<?php

session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/functions.php';

$id = (int) ($_POST['id'] ?? 0);
$errors = validate_resource($_POST);

if ($errors) {
    set_flash('error', implode(' ', $errors));
    redirect('edit.php?id=' . $id);
}

$statement = $pdo->prepare(
    'UPDATE resources SET title = :title, type = :type, status = :status, borrower = :borrower WHERE id = :id'
);

$statement->execute([
    'id' => $id,
    'title' => trim($_POST['title']),
    'type' => trim($_POST['type']),
    'status' => $_POST['status'],
    'borrower' => trim($_POST['borrower'] ?? '') ?: null,
]);

set_flash('success', 'Ressource modifiée.');
redirect('index.php');

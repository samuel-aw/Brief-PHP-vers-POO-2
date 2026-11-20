<?php

require __DIR__ . '/../config/bootstrap.php';

use App\Database;
use App\Flash;
use App\Resource;
use App\ResourceRepository;
use App\Validator;

$repository = new ResourceRepository(Database::getConnection());

$id = (int) ($_GET['id'] ?? 0);
$resource = $repository->find($id);

if ($resource === null) {
    Flash::set('error', 'Ressource introuvable.');
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = Validator::validateResource($_POST);
    $resource = Resource::fromArray(array_merge($_POST, ['id' => $id]));

    if (!$errors) {
        $repository->update($resource);
        Flash::set('success', 'Ressource modifiée.');
        redirect('index.php');
    }
}

$pageTitle = 'Modifier une ressource';
$formAction = 'edit.php?id=' . $id;
$submitLabel = 'Mettre à jour';

require __DIR__ . '/../views/edit.php';
?>


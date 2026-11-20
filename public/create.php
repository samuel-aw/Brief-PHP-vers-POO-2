<?php

require __DIR__ . '/../config/bootstrap.php';

use App\Database;
use App\Flash;
use App\Resource;
use App\ResourceRepository;
use App\Validator;

$repository = new ResourceRepository(Database::getConnection());
$resource = new Resource(title: '', type: '');  // Formulaire vide
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = Validator::validateResource($_POST);
    $resource = Resource::fromArray($_POST);

    if (!$errors) {
        $repository->create($resource);
        Flash::set('success', 'Ressource ajoutée.');
        redirect('index.php');
    }
}

$pageTitle = 'Ajouter une resource';
$formAction = 'create.php';
$submitLabel = 'Enregistrer';

require __DIR__ . '/../views/create.php';
?>


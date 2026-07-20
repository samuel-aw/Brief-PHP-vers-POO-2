<?php

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function validate_resource(array $data): array
{
    $errors = [];
    $allowedStatuses = ['disponible', 'emprunte', 'maintenance'];

    if (trim($data['title'] ?? '') === '') {
        $errors[] = 'Le titre est obligatoire.';
    }

    if (trim($data['type'] ?? '') === '') {
        $errors[] = 'Le type est obligatoire.';
    }

    if (!in_array($data['status'] ?? '', $allowedStatuses, true)) {
        $errors[] = 'Le statut est invalide.';
    }

    return $errors;
}


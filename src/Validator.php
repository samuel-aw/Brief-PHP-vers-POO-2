<?php

namespace App;

class Validator {
    public static function validateResource(array $data): array {
        $errors = [];

        $title = trim((string) ($data['title'] ?? ''));
        $type = trim((string) ($data['type'] ?? ''));
        $status = $data['status'] ?? '';

        if ($title === '') {
            $errors[] = 'Le titre est obligatoire.';
        } elseif (mb_strlen($title) > 150) {
            $errors[] = 'Le titre ne doit pas dépasser 150 caractères.';
        }

        if ($type === '') {
            $errors[] = 'Le type est obligatoire.';
        } elseif (mb_strlen($type) > 80) {
            $errors[] = 'Le type ne doit pas dépasser 80 caractères.';
        }

        if (!array_key_exists($status, Resource::STATUSES)) {
            $errors[] = 'Le status est invalide.';
        }

        if (mb_strlen(trim((string) ($data['borrower'] ?? ''))) > 120) {
            $errors[] = "Le nom de l'emprunteur ne doit pas dépasser 120 caractères.";
        }

        return $errors;
    }
}
<?php

namespace App;

class Resource {
    public function __construct(
        public string $title,
        public string $type,
        public string $status = 'disponible',
        public ?string $borrower = null,
        public ?int $id = null,
        public ?string $createdAt = null,
    ){}

    public static function fromArray(array $data): self {
        return new self(
            title: $data['title'],
            type: $data['type'],
            status: $data['status'] ?? 'disponible',
            borrower: $data['borrower'] ?? null,
            id: isset($data['id']) ? (int) $data['id'] : null,
            createdAt: $data['created_at'] ?? null,
        );
    }
}
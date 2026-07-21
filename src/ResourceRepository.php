<?php

namespace App;

use PDO;

class ResourceRepository {
    public function __construct(private readonly PDO $pdo) {}

    public function findAll(): array {
        $statement = $this->pdo->query('SELECT * FROM resources ORDER BY created_at DESC');
        $rows = $statement->fetchAll();
        return array_map(fn (array $row): Resource => Resource::fromArray($row), $rows);
    }

    public function find(int $id): ?Resource {
        $statement = $this->pdo->prepare('SELECT * FROM resources WHERE id = :id');
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        return $row ? Resource::fromArray($row) : null;
    }

    public function create(Resource $resource): void {
        $statement = $this->pdo->prepare(
            'INSERT INTO resources (title, type, status, borrower)
                    VALUES (:title, :type, :status, :borrower)'
        );
        $statement->execute([
            'title' => $resource->title,
            'type' => $resource->type,
            'status' => $resource->status,
            'borrower' => $resource->borrower,
        ]);
    }

    public function update(Resource $resource): void {
        $statement = $this->pdo->prepare(
            'UPDATE resources
            SET title = :title, type = :type, status = :status, borrower = :borrower
            WHERE id = :id'
        );
        $statement->execute([
            'id' => $resource->id,
            'title' => $resource->title,
            'type' => $resource->type,
            'status' => $resource->status,
            'borrower' => $resource->borrower,
        ]);
    }

    public function delete(int $id): void {
        $statement = $this->pdo->prepare('DELETE FROM resources WHERE id = :id');
        $statement->execute(['id' => $id]);
    }
}
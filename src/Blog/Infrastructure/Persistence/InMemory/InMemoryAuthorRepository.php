<?php

declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\InMemory;

use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;

class InMemoryAuthorRepository implements AuthorRepository
{
    private int $authorsId = 1;
    private array $authors = [];

    public function save(Author $author): Author
    {
        $author->setId($this->authorsId++);
        $this->authors[$author->getId()] = $author;

        return $author;
    }

    public function remove(Author $author): void
    {
        unset($this->authors[$author->getId()]);
    }

    public function findById(int $authorId): ?Author
    {
        return $this->authors[$authorId] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->authors);
    }
}

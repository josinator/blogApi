<?php

declare(strict_types=1);

namespace Blog\DomainModel;

interface AuthorRepository
{
    public function save(Author $author): Author;

    public function remove(Author $author): void;

    public function findById(int $authorId): ?Author;

    public function findAll();
}

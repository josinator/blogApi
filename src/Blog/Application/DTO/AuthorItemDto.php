<?php

declare(strict_types=1);

namespace Blog\Application\DTO;

use Blog\DomainModel\Author;

class AuthorItemDto
{
    private function __construct(
        public readonly int $id,
        public readonly string $name
    ) {
    }

    public static function buildFromAuthor(Author $author): AuthorItemDto
    {
        return new self($author->getId(), $author->getName());
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

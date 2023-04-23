<?php

namespace Blog\DomainModel;

interface AuthorRepository
{
    public function save(Author $author): void;
    public function remove(Author $author):void;

    public function findById(int $authorId): Author;

    public function findPaginate(int $limit, int $page): array;
}
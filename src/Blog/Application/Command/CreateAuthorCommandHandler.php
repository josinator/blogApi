<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorRepository;

class CreateAuthorCommandHandler
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function __invoke(CreateAuthorCommand $command): void
    {
        $author = $command->author;
        $authorEntity = Author::builder(
            name: $author['name'],
            userName: $author['username'],
            email: $author['email'],
            address: $author['address'],
            phone: $author['phone'],
            site: $author['website'],
            company: $author['company']
        );

        $this->authorRepository->save($authorEntity);
    }
}

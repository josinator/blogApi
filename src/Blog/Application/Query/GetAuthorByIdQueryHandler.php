<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Blog\Application\DTO\AuthorDetailDto;
use Blog\DomainModel\AuthorException;
use Blog\DomainModel\AuthorNotFoundException;
use Blog\DomainModel\AuthorRepository;

class GetAuthorByIdQueryHandler
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function __invoke(GetAuthorByIdQuery $query)
    {
        $author = $this->authorRepository->findById($query->id);

        if(null === $author){
            throw AuthorNotFoundException::withId($query->id);
        }

        return AuthorDetailDto::buildFromAuthor($author);
    }
}

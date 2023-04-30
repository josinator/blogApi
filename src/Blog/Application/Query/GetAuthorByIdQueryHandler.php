<?php

namespace Blog\Application\Query;


use Blog\Application\DTO\AuthorDetailDto;
use Blog\DomainModel\AuthorRepository;

class GetAuthorByIdQueryHandler
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function __invoke(GetAuthorByIdQuery $query)
    {
        $author = $this->authorRepository->findById($query->id);

        return AuthorDetailDto::buildFromAuthor($author);
    }
}
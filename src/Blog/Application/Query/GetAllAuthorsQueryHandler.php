<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Blog\Application\DTO\AuthorItemDto;
use Blog\DomainModel\AuthorRepository;
use Common\Application\Query;

class GetAllAuthorsQueryHandler implements Query
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    /**
     * @return array|AuthorItemDto[]
     */
    public function __invoke(GetAllAuthorsQuery $query): array
    {
        $authors = $this->authorRepository->findAll();

        $listAuthors = [];
        foreach ($authors as $author) {
            $listAuthors[] = AuthorItemDto::buildFromAuthor($author);
        }

        return $listAuthors;
    }
}

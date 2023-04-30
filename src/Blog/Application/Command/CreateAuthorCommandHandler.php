<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Blog\Application\DTO\AuthorDetailDto;
use Blog\DomainModel\Author;
use Blog\DomainModel\AuthorException;
use Blog\DomainModel\AuthorRepository;
use Throwable;

class CreateAuthorCommandHandler
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function __invoke(CreateAuthorCommand $command): AuthorDetailDto
    {
        $author = $command->author;
        try{
            $authorEntity = Author::builder(
                name: $author['name'],
                userName: $author['username'],
                email: $author['email'],
                address: $author['address'],
                phone: $author['phone'],
                site: $author['website'],
                company: $author['company']
            );

            $author = $this->authorRepository->save($authorEntity);
            return AuthorDetailDto::buildFromAuthor($author);
        }catch (Throwable $th){
            throw AuthorException::withData($author);
        }


    }
}
